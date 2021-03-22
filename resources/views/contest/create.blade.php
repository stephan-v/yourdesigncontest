@extends('layouts.master')

@section('title', 'Create contest')

@section('content')
    <div class="container d-flex justify-content-center flex-grow-1 flex-column">
        <div class="row py-5">
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
                        <label for="title">Contest title</label>
                        <input type="text" name="title" class="form-control" id="title" placeholder="Title of your contest" value="{{ old('title', session()->get('contest.title')) }}">
                    </div>

                    <div class="form-group">
                        <label for="name">Contest description</label>
                        <textarea name="description" class="form-control" id="description" rows="8" placeholder="Briefing of your contest">{{ old('description', session()->get('contest.description')) }}</textarea>
                    </div>

                    <div class="mb-2">Select a category</div>

                    <div class="form-group row radio-images">
                        <div class="col-6 col-md-4 mb-3">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="category" value="branding" @if (old('category', session()->get('contest.category')) === 'branding' || !session()->has('contest.category')) checked @endif>
                                <img src="{{ asset('images/categories/branding.png') }}" alt="" class="img-fluid">
                                <div class="category-title bg-white p-3 small font-weight-bold text-center">Branding</div>
                            </label>
                        </div>

                        <div class="col-6 col-md-4 mb-3">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="category" value="webdesign" @if (old('category', session()->get('contest.category')) === 'webdesign') checked @endif>
                                <img src="{{ asset('images/categories/webdesign.png') }}" alt="" class="img-fluid">
                                <div class="category-title bg-white p-3 small font-weight-bold text-center">Webdesign</div>
                            </label>
                        </div>

                        <div class="col-6 col-md-4 mb-3">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="category" value="packaging" @if (old('category', session()->get('contest.category')) === 'packaging') checked @endif>
                                <img src="{{ asset('images/categories/packaging.jpg') }}" alt="" class="img-fluid">
                                <div class="category-title bg-white p-3 small font-weight-bold text-center">Packaging</div>
                            </label>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="expires_at">Expires in</label>
                        <select name="expires_at" class="form-control" id="expires_at">
                            @for ($i = 1; $i <= 4; $i++)
                                <option value="{{ $i }}" @if (old('expires_at', session()->get('contest.expires_at')) == $i) selected @endif>
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
