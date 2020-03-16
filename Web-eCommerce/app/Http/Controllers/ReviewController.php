<?php

namespace App\Http\Controllers;

use App\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reviews = Review::paginate(20);

        return View::make('reviews.index')->with('reviews', $reviews);
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
        // validate
        $request->validate
        ([
            'stars' => 'required|integer|max:5',
            'text' => 'required|max:1500',
        ]);
        
        $review = new Review();
        $review->fill( $request->all() );
        $review->save();
    
        // redirect
        Session::flash('message', 'Successfully created review!');
        return Redirect::to('reviews');
        
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
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $request->validate
        ([
            'stars' => 'required|integer|max:5',
            'text' => 'required|max:1500',
        ]);
            // store
        $review = Review::find($id);
        $review->fill( $request->all() );
        $review->save();
        // redirect
        Session::flash('message', 'Successfully updated review!');
        return Redirect::to('reviews');
        
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
        // redirect
        Session::flash('message', 'Successfully deleted!');
        return Redirect::to('reviews');
    }
}