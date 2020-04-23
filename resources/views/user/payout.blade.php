@extends('layouts.sidebar')

@section('content')
    <h1>Designers only</h1>

    <p>Available for payout</p>

    <h2 class="mb-3">{{ $user->formattedTotalPayoutAmount }}</h2>

    @if ($user->payouts()->pending()->count())
        <button type="submit" class="btn btn-primary">Request a payout</button>
    @else
        <button type="submit" class="btn btn-secondary mb-3" disabled>Request a payout</button>

        <div class="alert alert-warning" role="alert">
            You can request a payout as soon as you win your first contest.
        </div>
    @endif
@endsection
