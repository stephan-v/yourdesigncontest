@extends('layouts.master')

@section('title', 'Contact')

@section('content')
    <div class="container contact-page d-flex justify-content-center flex-grow-1 flex-column">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="page-header position-relative">
                    <div class="dot-pattern"></div>
                    <h1 class="mb-3">Contact us</h1>
                </div>

                <p>We take our commitment to our users seriously. <br>
                If you need help with your user account, have questions about how to use the platform <br>
                or are experiencing technical difficulties, please do not hesitate to contact us.</p>

                @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif

                <form action="{{ route('contact.mail') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="inputAddress">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="inputAddress" name="name" value="{{ old('name') }}" autocomplete="name">

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" aria-describedby="emailHelp" name="email" value="{{ old('email') }}" autocomplete="email">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea class="form-control @error('message') is-invalid @enderror" id="message" rows="6" name="message">{{ old('message') }}</textarea>

                        @error('message')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Let's talk</button>
                </form>
            </div>
        </div>
    </div>
@endsection
