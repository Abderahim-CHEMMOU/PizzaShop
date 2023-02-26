<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>@yield('title', config('app.name'))</title>
    <style>
        .etat {background-color: lightblue;}
        .error {background-color: lightpink;}


        

    </style>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl"
    crossorigin="anonymous">

</head>
<body>
    @section('menu')
@guest()
    <a href="{{route('login')}}">Login</a>
    <a href="{{route('register')}}">Enregistrement</a>
@endguest
    @auth
        <a href="{{route('logout')}}">Deconnexion</a>
        <p>Bonjour {{ Auth::user() }} {{ AUTH::id() }}</p>
    @endauth
@auth 
<a href="{{route('admin.home')}}">Partie admin</a>
@endauth
    @show
    @section('etat')
        @if (session()->has('etat'))
            <p class="etat">{{ session()->get('etat') }}</p>
        @endif
    @show
    @section('errors')
        @if ($errors->any())
            <div class="error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li> 
                    @endforeach
                </ul>
            </div>
        @endif
        
    @show
    @yield('contents')
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0"
    crossorigin="anonymous"></script>

</body>
</html>