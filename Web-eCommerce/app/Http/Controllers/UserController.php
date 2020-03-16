<?php

namespace App\Http\Controllers;

use App\User;
use App\Address;
use Illuminate\Http\Request;
use Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $addresses = Address::all();

        return View('backoffice.pages.edit_users', ['users' => $users, 'addresses' => $addresses]);
    }

    public function getById($id) {
        return User::where('id', $id)->first();
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
        return View('backoffice.pages.edit_user', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(request()->ajax())
        {
            $roles = $user->roles;
            return response()->json([
                'data' => $user,
                'roles' => $roles
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, $id )
    {
        $rules = array(
            'username' => 'required|max:45',
            'name' => 'required|max:45',
            'surname' => 'required|max:45',
            'phone' => 'required|integer|max:999999999999999',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:3|max:60'
        );
        
        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        
        $data = array(
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'phone' => $request->phone
        );

        $user->update($data);
        
        return response()->json(['success' => 'User Updated successfully.']);
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