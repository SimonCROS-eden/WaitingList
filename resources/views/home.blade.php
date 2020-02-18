@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center">
    <div class="col-md-9 mb-5">
        <h1 class="text-primary text-center mb-4">Waiting List</h1>
        <p class="text-justify">Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n'a pas fait que survivre cinq siècles, mais s'est aussi adapté à la bureautique informatique, sans que son contenu n'en soit modifié. Il a été popularisé dans les années 1960 grâce à la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus récemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker.</p>
        <div class="d-flex justify-content-around mt-4">
            <a href="{{route('register')}}"><button class="btn btn-primary" type="button">Register</button></a>
            <a href="{{route('login')}}"><button class="btn btn-primary" type="button">Login</button></a>
        </div>
    </div>
</div>
@endsection
