<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Pizza;
use App\Models\Commande;

class UserPizzaController extends Controller
{
    
    public function index(){

        $p = Pizza::Paginate(15);

        return view('user_pizzas.index', ['pizzas' => $p]);
    }


    public function create(){
        $pizzas = Pizza::Paginate(15);
        return view('user_pizzas.create', ['pizzas' => $pizzas]);
    }
    
    public function store(Request $request){
        $validated00 = $request->validate([
            'commmande_valide'=>'required|integer',
        ]);
        
        // Ne pas validez la panier
        if($request->commmande_valide == 0 ){

        
            $validated = $request->validate([
                'qte'=>'required|min:1',
                'pizza_id'=>'required'
            ]);
            

            /* << Creation d'un panier sous forme d'un tableau associatif  
                la clé c'est l'id de pizza et la valeur représente la quantité de pizza >>
            */

            // Tester si le panier existe
            if($request->session()->has('pannier')) {
                // On récupère le panier
                $pannier = $request->session()->get('pannier');
                //Tester si la clé existe 
                if(array_key_exists($request->pizza_id, $pannier)){
                    // Ajouter à la nouvelle quantité à la quantité précidente
                    $pannier[$request->pizza_id] = $pannier[$request->pizza_id] + $request->qte ;
                }else{
                    // Ajouter une nouvelle pizza ( nouvelle clé)
                    $pannier[$request->pizza_id] = $request->qte;   
                }
            }
            //Si le panier n'existe pas 
            else{
                $pannier[$request->pizza_id] = $request->qte;            
            }
            
            // Mettre le tableau pannier dans la session
            $request->session()->put('pannier', $pannier);
            
            //Message flash
            $request->session()->flash('etat','Ajout au panier effectué !');
            return redirect('/');        
        }
        // Validez la commande
        else{
            
            // Si le pannier n'est pas vide
            if($request->session()->has('pannier')) {
                
                $pannier = $request->session()->get('pannier');
                $request->session()->has('pannier');
                $compteur=0;
                $tab_pizza_id = array_keys($pannier);
                
                //Sauvegarder dans la table commande
                $commande = new Commande();
                $current_user = Auth::user();        
                $commande->user_id = $current_user->id;
                $commande->statut = 'envoye';        
                $commande->save();
                //Sauvegarder dans la table commande_pizza
                $e = Commande::where('id',$commande->id)->first();
                foreach($pannier as $p){
                    $c = Pizza::where('id',$tab_pizza_id[$compteur])->first();
                    $e->pizzas()->attach($c,['qte'=>$p]);
                    $compteur++;
                }
                //Vider le pannier
                $request->session()->forget('pannier');

                $request->session()->flash('etat','Commande validée');
                return redirect('/');
            }
            // Si le pannier est vide
            else{
                $request->session()->flash('etat','Panneir Vide , Veulliez choisir votre pizza prèféré SVP!');
                return redirect('/user_pizzas/create');
            }
        }
    }

    public function edit(Request $request, $id){
        
        if($request->session()->has('pannier')) {
                
            $pannier = $request->session()->get('pannier');
             
            if(isset($pannier[$id])){
                $pizza_qte[0] = Pizza::findOrFail($id);
                $pizza_qte[1] = $pannier[$id];
                return view('user_pizzas.edit', ['pizza_qte'=>$pizza_qte]);
            }else{
                $request->session()->flash('etat','le Panneir Vide');
                return view('main');
            }  
        }
        else{
            $request->session()->flash('etat','le Panneir Vide');
            return view('main');    
        }
    }

    public function update(Request $request, $id){
        
        
        $validated = $request->validate([
            'qte'=>'required|min:1',
        ]);
        
        if($request->session()->has('pannier')) {
                
            $pannier = $request->session()->get('pannier');
            $pannier[$id] = $validated['qte'];
            $request->session()->put('pannier', $pannier);
            $request->session()->flash('etat','Modification effectué !');
            return redirect('/');
        }
        $request->session()->flash('etat','Erreur panier non trouvé');
        return redirect('/'); 
    }

    public function delete(Request $request, $id){
        
        if($request->session()->has('pannier')) {
            
            $pannier = $request->session()->get('pannier');
            
            if(isset($pannier[$id])){
                
                $pizza = Pizza::findOrFail($id);
                
                return view('user_pizzas.delete', ['pizza'=>$pizza]);
            }else{
                $request->session()->flash('etat','Pizza n existe pas');
                return view('main');
            }  
        }
        else{
            $request->session()->flash('etat','le Panneir Vide');
            return view('main');    
        }
    }

    public function destroy(Request $request, $id){
        
        if($request->session()->has('pannier')) {
            $pannier = $request->session()->get('pannier');
            unset($pannier[$id]);
            $request->session()->put('pannier', $pannier);
            $request->session()->flash('etat','Pizza supprimé dans le pannier !');
            return redirect('/');
        }
        $request->session()->flash('etat','Erreur panier non trouvé');
        return redirect('/'); 
    }


}