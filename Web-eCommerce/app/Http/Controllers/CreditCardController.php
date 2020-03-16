<?php

namespace App\Http\Controllers;

use App\CreditCard;
use App\User;
use Illuminate\Http\Request;
use Validator;

class CreditCardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
<<<<<<< HEAD
        $credit_cards = CreditCard::paginate(20);

        return View::make('credit_cards.index')->with('credit_cards', $credit_cards);
=======
        $credit_cards = CreditCard::all()->map(function ($card) {
            $card->number = str_replace($card->number, $this->hideNumber($card->number), $card->number);
    
            return $card;
        });;

        return View('backoffice.pages.edit_credit_cards', ['credit_cards' => $credit_cards, 'companies' => $this->getCompanies()]);
    }

    private function hideNumber($number) {
        if(strlen($number) <= 2) return $number;
        $newstring = $number[0] . $number[1];
        for ($i = 2; $i < strlen($number); $i++){
            $newstring .= '*';
        }
        return $newstring;
    }

    private function getCompanies(){
        $companies = array(
            'American Express',
            'Bank of America',
            'Barclays',
            'Capital One',
            'Chase',
            'Citibank',
            'Discover Card',
            'Mastercard',
            'Navy Federal Credit Union',
            'Pentagon Federal Credit Union',
            'PNC',
            'USAA',
            'U.S. Bank',
            'Visa',
            'Visa Retired',
            'Wells Fargo'
        );
        return $companies;
>>>>>>> 06d9a2a0e316e574eb97b9305e682be87c78c6ba
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('credit_cards.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
<<<<<<< HEAD
        // validate
        $request->validate
        ([
            'type' => 'required|max:20',
            'number' => 'required|integer|max:20',
            'expiration_date' => 'required|regex:^([0-1][1-9])\/([0-9]{2})$|max:6',
            'user_id' => 'required|integer',
        ]);
        
        $credit_card = new CreditCard();
        $credit_card->fill( $request->all() );
        $credit_card->save();
    
        // redirect
        Session::flash('message', 'Successfully created credit_card!');
        return Redirect::to('credit_cards');
        
=======

        $rules = array(
            'type' => 'required|in:' . implode(',', $this->getCompanies()),
            'number' => 'required|digits_between:10,20',
            'exp_month' => 'required|integer|between:1,12',
            'exp_year' => 'required|integer|between:0,99'
        );
        
        $error = Validator::make($request->all(), $rules);
        
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        


        $data = array(
            'type' => $request->type,
            'number' => $request->number,
            'expiration_date' => $request->exp_month . '/' . $request->exp_year
        );

        if( isset($request->user_id) ) {

            $user = User::where('id', '=', $request->user_id)->first();

            if($user === null ) {
                return response()->json(['errors' => ['User not valid']]);
            } elseif($user->creditCard === null) {
                $data['user_id'] = $request->user_id;
            } else {
                return response()->json(['errors' => ['The user already has a credit card']]);
            }
            
            
        }

        

        // FOR DEBUGGING
        //return response()->json(['errors' => array_values($data)]);

        CreditCard::create($data);
        

        return response()->json(['success' => 'Credit Card Added successfully.']);
>>>>>>> 06d9a2a0e316e574eb97b9305e682be87c78c6ba
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $credit_card = CreditCard::find($id);

        return View::make('credit_cards.show')->with('credit_card', $credit_card);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
<<<<<<< HEAD
        $credit_card = CreditCard::find($id);

        return View::make('credit_cards.edit')->with('credit_card', $credit_card);
=======
        if(request()->ajax())
        {
            $exp_date = explode('/', $creditCard->expiration_date);
            
            if(count($exp_date) != 2) return response()->json(500);
            
            $month = $exp_date[0];
            $year = $exp_date[1];

            return response()->json([
                'data' => $creditCard,
                'month' => $month,
                'year' => $year 
                ]);
        }
>>>>>>> 06d9a2a0e316e574eb97b9305e682be87c78c6ba
    }

    /**
     * Update the specified resource in storage.
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, $id )
    {
<<<<<<< HEAD
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $request->validate
        ([
            'type' => 'required|max:20',
            'number' => 'required|integer|max:20',
            'expiration_date' => 'required|regex:^([0-1][1-9])\/([0-9]{2})$|max:6',
            'user_id' => 'required|integer',
        ]);
            // store
        $credit_card = CreditCard::find($id);
        $credit_card->fill( $request->all() );
        $credit_card->save();
        // redirect
        Session::flash('message', 'Successfully updated credit_card!');
        return Redirect::to('credit_cards');
        
=======
        $rules = array(
            'type' => 'required|in:' . implode(',', $this->getCompanies()),
            'number' => 'required|digits_between:10,20',
            'exp_month' => 'required|integer|between:1,12',
            'exp_year' => 'required|integer|between:0,99'
        );
        
        $error = Validator::make($request->all(), $rules);
        
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }


        
        $data = array(
            'type' => $request->type,
            'number' => $request->number,
            'expiration_date' => $request->exp_month . '/' . $request->exp_year
        );

        if( isset($request->user_id) ) {

            if(User::where('id', '=', $request->user_id)->first() === null ) {
                return response()->json(['errors' => ['User not valid']]);
            }

            $data['user_id'] = $request->user_id;
        }

        

        // FOR DEBUGGING
        //return response()->json(['errors' => array_values($data)]);

        $creditCard->update($data);
        

        return response()->json(['success' => 'Credit Card Updated successfully.']);
>>>>>>> 06d9a2a0e316e574eb97b9305e682be87c78c6ba
    }

    /**
     * Remove the specified resource from storage.
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
<<<<<<< HEAD
        // delete
        $credit_card = CreditCard::find($id);
        $credit_card->delete();
        // redirect
        Session::flash('message', 'Successfully deleted!');
        return Redirect::to('credit_cards');
=======
        $creditCard->delete();
>>>>>>> 06d9a2a0e316e574eb97b9305e682be87c78c6ba
    }
}