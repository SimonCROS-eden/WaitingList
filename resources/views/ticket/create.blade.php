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

            <div class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    choisissez vos tags :
                    <span class="caret"></span>
                </a>

                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    @foreach ($tags as $tag)
                        <div>
                            <label for="tag-{{ $tag->name }}">{{ $tag->name }}</label>
                            <input type="checkbox" id="tag-{{ $tag->name }}" name="tag-{{ $tag->name }}" value="{{ $tag->id }}">
                        </div>
                    @endforeach
                </div>
            </div>

            <button type="submit" class="btn btn-primary">
                Create
            </button>

        </form>
    @endauth
</div>
@endsection
