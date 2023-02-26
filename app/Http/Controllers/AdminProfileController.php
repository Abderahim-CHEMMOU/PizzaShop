<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class AdminProfileController extends Controller
{
    //
    public function edit(Request $request){
        
        return view('admin_profile.edit'); 
    }

    public function update(Request $request){
            

        $validated = $request->validate([
            'old_password'=>'required',
            'new_password' => 'bail|required|string|alpha_dash|min:8|max:60|confirmed',
        ]);

        //Récupérer l'utilisateur courant
        $current_user = Auth::user();
        
        $login = $current_user->login;

        $credentials = ['login' => $login, 'password' => $request->input('old_password')];
        
        if (Auth::attempt($credentials)) {
            
            $current_user->mdp = Hash::make($request->new_password);
            $current_user->save();

            $request->session()->flash('etat','Modification effectué');

            return redirect()->intended('/');
        }

        $request->session()->flash('etat','Mot de passe actuel érroné, modification non effectué ! Veulliez saisir le bon mot de passe.');

        return redirect('/admin_profile/edit'); 
    }    
}
