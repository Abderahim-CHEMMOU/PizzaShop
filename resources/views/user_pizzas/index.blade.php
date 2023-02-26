@extends('modele')

@section('title', 'Liste des pizzas')


@section('contents')
    <ul>
        @foreach($pizzas as $p)
        <li>
            @isset($p->nom) {{$p->nom}} @endisset | @isset($p->description) {{$p->description}} @endisset | @isset($p->prix) {{$p->prix}} @endisset | @isset($p->created_at) {{$p->created_at}} @endisset | @isset($p->updated_at) {{$p->updated_at}} @endisset | @isset($p->deleted_at) {{$p->deleted_at}} @endisset    
        </li>  
        @endforeach
    </ul>
    
    {{$pizzas->links()}}

@endsection

