@extends('layouts.app')

@section('content')
<div class="container">
    <button id="test">Notifier</button>
    <p>T'es sur le dashboard</p>

    <section id="tickets">

    </section>
    <hr/>
    <hr/>
    <hr/>
    @foreach($tickets as $ticket)
        <a href="/ticket/{{ $ticket->id }}"><p>{{ $ticket->name }}</p></a>
    @endforeach
</div>
@endsection
