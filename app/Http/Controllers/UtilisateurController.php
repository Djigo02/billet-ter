<?php

namespace App\Http\Controllers;
use App\Models\Gare;
use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UtilisateurController extends Controller
{
    // Page de connexion
    public function login(){
        return view('register.login');
    }
    
    
    // Page apres authentification
    public function doLogin(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $utilisateur = Utilisateur::where([
            'email' => $request->input('email'),
        ])->first();

        if($utilisateur!=null && Hash::check($request->input('password'), $utilisateur->password)){
            Session::put('utilisateur',$utilisateur);
            return $utilisateur->role == 'voyageur' ? redirect('/reserver'): redirect('/admin');
        }else{
            return back()->with('message', 'Email et/ou mot de passe incorrect !');
        }
    }

    // Page d'inscription
    public function signup(){
        return view('register.signup');
    }

    // Page apres Registration
    public function doSignup(Request $request){
        $request->validate([
            'prenom' => 'required|min:2',
            'nom' => 'required|min:2',
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        if(Utilisateur::where(['email'=>$request->email])->first()){
            return redirect('/signup')->with('message','Cet adresse a deja un compte !');
        }
        $utilisateur = new Utilisateur();
        $utilisateur->prenom = $request->prenom;
        $utilisateur->nom = $request->nom;
        $utilisateur->email = $request->email;
        $utilisateur->password = Hash::make($request->password);
        $utilisateur->role = "voyageur";
        $utilisateur->save();

        return redirect('/login')->with('message','Compte créer avec succés !');
    }

    // Deconnexion
    public function deconnexion(){
        Session::forget('utilisateur');
        return view('register.login');
    }
}
