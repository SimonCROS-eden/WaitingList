@extends('layouts.app')

@section('content')
<div class="container d-flex align-items-center justify-content-center">
    <div class="row justify-content-center w-100">
        <div class="col-md-7">
            <div class="card">
                <div class="card-body text-center">
                    <h1 class="text-primary mb-3">{{ __('Register') }}</h1>

                    <form class="text-left" method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group col mb-2">
                            <label for="first_name" class="col-md-6 px-3 col-form-label">{{ __('Prénom') }}</label>

                            <div>
                                <input id="first_name" type="first_name" class="form-control px-3 @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="name" autofocus placeholder="Prénom">

                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group col mb-2">
                            <label for="last_name" class="col-md-6 px-3 col-form-label">{{ __('Nom') }}</label>

                            <div>
                                <input id="last_name" type="last_name" class="form-control px-3 @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="name" autofocus placeholder="Nom">

                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group col mb-2">
                            <label for="email" class="col-md-6 px-3 col-form-label">{{ __('E-Mail Address') }}</label>

                            <div>
                                <input id="email" type="email" class="form-control px-3 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group col mb-2">
                            <label for="password" class="col-md-6 px-3 col-form-label">{{ __('Password') }}</label>

                            <div>
                                <input id="password" type="password" class="form-control px-3 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group col mb-2">
                            <label for="password-confirm" class="col-md-6 px-3 col-form-label">{{ __('Password-confirm') }}</label>

                            <div>
                                <input id="password-confirm" type="password-confirm" class="form-control px-3 @error('password-confirm') is-invalid @enderror" name="password-confirm" required autocomplete="new-password" placeholder="Password-confirm">

                                @error('password-confirm')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col pt-3">
                            <div class="form-group row m-0 justify-content-between">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>

                                <p class="m-0 d-flex align-items-center">
                                    Vous avez déjà un compte ?
                                    <a class="btn btn-link p-0 pl-2" href="{{ route('register') }}">
                                        {{ __('Connectez-vous !') }}
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
