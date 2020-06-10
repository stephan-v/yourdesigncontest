@extends('layouts.sidebar')

@section('content')
    <h1>Designers only</h1>

    <div class="row mb-5">
        <div class="col-6">
            <div class="card text-center p-4">
                <img src="{{ asset('images/piggybank.png') }}" class="card-img-top p-3" alt="Piggybank">

                <div class="card-body p-0">
                    <b>Available for payout</b>
                    <h2>{{ $user->formattedTotalPayoutAmount }}</h2>
                </div>
            </div>
        </div>

        <div class="col-6">
            <div class="card text-center p-4">
                <img src="{{ asset('images/treasure-chest.png') }}" class="card-img-top p-3" alt="Treasure chest">

                <div class="card-body p-0">
                    <b>Total amount won</b>
                    <h2>{{ $user->formattedTotalPayoutAmount }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center">
        @if (count($user->winnings()))
            <button type="submit" class="btn btn-primary">Request a payout</button>
        @else
            <button type="submit" class="btn btn-secondary mb-3" disabled>Request a payout</button>

            <div class="alert alert-warning" role="alert">
                You can request a payout as soon as you win your first contest.
            </div>
        @endif
    </div>
@endsection
