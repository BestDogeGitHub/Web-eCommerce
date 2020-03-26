<?php

namespace App\Http\Controllers;

use App\Order;
use App\User;
use App\OrderDetail;
use App\Shipment;
use App\Coupon;
use App\Product;
use App\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OrderController extends Controller
{

    protected $rules;

    public function __construct()
    {
        $this->rules = array(
            'PO_Number' => 'required|integer|min:1|max:999999999999999',
            'user_id' => 'required|integer|min:0|exists:users,id'
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::orderBy('created_at', 'DESC')->get();

        return View('backoffice.pages.edit_orders', ['orders' => $orders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('orders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $error = Validator::make($request->all(), $this->rules);
        if($error->fails()){ return response()->json(['errors' => $error->errors()->all()]); }

        $order = new Order();
        $order->fill( $request->all() );
        $order->save();
    
        return response()->json(['success' => 'success!']);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $ord = Order::where('id', '=', $order->id)->get();

        return View('backoffice.pages.edit_orders', ['orders' => $ord]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        if(request()->ajax())
        {
            return response()->json([
                'order' => $order, 
                'orderDetails' => $order->orderDetails,
                'shipment' => $order->shipment,
                'invoice' => $order->invoice,
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, $id )
    {
        $error = Validator::make($request->all(), $this->rules);
        if($error->fails()){ return response()->json(['errors' => $error->errors()->all()]); }
        
        $order = Order::find($id);
        $order->fill( $request->all() );
        $order->save();

        return response()->json(['success' => 'success!']);
    }

    /**
     * Remove the specified resource from storage.
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete
        $order = Order::find($id);
        $order->delete();

        return response()->json(['success' => 'success!']);
    }

    public function makeOrder( Request $request ) // la richiesta deve contenere il metodo di pagamento e l'utente
    {
        $user = $request->user();
        $paymentMethod = $request->paymentMethod;

        $products = $user->productsInCart();

        return $products;
    }


    /**
     * Metodo che materializza l'ordine in backend
     * 
     * @param $idUser
     * @param $idCard
     * @param $idAdd
     * @param $idCoupon
     * @param $paymentMethod (1 carta, 2 paypal)
     * 
     * @return \Illuminate\Http\Response
     */
    public static function checkout($idUser, $idCard, $idAdd, $idCoupon, $paymentMethod)
    {
        /*
         *  DEBUG Parameters
         *
            $user = User::find(1);//Auth::user();
            $idAdd = 5;
            $idCoupon = 1;
            $idCard = 55;
            $paymentMethod = 1;
        */
        
        // DEBUG
        $payment = 0; // il prezzo da pagare
        $products = DB::table('cart')->where('user_id', $idUser)->get();

        do{
            $PO = rand(1000000000,9999999999);
        }
        while(Order::where('PO_Number', '=', $PO)->exists());

        $order = Order::create([
            'PO_Number' => $PO,
            'user_id' => $idUser,
        ]);

        foreach($products as $product)
        {
            DB::table('order_details')->insert([
                'order_id' => $order->id,
                'product_id' => $product->product_id,
                'quantity' => $product->quantity
            ]);
            $payment += ( Product::find($product->product_id)->payment * $product->quantity );
        }

        $ship = Shipment::create([
            'order_id' => $order->id,
            'address_id' => $idAdd,
        ]);

        $sale = 0;
        if(!is_null($idCoupon))
        {
            $coupon = Coupon::find($idCoupon);
            
            $sale = $coupon->sale;
            $coupon->used_counter++;
            $coupon->save();
        }
        $mytime = Carbon::now();
        $inv = Invoice::create([
            'details' => $mytime->toDateTimeString(),
            'payment' => $payment,
            'coupon_sale' => $sale,
            'order_id' => $order->id,
            'payment_method_id' => $paymentMethod,
            'credit_card_id' => $idCard,
        ]);

        DB::table('cart')->where('user_id', '=', $user->id)->delete();

        return $order->id;
    }
}