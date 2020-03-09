@extends('layouts.sidebar')

@section('content')
    <div class="container">
        <div class="row pt-3">
            <div class="col-md-12">
                <h1>{{ $user->name }}</h1>
            </div>
        </div>

        <div class="row">
            @if (count(Auth::user()->contests))
                <div class="col-md-6 mb-3">
                    <a href="{{ route('users.invites.create', $user) }}" class="btn btn-primary">
                        Invite this user to join your contest
                    </a>
                </div>
            @endif
        </div>

        <div class="row">
            <div class="col-md-12">
                <h2 class="mb-3">Portfolio</h2>
            </div>
        </div>

        <div class="row">
            @foreach ($submissions as $submission)
                <div class="col-md-3">
                    <div class="submission mb-3">
                        <a href="{{ route('contests.show', $submission->contest) }}">
                            <picture class="intrinsic intrinsic--4x3">
                                <img src="{{ $submission->path }}" alt="" class="intrinsic-item">
                            </picture>
                        </a>

                        <div class="caption p-3 border-top">
                            <small class="text-muted">
                                <span>Contest:</span>

                                <a href="{{ route('contests.show', $submission->contest) }}">
                                    {{ $submission->contest->name }}
                                </a>
                            </small>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="row">
            <div class="col-md-12 pt-4 pb-3 d-flex justify-content-center">
                {{ $submissions->links() }}
            </div>
        </div>
    </div>
@endsection
