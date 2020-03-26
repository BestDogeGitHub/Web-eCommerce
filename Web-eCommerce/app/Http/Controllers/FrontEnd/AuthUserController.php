<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Nation;
use App\Town;

class AuthUserController extends Controller
{
    /**
     * Restituisce il profilo dell'utente
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getProfile() {
        $user = Auth::user();
        $nations = Nation::all();
        $towns = Town::all();

        return view('frontoffice.pages.profile', ['user' => $user, 'nations' => $nations, 'towns' => $towns]);
    }
}
