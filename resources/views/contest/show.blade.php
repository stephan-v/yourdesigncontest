@extends('layouts.master')

@section('content')
    <div class="container">
        @if ($contest->finished)
            <div class="alert alert-warning mt-5" role="alert">
                The contest is finished.
                Click <a href="{{ route('contests.files.index', ['contest' => $contest]) }}">here</a> to review the final design files.
            </div>
        @endif

        <div class="row mt-5 mb-5">
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

        @can('submit', $contest)
            <div class="row mb-5">
                <div class="col-md-12 text-center">
                    <a href="{{ route('contests.submissions.create', ['contest' => $contest]) }}" class="btn btn-primary">
                        Add submission
                    </a>
                </div>
            </div>
        @endcan

        <div class="row">
            @foreach ($contest->submissions as $submission)
                <div class="col-md-3">
                    <div class="submission @if ($submission->winner) border border-warning @endif">
                        @if ($submission->winner)
                            <div class="alert alert-warning text-center mb-0" role="alert">Winner!</div>
                        @endif

                        <a href="{{ route('contests.submissions.show', ['contest' => $contest, 'submission' => $submission]) }}"
                           class="p-3 d-flex justify-content-center align-items-center">
                            <img src="{{ asset($submission->path) }}" alt="" class="img-fluid">
                        </a>

                        <div>{{ $submission->rating }}</div>

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
