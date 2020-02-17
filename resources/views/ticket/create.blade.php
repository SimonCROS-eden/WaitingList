@extends('layouts.app')

@section('content')
<div class="container d-flex align-items-center justify-content-center">
    <div class="row justify-content-center w-100">
        <div class="col-md-7">
            <div class="card">
                <div class="card-body text-center">
                    <h1 class="text-primary">{{ __('Création ticket') }}</h1>

                    <form class="text-left" method="POST" action="/ticket">
                        @csrf

                        <div class="form-group col">
                            <label for="title" class="col-md-4 px-3 col-form-label">{{ __('Titre ticket') }}</label>

                            <div>
                                <input id="title" type="text" value="{{ old('title') }}" class="form-control @error('title') is-invalid @enderror" name="title" required autocomplete="title" placeholder="Titre">

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group col">
                            <label for="desc" class="col-md-4 px-3 col-form-label">{{ __('Description ticket') }}</label>

                            <div>
                                <textarea id="desc" name="desc" class="form-control @error('desc') is-invalid @enderror" rows="5" cols="33" placeholder="Description">{{ old('desc') }}</textarea>

                                @error('desc')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="dropdown col mb-4">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                choisissez vos tags :
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                @foreach ($tags as $tag)
                                    <div class="dropdown-item">
                                        <label for="tag-{{ $tag->name }}">{{ $tag->name }}</label>
                                        <input type="checkbox" id="tag-{{ $tag->name }}" name="tag-{{ $tag->name }}" value="{{ $tag->id }}">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        
                        <div class="col">
                            <div class="form-group row m-0 justify-content-between">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
