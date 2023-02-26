@extends('modele')

@section('contents')
    <p>Enregistrement</p>
    <form method="post">
        <p><label for="nom">Nom :</label>
        <input type="text" name="nom" id="nom" value="{{old('nom')}}"></p>
        
        <p><label for="prenom">Prenom :</label>
        <input type="text" name="prenom" id="prenom" value="{{old('prenom')}}"></p>
        
        <p><label for="login">Login :</label>        
        <input type="text" name="login" id="login" value="{{old('login')}}"></p>
        
        <p><label for="mdp">Mot de passe :</label>
        <input type="password" id="mdp" name="mdp"></p>
        

        <p><label for="mdp_confirmation">Confirmation de mot de passe :</label>
        <input type="password" id="mdp_confirmation" name="mdp_confirmation"></p>
        
        <input type="submit" value="Envoyer">
        @csrf
    </form>
@endsection
