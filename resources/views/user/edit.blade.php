@extends('layouts.sidebar')

@section('content')
    <div class="container">
        <div class="row pt-5">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-body">
                        <h1 class="font-weight-bold mb-3">Edit your profile</h1>

                        <form action="{{ route('users.update', $user) }}" method="POST" class="d-flex flex-column">
                            @method('PATCH')
                            @csrf

                            <div class="form-group">
                                <label for="name">{{ __('Name') }}</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="file" name="name" value="{{ old('name', $user->name) }}" required autocomplete="name">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="currency">Currency</label>

                                <select name="currency" class="form-control" id="currency">
                                    <option value="eur" @if ($user->currency === old('currency', 'eur')) selected @endif>EUR</option>
                                    <option value="usd" @if ($user->currency === old('currency', 'usd')) selected @endif>USD</option>
                                </select>
                            </div>

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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
