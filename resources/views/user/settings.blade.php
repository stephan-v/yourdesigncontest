@extends('layouts.sidebar')

@section('title', 'Settings')

@section('content')
        <h1>Edit your profile</h1>

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

            <div class="form-group mb-5">
                <label for="currency">Preferred display currency</label>

                <select name="currency" class="form-control" id="currency">
                    <option value="eur" @if ($user->currency === 'EUR') selected @endif>EUR</option>
                    <option value="usd" @if ($user->currency === 'USD') selected @endif>USD</option>
                </select>
            </div>

            <button type="submit" class="btn btn btn-outline-secondary ml-auto">Update profile</button>
        </form>
@endsection
