@extends('modele')

@section('title', 'Modification de la quantité des pizzas dans le panier')

@section('contents')
    <form action="{{route ( 'user_pizzas.update',['id'=>$pizza_qte[0]->id] ) }}" method="post">
        @method('put')

        
         
        
        <p>Nom : {{$pizza_qte[0]->nom}}</p>
        <p>Quantité actuel  : {{$pizza_qte[1]}}</p>
        {{dd('errror')}}
        <p><label for="qte">Modifier Quantité :</label>
        <input type="integer" name="qte" id="qte" value="{{old('qte')}}"></p>
        <p><input type="submit" value="Modifier"></p>

        @csrf
    </form>
@endsection
