@extends('modele')

@section('title', 'Changement de mot de passe')

@section('contents')
    <form action="{{route('admin_profile.update')}}" method="post">
        @method('put')
        
        <p><label for="old_password"> Mot de passe actuel :</label>
        <input type="password" id="old_password" name="old_password"></p>
        
        
        <p><label for="new_password">Nouveau Mot de passe :</label>
        <input type="password" id="new_password" name="new_password"></p>
        

        <p><label for="new_password_confirmation">Confirmation de mot de passe :</label>
        <input type="password" id="new_password_confirmation" name="new_password_confirmation"></p>

        <p><input type="submit" value="Modifier"></p>
        @csrf
    </form>
@endsection
