@extends('layouts.app')

@section('content')
<div class="container">
    @auth
        <h1>Create</h1>
        <form method="POST" action="/ticket">
            @csrf

            <input id="title" type="text" value="{{ old('title') }}" class="form-control @error('title') is-invalid @enderror" name="title" required autocomplete="title" placeholder="Titre ticket">
            @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <textarea id="desc" name="desc" class="form-control @error('desc') is-invalid @enderror" rows="5" cols="33" placeholder="Description">{{ old('desc') }}</textarea>
            @error('desc')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <button type="submit" class="btn btn-primary">
                Create
            </button>

        </form>
    @endauth
</div>
@endsection
