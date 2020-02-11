@extends('layouts.app')

@section('content')
<div class="container">
    @auth
        <h1>Show</h1>
        {{-- <p>{{ $ticket->name }}</p> --}}
        {{ $ticket->asker->last_name }}
    @endauth
</div>
@endsection
