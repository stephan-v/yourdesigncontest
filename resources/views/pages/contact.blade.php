@extends('layouts.master')

@section('content')
    <div class="container contact-page mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">
                        <h1 class="mb-0 text-center">{{ __('messages.contact.banner') }}</h1>
                    </div>

                    <div class="card-body">
                        @if (session('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                        @endif

                        <form action="{{ route('contact.mail') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="inputAddress">{{ __('common.name') }}</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="inputAddress" placeholder="{{ __('common.enter_name') }}" name="name" value="{{ old('name') }}">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">{{ __('common.email') }}</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" aria-describedby="emailHelp" placeholder="{{ __('common.enter_email') }}" name="email" value="{{ old('email') }}">
                                <small id="emailHelp" class="form-text text-muted">{{ __('messages.contact.privacy') }}.</small>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="message">{{ __('common.message') }}</label>
                                <textarea class="form-control @error('message') is-invalid @enderror" id="message" rows="3" name="message">{{ old('message') }}</textarea>

                                @error('message')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">{{ __('common.send_message') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
