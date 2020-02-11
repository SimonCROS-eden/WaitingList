@extends('layouts.app')

@section('content')
<div class="container">
    <button id="test">Notifier</button>
    <p>T'es sur le dashboard</p>
    @foreach($tickets as $ticket)
        <a href="/ticket/{{ $ticket->id }}"><p>{{ $ticket->name }}</p></a>
    @endforeach
</div>
@endsection
