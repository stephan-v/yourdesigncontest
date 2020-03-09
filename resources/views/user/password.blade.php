@extends('layouts.sidebar')

@section('content')
    <h1>Edit your profile</h1>

    <form action="{{ route('users.update.password', $user) }}" method="POST" class="d-flex flex-column">
        @method('PATCH')
        @csrf

        <div class="form-group">
            <label for="password">{{ __('Password') }}</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group mb-5">
            <label for="password-confirm">{{ __('Confirm Password') }}</label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
        </div>

        <button type="submit" class="btn btn btn-outline-secondary ml-auto">Update profile</button>
    </form>
@endsection
