@extends('layouts.master')

@section('title', 'Register')

@section('content')
    <div class="container d-flex justify-content-center flex-grow-1 flex-column">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="position-relative page-header mb-3">
                    <div class="dot-pattern"></div>
                    <h1>{{ __('Register') }}</h1>
                </div>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-group">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="{{ __('Name') }}">

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="{{ __('E-Mail Address') }}">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="{{ __('Password') }}">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="{{ __('Confirm Password') }}">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary w-100">
                            {{ __('Register') }}
                        </button>
                    </div>
                </form>

                <div class="socialite mb-3">
                    <div class="mb-3 text-center heading position-relative">OR</div>

                    <a href="{{ route('socialite.login', 'google') }}" class="btn btn-google w-100 d-flex align-items-center justify-content-center">
                        <img src="{{ asset('images/svg/google.svg') }}" alt="Register with Google Icon" class="d-inline mr-3">
                        <span>REGISTER WITH GOOGLE</span>
                    </a>
                </div>

                <a href="{{ route('login') }}" class="text-center d-block">I have an account. Sign in.</a>
            </div>
        </div>
    </div>
@endsection
