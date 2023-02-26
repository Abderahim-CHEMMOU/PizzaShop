<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Models\Pizza;


class AdminPizzaController extends Controller
{
    public function create(){

        return view('admin_pizzas.create');
    }
    
    public function store(Request $request){
        
        $validated = $request->validate([
            'nom'=>'required|max:30',
            'description' => 'bail|required|min:10|max:1500',
            'prix' => 'bail|required|between:0.1,999.99',
        ]);
  
        $pizza = new Pizza();
        $pizza->nom = $request->nom;
        $pizza->description = $request->description;
        $pizza->prix = $request->prix;

        $pizza->save();

        $request->session()->flash('etat','Ajout effectué !');
        
        return redirect('/');
    }

    public function index(){

        $p = Pizza::all();

        return view('admin_pizzas.index', ['pizzas' => $p]);
    }

    public function edit(Request $request, $id){
        $pizza = Pizza::findOrFail($id);
        
        return view('admin_pizzas.edit', ['pizza'=>$pizza]); 
    }

    public function update(Request $request, $id){
        $pizza = Pizza::findOrFail($id);
        
        $validated = $request->validate([
            'nom'=>'required|max:30',
            'description' => 'bail|required|min:10|max:1500',
        ]);
        
        $pizza->nom = $validated['nom'];
        $pizza->description = $validated['description'];

        $pizza->save();


        $request->session()->flash('etat','Modification effectué !');

        return redirect('/'); 
    }
}