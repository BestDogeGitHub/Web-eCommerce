<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(20);

        return View::make('users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('users.create');
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
            'username' => 'required|max:45',
            'name' => 'required|max:45',
            'surname' => 'required|max:45',
            'phone' => 'required|integer|max:999999999999999',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:3|max:60'
        ]);
        
        $user = new User();
        $user->fill( $request->all() );
        $user->save();
    
        // redirect
        Session::flash('message', 'Successfully created user!');
        return Redirect::to('users');
        
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        return View::make('users.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        return View::make('users.edit')->with('user', $user);
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
            'username' => 'required|max:45',
            'name' => 'required|max:45',
            'surname' => 'required|max:45',
            'phone' => 'required|integer|max:999999999999999',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:3|max:60'
        ]);
            // store
        $user = User::find($id);
        $user->fill( $request->all() );
        $user->save();
        // redirect
        Session::flash('message', 'Successfully updated user!');
        return Redirect::to('users');
        
    }

    /**
     * Remove the specified resource from storage.
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete
        $user = User::find($id);
        $user->delete();
        // redirect
        Session::flash('message', 'Successfully deleted!');
        return Redirect::to('users');
    }
}