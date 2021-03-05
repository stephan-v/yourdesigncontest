@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="user-header bg-white mb-5">
            <div class="row">
                <div class="col-md-6 order-md-2">
                    <img src="{{ asset('images/svg/designer.svg') }}" class="position-relative" alt="A designer at work behind a laptop.">
                </div>

                <div class="col-md-6 order-md-1">
                    <div class="p-4 p-md-5">
                        <h1 class="lead">Hello {{ $user->name }}</h1>

                        <p>This user has not written their own personal "about" story yet but we are sure it will be an amazing one.</p>

                        @if (count(Auth::user()->contests))
                            <a href="{{ route('users.invites.create', $user) }}" class="btn btn-primary">
                                Invite to join your contest
                            </a>
                        @endif
                    </div>
                </div>
            </div>
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
