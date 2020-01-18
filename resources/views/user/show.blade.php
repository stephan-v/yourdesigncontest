@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row pt-3">
            <div class="col-md-12">
                <h1>{{ $user->name }}</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <h2>Your submissions</h2>
            </div>
        </div>

        <div class="row">
            @foreach ($user->contests->flatMap->submissions as $submission)
                <div class="col-md-3">
                    <div class="submission ">
                        <div class="d-flex align-content-center justify-content-center p-3">
                            <a href="{{ route('contests.show', ['contest' => $submission->contest]) }}">
                                <img src="{{ asset($submission->file) }}" alt="" class="img-fluid">
                            </a>
                        </div>

                        <div>
                            {{ $submission->rating }}
                        </div>

                        <div class="caption p-3 border-top">
                            <small class="text-muted">
                                <span>Contest:</span>

                                <a href="{{ route('contests.show', ['contest' => $submission->contest]) }}">
                                    {{ $submission->contest->name }}
                                </a>
                            </small>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection