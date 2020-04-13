<?php

namespace App\Http\Controllers;

use App\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{

    protected $rules;

    public function __construct()
        {
            $this->rules = array(
                'stars' => 'required|integer|max:5',
                'text' => 'required|max:1500',
                'user_id' => 'required|integer|min:0|exists:users,id',
                'product_type_id' => 'required|integer|min:0|exists:product_types,id'
            );
        }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reviews = Review::all();

        return View('backoffice.pages.edit_reviews', ['reviews' => $reviews]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('reviews.create');
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
        
        $review = new Review();
        $review->fill( $request->all() );
        $review->save();
    
        return response()->json(['success' => 'success!']);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $review = Review::find($id);

        return View::make('reviews.show')->with('review', $review);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $review = Review::find($id);

        return View::make('reviews.edit')->with('review', $review);
    }

    /**
     * Update the specified resource in storage.
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, $id )
    {
        $error = Validator::make($request->all(), $this->rules);
        if($error->fails()){ return response()->json(['errors' => $error->errors()->all()]); }
        // store
        $review = Review::find($id);
        $review->fill( $request->all() );
        $review->save();

        return response()->json(['success' => 'success!']);
    }

    /**
     * Remove the specified resource from storage.
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete
        $review = Review::find($id);
        $review->delete();

        return response()->json(['success' => 'success!']);
    }

    public function isReviewLegal($idUser, $idProduct) // torna true se l'utente può scrivere la recensione, false se non la può scrivere
    {
        // l'id dell'utente che vuole scrivere la recensione
        // l'id del prodotto di cui l'utente vuole scrivere la recensione

        $entry = DB::table('review_permissions')->where([['product_id', '=', $idProduct],['user_id', '=', $idUser]])->first();

        if (is_null($entry)) return false;
        else return true;
    }
}