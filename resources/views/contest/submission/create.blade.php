@extends('layouts.master')

@section('title', 'Create submission')

@section('content')
    <div class="container">
        <form action="{{ route('contests.submissions.store', $contest) }}" enctype="multipart/form-data" method="POST" class="row mt-5">
            @csrf

            <div class="col-md-8">
                <div class="form-group position-relative">
                    <croppie class="@error('image') is-invalid @enderror"></croppie>

                    @error('image')
                        <span class="invalid-feedback mt-2" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="col-md-4">
                <h1>Add a submission</h1>

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                           placeholder="The title of your submission"
                           id="title"
                           name="title"
                           value="{{ old('title') }}">

                    @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                 <div class="form-group">
                    <label for="description">Description (Optional)</label>
                    <textarea class="form-control @error('description') is-invalid @enderror"
                              placeholder="The motivation behind your design"
                              id="description"
                              rows="3"
                              name="description">{{ old('description') }}</textarea>

                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <ul class="pl-3">
                    <li>This is my own work.</li>
                    <li>I did not use clip or stock art.</li>
                </ul>

                <div class="form-group form-check">
                    <input class="form-check-input @error('terms') is-invalid @enderror" type="checkbox" id="terms" name="terms" value="1" @if(old('terms')) checked @endif>
                    <label class="form-check-label" for="terms">
                        I agree to the terms.
                    </label>

                    @error('terms')
                        <span class="invalid-feedback" role="alert">
                            You must agree before submitting.
                        </span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Upload submission</button>
            </div>
        </form>
    </div>
@endsection
