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
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CreditCard  $creditCard
     * @return \Illuminate\Http\Response
     */
    public function show(CreditCard $creditCard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CreditCard  $creditCard
     * @return \Illuminate\Http\Response
     */
    public function edit(CreditCard $creditCard)
    {
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CreditCard  $creditCard
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CreditCard $creditCard)
    {
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CreditCard  $creditCard
     * @return \Illuminate\Http\Response
     */
    public function destroy(CreditCard $creditCard)
    {
        $creditCard->delete();
    }
}
