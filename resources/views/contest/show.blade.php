@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row pt-5 mb-5">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header text-center">
                        Briefing
                    </div>

                    <div class="card-body">
                        <h1>{{ $contest->name }}</h1>
                        <p>{{ $contest->description }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-right">
                    <div class="card-header">Payout</div>

                    <div class="card-body">
                        <p class="mb-0 payout">{{ $contest->transaction->payout }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-5">
            <div class="col-md-12 text-center">
                <a href="{{ route('contests.submissions.create', ['contest' => $contest]) }}" class="btn btn-primary">
                    Add submission
                </a>
            </div>
        </div>

        <div class="row">
            @foreach ($contest->submissions as $submission)
                <div class="col-md-3">
                    <div class="submission ">
                        <div class="d-flex align-content-center justify-content-center p-3">
                            <a href="{{ route('contests.submissions.show', ['contest' => $contest, 'submission' => $submission]) }}">
                                <img src="{{ asset($submission->file) }}" alt="" class="img-fluid">
                            </a>
                        </div>

                        <div>
                            {{ $submission->rating }}
                        </div>

                        <div class="caption p-3 border-top">
                            <small class="text-muted">
                                <span>By:</span>

                                <a href="{{ route('users.show', ['user' => $contest->user]) }}">
                                    {{ $contest->user->name }}
                                </a>
                            </small>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
