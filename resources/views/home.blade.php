@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center">
    <div class="col-md-9 mb-5">
        <h1 class="text-primary text-center mb-4">Waiting List</h1>
        <p class="text-justify">Waiting List est un site à destination des élèves d'EDEN School, il permet l'entraide entre élèves et professeurs et procure un espace de travaille plus calme. Créez votre compte et posez des questions sous forme de tiquet pour la faire apparaître sur le fil des demandes. Prenez en chrage des questions pour aider vos camarades et faire augmenter votre réputation !</p>
        <div class="d-flex flex-column flex-sm-row justify-content-around  mt-4">
            <a href="{{route('login')}}" class="mt-3 mt-sm-0 col-12 col-sm-3 btn btn-primary">Connexion</a>
            <a href="{{route('register')}}" class="col-12 col-sm-3 btn btn-primary">Inscription</a>
        </div>
    </div>
</div>
@endsection
