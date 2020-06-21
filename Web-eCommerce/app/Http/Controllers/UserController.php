<?php

namespace App\Http\Controllers;

use App\User;
use App\Address;
use Spatie\Permission\Models\Role as Role;
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

    

    /**
     * Dato in Input un ID restituisce l'oggetto utente corrispondente
     */
    public static function getById($id) {
        return User::where('id', $id)->first();
    }

    /**
     * Dato in input un array di ID di Ruoli o un singolo ID, valido se esistono
     */
    public static function validateRoles($roles) {

        if(is_array($roles)) {
            foreach($roles as $role) {
                if (!Role::where('id', '=', $role)->exists()) return false;
            }
        } else {
            if (!Role::where('id', '=', $roles)->exists()) return false;
        }

        return true;
    }

    /**
     * Dato in input Nome ruolo, valido se esisto
     */
    public static function validateRoleName($role) {

        if (!Role::where('name', '=', $role)->exists()) return false;

        return true;
    }

    /**
     * Add role to user
     */
    public static function addUserRole($user, $role_name) {
        if(validateRoleName($role)) {
            $user->assignRole($role);
            return true;
        } else {
            return false;
        }
    }

    /**
     * Remove role to user
     */
    public static function removeUserRole($user, $role_name) {
        if(validateRoleName($role)) {
            $user->removeRole($role);
            return true;
        } else {
            return false;
        }
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
    public function show(User $user)
    {
        return View('backoffice.pages.edit_user', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
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
    public function update( Request $request, User $user )
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
    public function destroy(User $user)
    {
        // delete
        $user = User::find($id);
        $user->delete();
        // redirect
        Session::flash('message', 'Successfully deleted!');
        return Redirect::to('users');
    }
}