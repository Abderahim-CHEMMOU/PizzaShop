<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Pizza;
use App\Models\Commande;

class CommandePizzaController extends Controller
{
    //
    public function show($id)
    {   
        $commande = Commande::findOrFail($id);
        $prix_total = 0;
        foreach ($commande->pizzas as $pizza) {
            $pizza_id  = $pizza->pivot->pizza_id;
            $pizza_info = Pizza::findOrFail($pizza_id);
            $prix_unit = $pizza_info->prix;
            $qte_pizzas = $pizza->pivot->qte; 
            $prix_total = $prix_total + ($qte_pizzas*$prix_unit);
        }


        return view('commandes_pizzas.show', [
            'prix_total' => $prix_total 
        ]);
        
    }
    
}
