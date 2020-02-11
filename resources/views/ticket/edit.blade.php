@extends('layouts.app')

@section('content')
<div class="container">
    @auth
        <h1>edit</h1>
        <p>{{ $ticket->asker->first_name }} {{ $ticket->asker->last_name }}</p>

        <form method="POST" action="/ticket/{{$ticket->id}}">
            @csrf
            {{method_field('PATCH')}}
            <input id="name" type="text" value="{{ old('name') ? old('name') : $ticket->name }}" class="form-control @error('name') is-invalid @enderror" name="name" required autocomplete="name" placeholder="Titre ticket">
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <textarea id="desc" name="desc" class="form-control @error('desc') is-invalid @enderror" rows="5" cols="33" placeholder="Description">{{ old('desc') ? old('desc') : $ticket->desc }}</textarea>
            @error('desc')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <button type="submit" class="btn btn-primary">
                Edit
            </button>
        </form>
    @endauth
</div>
@endsection
