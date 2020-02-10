@extends('layouts.app')

@section('content')
<div class="container">
    @auth
        <button id="test">Notifier</button>
        <p>T'es sur le dashboard</p>
    @endauth

    <section id="tickets">

    </section>
</div>
@endsection
