@extends('modele')

@section('title', 'Ajouter une pizza au pannier')

@section('contents')

    <!-- Formulaire de pannier -->
    <ul>     
    @foreach($pizzas as $p)      
    <form action="{{route('user_pizzas.store')}}" method="post">

        <input type="hidden" name="pizza_id" value="{{$p->id}}">
        <input type="hidden" name="commmande_valide" value="0">
        <p><li>Nom: {{$p->nom}} | Description: {{$p->description}}</li></p>
        Quantité: <input type="integer" name="qte" value="{{old('qte')}}">
        <input type="submit" name="submit1" value="Ajouter au pannier">

        @csrf
    </form>
    @endforeach
    </ul>

    <!-- Formulaire de validation de commmande -->
    <form action="{{route('user_pizzas.store')}}" method="post">

        <input type="hidden" name="commmande_valide" value="1">    
        <input type="submit" name="submit2" value="Validez la commande">

    @csrf
    </form>


@endsection