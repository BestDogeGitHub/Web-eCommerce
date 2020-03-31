<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use App\SiteImage;
use App\Order;
use App\Category;
use App\Review;
use App\User;
use App\Product;
use App\Shipment;
use Validator;
use Image;
use File;

class AdminDashboardController extends Controller
{

    public function index()
    {
        return view('backoffice.pages.home');
    }

    /**
     * Restituisce la pagina di gestione ruoli
     */
    public function manageRoles() {

        
        $userController = new UserController();
        $users = $userController->index();
        $roles = \Spatie\Permission\Models\Role::all();
        /*
        $arrX = array("User", "Shipment Representative","Inventory Representative", "Administrator");

        foreach($users as $user){
            $randIndex = array_rand($arrX);
            $user->assignRole($arrX[$randIndex]);
        }
        */
        return View('backoffice.pages.roles', ['users' => $users, 'roles' => $roles]);
    }

    /**
     * Restituisce la pagina di modifica utente
     */
    public function editUser($id_user) {

        $userController = new UserController();
        $user = $userController->getById($id_user);
        $roles = \Spatie\Permission\Models\Role::all();

        return View('backoffice.pages.edit_user', ['user' => $user]);
    }

    /**
     * Restituisce la pagina di modifica ruoli utente
     */
    public function editUserRoles($id_user) {

        $userController = new UserController();
        $user = $userController->getById($id_user);
        $roles = \Spatie\Permission\Models\Role::whereNotIn('id', $user->roles->pluck('id'))->get();

        return View('backoffice.pages.edit_roles', ['user' => $user, 'roles' => $roles]);
    }

    /**
     * Restituisce la pagina di modifica ruoli utente
     */
    public function getComponents() {

        $components = SiteImage::all();


        return View('backoffice.pages.edit_website', ['components' => $components]);
    }

    /**
     * Restituisce la pagina di modifica ruoli utente
     */
    public function editResource($resource) {

        $resource = SiteImage::findOrFail($resource);

        return View('backoffice.pages.edit_resource', ['resource' => $resource]);
    }

    /**
     * Aggiorna la descrizione del campo
     */
    public function updateResource($resource, Request $request) {

        $rules = array(
            'details' => 'required|string|max:1000',
            'image' => 'image|max:4096'
        );

        $error = Validator::make($request->all(), $rules)->validate();

        $resource = SiteImage::findOrFail($resource);

        if(!$request->hasFile('image')) {
            
            // IMAGE NOT CHANGED
            
            $data = array(
                'image_details' => $request->details
            );

        } else {
            
            // IMAGE CHANGED
            
            // UPLOAD IMAGE
            $image = $request->file('image');
            $new_name = rand() . '.' . $image->getClientOriginalExtension(); // Name of new Image
            $destination_path = "/images/static";


            
            $resize_image = Image::make($image->getRealPath());

            //return response()->json(['errors' => [$destination_path . '/' . $new_name]]);
            $resize_image->save(public_path($destination_path . '/' . $new_name));


            $old_image_path = $resource->image_ref;

            /*if(File::exists(public_path() . $old_image_path)) {
                File::delete(public_path() . $old_image_path);
            }*/

            $data = array(
                'image_ref' => '/images/static/' . $new_name,
                'image_details' => $request->details
            ); 
        }

        $resource->update($data);

        return View('backoffice.pages.edit_resource', ['resource' => $resource]);
    }



    /**
     * Gestisce i ruoli dell'utente
     */
    public function changeUserRoles(Request $request) {

        return $request->getContent();
        $userController = new UserController();
        $string = "";

        foreach(json_decode($request->getContent()) as $item){
            $string += " $item";
        }

        return $string;


        $user = $userController->validateRoles($id_user);
        $roles = \Spatie\Permission\Models\Role::whereNotIn('id', $user->roles->pluck('id'))->get();
        
        $response = array(
            'status' => 'success',
            'msg' => $user->roles,
        );
        return response()->json($response);
    }



    /**
     * Restituisce i dati utili ai diagrammi nella home del backoffice
     */
    public function getInformations(Request $request)
    {
        if($request->ajax()) {

            $orders_stat = array(
                '0' => 0,
                '1' => 0,
                '2' => 0,
                '3' => 0,
                '4' => 0,
                '5' => 0,
                '6' => 0,
            );

            foreach(Order::whereDate('created_at', '>=', Carbon::now()->subDays(7))->get() as $index=>$order) {
                //$created = Carbon::createFromFormat('Y-m-d', $order->created_at);
                $order_date = $order->created_at->format('d.m.Y');
                $now = Carbon::now()->format('d.m.Y');
                $day_of = date_diff(date_create($now), date_create($order_date))->days;
                if(array_key_exists($day_of, $orders_stat)) $orders_stat[$day_of]++;
            }


            $reviews_stat = array(
                '0' => 0,
                '1' => 0,
                '2' => 0,
                '3' => 0,
                '4' => 0,
                '5' => 0,
                '6' => 0,
            );

            foreach(Review::whereDate('created_at', '>=', Carbon::now()->subDays(7))->get() as $index=>$review) {
                $review_date = $review->created_at->format('d.m.Y');
                $now = Carbon::now()->format('d.m.Y');
                $day_of = date_diff(date_create($now), date_create($review_date))->days;
                if(array_key_exists($day_of, $reviews_stat)) $reviews_stat[$day_of]++;
            }

            
            
            return response()->json([
                'orders' => $orders_stat,
                'reviews' => $reviews_stat,
                'users' => User::whereDate('created_at', '>=', Carbon::now()->subDays(7))->count(), // Users last week
                'num_orders' => Order::whereDate('created_at', '>=', Carbon::now()->subDays(7))->count(), // Orders last week
                'num_products' => Product::whereDate('created_at', '>=', Carbon::now()->subDays(7))->count(), // products last week 
                'in_transit' => Shipment::where('delivery_status_id', 2)->count(), // Transit orders
            ]);
        }
    }
    
}
