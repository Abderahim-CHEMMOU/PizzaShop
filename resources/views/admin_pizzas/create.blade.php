@extends('modele')

@section('title', 'Ajouter une pizzas')

@section('contents')
    <form  action="{{route('admin_pizzas.store')}}" method="post">
        Nom: <input type="text" name="nom" value="{{old('nom')}}">
        Description: <input type="text" name="description" value="{{old('description')}}">
        Prix: <input type="number" name="prix" value="{{old('prix')}}" step=".01">
        <input type="submit" value="Envoyer">
        @csrf
    </form>
@endsection
