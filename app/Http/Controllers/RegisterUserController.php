<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterUserController extends Controller
{
    public function showForm(){
        return view('auth.register');
    }

    public function store(Request $request){
        $request->validate([
            'nom' => 'bail|required|string|max:40',
            'prenom' => 'bail|required|string|max:40',
            'login' => 'bail|required|string|max:30|unique:users',
            'mdp' => 'bail|required|string|min:8|max:60|confirmed',
        ]);

        $user = new User();
        $user->nom = $request->nom;
        $user->prenom = $request->prenom;
        $user->login = $request->login;
        $user->mdp = Hash::make($request->mdp);
        $user->save();
   
        session()->flash('etat','User added');
 
        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
