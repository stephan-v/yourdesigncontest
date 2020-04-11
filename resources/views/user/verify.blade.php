@extends('layouts.sidebar')

@section('content')
    <h1>Designers only</h1>

    <p>Click here to verify your account for payouts.</p>

    <a href="{{ $user->onboardingUrl }}">
        <img src="{{ asset('images/light-on-light.png') }}" alt="">
    </a>

    @if ($user->stripe_connect_id)
        <a href="{{ route('connect.dashboard') }}" class="d-block mt-3 mb-3">
            Manage your payout settings
        </a>
    @endif
@endsection
