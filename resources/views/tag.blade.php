@extends('layouts.app')

@section('content')
<div class="container">
    <div class="pt-5">
        <div class="d-flex justify-content-between mb-5">
            <h1 class="">Tags</h1>
            <div class="d-flex align-items-center">
                <form class="d-flex align-items-center" method="POST" action="/tag">
                    @csrf

                    <input id="name" type="text" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" name="name" required autocomplete="name" placeholder="Nom tag">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    
                    <input id="color" type="color" value="{{ old('color') }}" class="input-button @error('color') is-invalid @enderror" name="color" required>
                    @error('color')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <button type="submit" class="btn btn-primary">
                        Create
                    </button>
                </form>
            </div>
            
        </div>
        
        <div>
            @foreach ($tags as $tag)
            <div class="d-inline">
                <p class="tags mb-2 mr-1 px-3 py-2 badge text text-white" style="background-color: {{ $tag->color }}">{{ $tag->name }}</p>
                <div class="mr-1 mb-2 px-3 py-1 badge text-white" style="display:none; border: solid 1px {{ $tag->color }}">
                    <div class="d-flex align-items-center">
                        <form class="d-flex mr-2" action="/tag/{{ $tag->id }}" method="post">
                            @csrf
                            @method('PUT')
                            <input id="{{ $tag->name }}" type="text" value="{{ $tag->name }}" class="border-0 text @error('name') is-invalid @enderror" name="{{ $tag->name }}" required autocomplete="name">

                            <input class="input-button" id="{{ $tag->color }}" type="color" value="{{ old('color') ? old('color') : $tag->color }}" class="@error('color') is-invalid @enderror" name="{{ $tag->color }}" required>

                            <button class="input-button" style="color: {{ $tag->color }}" type="submit">ok</button>
                        </form>
                        <form action="/tag/{{ $tag->id }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="input-button text-danger" type="submit">delete</button>
                        </form>
                    </div>
                </div>
            </div>
                
            @endforeach
        </div>
        
    </div>
</div>
@endsection
