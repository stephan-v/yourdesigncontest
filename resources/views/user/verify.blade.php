@extends('layouts.sidebar')

@section('content')
    <div class="container">
        <div class="row pt-5">
            <div class="col-md-8 offset-md-2">
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
        </div>
    </div>
@endsection
