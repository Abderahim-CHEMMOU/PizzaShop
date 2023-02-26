@extends('modele')

@section('title', 'Suppression des pizzas du panier')

@section('contents')
    <form action="{{route ( 'user_pizzas.destroy',['id'=>$pizza] ) }}" method="post">
        @method('delete')
        
        <p>Nom : {{$pizza->nom}}</p>
        <p>Description  : {{$pizza->description}}</p>
        
        <p>Supprimmer pizza dans le pannier</p>
        <input type="submit" value="Supprimer" />

        @csrf
    </form>
@endsection
