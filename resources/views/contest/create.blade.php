@extends('layouts.master')

@section('content')
    <div class="container d-flex justify-content-center flex-grow-1 flex-column">
        <div class="row pt-5">
            <div class="col-md-5 order-md-1 order-first mb-5">
                <img src="{{ asset('images/contest.png') }}" alt="" class="img-fluid d-flex m-auto">
            </div>

            <div class="col-md-7 order-md-0 order-last">
                <div class="page-header position-relative">
                    <div class="dot-pattern"></div>
                    <h1>Start a contest</h1>
                </div>

                <p>Designers from around the world review your design brief and submit unique ideas. You provide feedback, hone your favorites and choose a winner.</p>

                <form action="{{ route('contests.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="name">Contest name</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Name of your contest" value="{{ old('name') }}">
                    </div>

                    <div class="form-group">
                        <label for="name">Contest description</label>
                        <textarea name="description" class="form-control" id="description" rows="8" placeholder="Briefing of your contest" value="{{ old('description') }}"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="category">Category</label>
                        <select name="category" class="form-control" id="category">
                            <option value="branding" @if (old('branding')) selected @endif>Branding</option>
                            <option value="webdesign" @if (old('webdesign')) selected @endif>Webdesign</option>
                            <option value="packaging" @if (old('packaging')) selected @endif>Packaging</option>
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label for="expires_at">Expires in</label>
                        <select name="expires_at" class="form-control" id="expires_at">
                            @for ($i = 1; $i <= 4; $i++)
                                <option value="{{ $i }}" @if (old('expires_at') == $i) selected @endif>
                                    {{ $i }} {{ Str::plural('week', $i) }}
                                </option>
                            @endfor
                        </select>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <button type="submit" class="btn btn-primary w-100">Next</button>
                </form>
            </div>
        </div>
    </div>
@endsection
