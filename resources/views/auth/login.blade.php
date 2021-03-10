@extends('layouts.master')

@section('title', 'Login')

@section('content')
    <div class="container d-flex justify-content-center flex-grow-1 flex-column">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="position-relative page-header mb-3">
                    <div class="dot-pattern"></div>
                    <h1>{{ __('Login') }}</h1>
                </div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="{{ __('E-Mail Address') }}" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="{{ __('Password') }}">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group d-flex align-items-center justify-content-between">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>

                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary w-100">
                            {{ __('Login') }}
                        </button>
                    </div>
                </form>

                <div class="socialite mb-3">
                    <div class="mb-3 text-center heading position-relative">OR</div>

                    <a href="{{ route('socialite.login', 'google') }}" class="btn btn-google w-100 d-flex align-items-center justify-content-center">
                        <img src="{{ asset('images/svg/google.svg') }}" alt="Register with Google Icon" class="d-inline mr-3">
                        <span>LOGIN WITH GOOGLE</span>
                    </a>
                </div>

                <a href="{{ route('register') }}" class="text-center d-block">Don't have an account? Register here</a>
            </div>
        </div>
    </div>
@endsection
