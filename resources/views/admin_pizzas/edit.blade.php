@extends('modele')

@section('title', 'Modification de nom ou de descriptif')

@section('contents')
    <form action="{{route ( 'admin_pizzas.update',['id'=>$pizza->id] ) }}" method="post">
        @method('put')


         
        <label for="nom">Nom :</label>
        <input type="text" name="nom" id="nom" value="{{old('nom')}}">
                 
        
        <p><label for="description">Description:</label><br/>

        <textarea name="description" id="description" rows="3" cols="30" >{{old('description')}}</textarea></p>

        
        <p><input type="submit" value="Modifier"></p>

        @csrf
    </form>
@endsection
