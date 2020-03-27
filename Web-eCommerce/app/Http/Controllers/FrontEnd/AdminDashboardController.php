<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\SiteImage;

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

        $resource = SiteImage::findOrFail($resource);

        $data = array(
            'image_details' => $request->details
        );

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
    
}
