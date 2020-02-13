@extends('layouts.app')

@section('content')
<div class="container">
    <div>
        <h1>Tags</h1>
        <form method="POST" action="/tag">
            @csrf

            <input id="name" type="text" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" name="name" required autocomplete="name" placeholder="Titre name">
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            
            <input id="color" type="color" value="{{ old('color') }}" class="form-control @error('color') is-invalid @enderror" name="color" required>
            @error('color')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            

            <button type="submit" class="btn btn-primary">
                Create
            </button>

        </form>
        
        <ul>
            @foreach ($tags as $tag)
                <li style="color: {{$tag->color}}">{{ $tag->name }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endsection
