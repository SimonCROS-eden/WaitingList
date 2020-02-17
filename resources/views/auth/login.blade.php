@extends('layouts.app')

@section('content')
<div class="container d-flex align-items-center justify-content-center">
    <div class="row justify-content-center w-100">
        <div class="col-md-7">
            <div class="card">
                <div class="card-body text-center">
                    <h1 class="text-primary">{{ __('Login') }}</h1>
                    <form class="text-left" method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group col">
                            <label for="email" class="col-md-4 px-3 col-form-label">{{ __('E-Mail Address') }}</label>

                            <div>
                                <input id="email" type="email" class="form-control px-3 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group col">
                            <label for="password" class="col-md-4 px-3 col-form-label">{{ __('Password') }}</label>

                            <div>
                                <input id="password" type="password" class="form-control px-3 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group col m-0 mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                        
                        <div class="col">
                            <div class="form-group row m-0 justify-content-between">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                <p class="m-0 d-flex align-items-center">
                                    Vous n'avez pas de compte ?
                                    <a class="btn btn-link p-0 pl-2" href="{{ route('register') }}">
                                        {{ __('Créez en un !') }}
                                    </a>
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
