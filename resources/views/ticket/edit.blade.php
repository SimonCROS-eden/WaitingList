@extends('layouts.app')

@section('content')
<div class="container d-flex align-items-center justify-content-center">
    <div class="row justify-content-center w-100">
        <div class="col-md-7">
            <div class="card">
                <div class="card-body text-center">
                    <h1 class="text-primary">{{ __('Modification') }}</h1>

                    <form class="text-left" method="POST" action="/ticket/{{$ticket->id}}">
                        @csrf
                        @method('PATCH')

                        <div class="form-group col">
                            <label for="title" class="col-md-12 px-3 col-form-label">{{ __('Titre tiquet') }}</label>

                            <div>
                                <input id="title" type="text" value="{{ old('title') ? old('title') : $ticket->title }}" class="form-control @error('title') is-invalid @enderror" name="title" required autocomplete="title" placeholder="Titre ticket">
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group col">
                            <label for="desc" class="col-md-12 px-3 col-form-label">{{ __('Description tiquet') }}</label>

                            <div>
                                <textarea id="desc" name="desc" class="form-control @error('desc') is-invalid @enderror" rows="5" cols="33" placeholder="Description">{{ old('desc') ? old('desc') : $ticket->desc }}</textarea>
                                @error('desc')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group col">
                            @foreach ($ticket->tags as $tag)
                                <p style="background-color: {{ $tag->color }}" class="badge mr-1 mb-1 py-2 px-3 text-white">{{ $tag->name }}</p>
                            @endforeach
                        </div>

                        <div class="dropdown col mb-4">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Choisissez vos étiquettes
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                @foreach ($allTags as $oneTag)
                                    <div class="dropdown-item">
                                        <label for="tag-{{ $oneTag->name }}">{{ $oneTag->name }}</label>
                                        <input type="checkbox" id="tag-{{ $oneTag->name }}" name="tag-{{ $oneTag->name }}" value="{{ $oneTag->id }}" {{ in_array($oneTag->id, $ticket->tags->pluck("id")->toArray()) == 1 ? 'checked' : "" }}>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        
                        <div class="col">
                            <div class="form-group row m-0 justify-content-between">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Modifier') }}
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
