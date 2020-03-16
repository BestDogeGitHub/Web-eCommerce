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
<<<<<<< HEAD
        $users = User::paginate(20);

        return View::make('users.index')->with('users', $users);
=======
        $users = User::all();
        $addresses = Address::all();

        return View('backoffice.pages.edit_users', ['users' => $users, 'addresses' => $addresses]);
    }

    public function getById($id) {
        return User::where('id', $id)->first();
>>>>>>> 06d9a2a0e316e574eb97b9305e682be87c78c6ba
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
<<<<<<< HEAD
        $user = User::find($id);

        return View::make('users.show')->with('user', $user);
=======
        return View('backoffice.pages.edit_user', ['user' => $user]);
>>>>>>> 06d9a2a0e316e574eb97b9305e682be87c78c6ba
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
<<<<<<< HEAD
        $user = User::find($id);

        return View::make('users.edit')->with('user', $user);
=======
        if(request()->ajax())
        {
            $roles = $user->roles;
            return response()->json([
                'data' => $user,
                'roles' => $roles
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
        
=======
        $rules = array(
            'name' => 'required|max:200',
            'surname' => 'required|max:200',
            'email' => 'required',
            'phone' => 'required'
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
        $user = User::find($id);
        $user->delete();
        // redirect
        Session::flash('message', 'Successfully deleted!');
        return Redirect::to('users');
=======
        $user->delete();
>>>>>>> 06d9a2a0e316e574eb97b9305e682be87c78c6ba
    }
}