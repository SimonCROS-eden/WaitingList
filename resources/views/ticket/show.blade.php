@extends('layouts.app')

@section('content')
<div class="container">
    @auth
        <h1>Show</h1>
        <p>{{ $ticket->asker->first_name }} {{ $ticket->asker->last_name }}</p>
        <h2>{{ $ticket->name }}</h2>
        <p>{{ $ticket->desc }}</p>

        @if($ticket->asker == Auth::user())
            <a href="/ticket/{{$ticket->id}}/edit"><button type="button">Edit</button></a>
        @endif
    @endauth
</div>
@endsection
