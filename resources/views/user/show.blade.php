@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row pt-3">
            <div class="col-md-12">
                <h1>{{ $user->name }}</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="card">
                    <div class="card-header">Designers only</div>

                    <div class="card-body">
                        <p>Click here to verify your account for payouts.</p>

                        <a href="{{ route('connect.onboarding') }}">
                            <img src="{{ asset('images/light-on-light.png') }}" alt="">
                        </a>

                        @if ($user->stripe_connect_id)
                            <a href="{{ route('connect.dashboard') }}" class="d-block mt-3 mb-3">
                                Manage your payout settings
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            @if (count(Auth::user()->contests))
                <div class="col-md-6 mb-3">
                    <div class="card">
                        <div class="card-header">Invite designers</div>

                        <div class="card-body">
                            <a href="{{ route('users.invites.create', $user) }}" class="btn btn-primary">
                                Invite this user to your contest
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <div class="row">
            <div class="col-md-12">
                <h2>Submissions</h2>
            </div>
        </div>

        <div class="row">
            @foreach ($submissions as $submission)
                <div class="col-md-3">
                    <div class="submission mb-3">
                        <div class="d-flex align-content-center justify-content-center p-3">
                            <a href="{{ route('contests.show', $submission->contest) }}">
                                <img src="{{ $submission->path }}" alt="" class="img-fluid">
                            </a>
                        </div>

                        <div>
                            {{ $submission->rating }}
                        </div>

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
