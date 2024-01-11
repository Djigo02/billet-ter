<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UtilisateurController extends Controller
{
    // Page de connexion
    public function login(){
        return view('login');
    }
    
    // Page apres authentification
    public function doLogin(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        return view('welcome');
    }

    // Page d'inscription
    public function signup(){
        return view('signup');
    }

    // Page apres Registration
    public function doSignup(Request $request){
        $request->validate([
            'prenom' => 'required',
            'nom' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        return view('login', ['message'=>'Compte créer avec succés !']);
    }
}
