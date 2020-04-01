@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row pt-5">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-body">
                        <h1>Start a design contest</h1>

                        <form action="{{ route('contests.store') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="name">Contest name</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Name of your contest" value="{{ old('name') }}">
                                <small class="form-text text-muted">Please provide the name of your design contest.</small>
                            </div>

                            <div class="form-group">
                                <label for="name">Contest description</label>
                                <textarea name="description" class="form-control" id="description" rows="5" placeholder="Briefing of your contest" value="{{ old('description') }}"></textarea>
                                <small class="form-text text-muted">Please provide a short briefing for your design contest.</small>
                            </div>

                            <div class="form-group">
                                <label for="category">Category</label>
                                <select name="category" class="form-control" id="category">
                                    <option value="branding" @if (old('branding')) selected @endif>Branding</option>
                                    <option value="webdesign" @if (old('webdesign')) selected @endif>Webdesign</option>
                                    <option value="packaging" @if (old('packaging')) selected @endif>Packaging</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="expires_at">Expires in</label>
                                <select name="expires_at" class="form-control" id="expires_at">
                                    @for ($i = 1; $i <= 4; $i++)
                                        <option value="{{ $i }}" @if (old('expires_at') == $i) selected @endif>
                                            {{ $i }} {{ Str::plural('week', $i) }}
                                        </option>
                                    @endfor
                                </select>
                            </div>

                            <div class="form-group">
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                    <label class="form-check-label" for="defaultCheck1">Blind contest</label>
                                </div>

                                <div class="alert alert-info small">
                                    In a blind contest, designers are only able to view their own entries. They will still be able to see the star rating of each design, but they won’t be able to see any designs that aren’t theirs.
                                </div>
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

                            <button type="submit" class="btn btn-primary">Next</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
