@extends('layouts.sidebar')

@section('title', 'Payout')

@section('content')
    <h1>Designers only</h1>

    <div class="row mb-3">
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

    @if (count($user->winnings()))
        <div class="card">
            <div class="card-body">
                <div class="alert alert-warning" role="alert">
                    <b>Make sure the below credentials are correct.</b>
                    <hr>
                    You will receive an email prompting to fill out the rest of
                    your payout credentials.
                </div>

                <form method="POST" action="{{ route('request.payout') }}">
                    @csrf

                    <div class="form-group">
                        <label for="currency">Payout currency</label>

                        <select name="currency" class="form-control" id="currency">
                            @foreach ($currencies as $currency)
                                <option value="{{ $currency->code }}" @if (old('currency') == $currency->code) selected @endif>
                                    {{ $currency->code }} ({{ $currency->name }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label for="name">Account holder name</label>
                        <input id="holder" type="text" class="form-control @error('holder') is-invalid @enderror" name="holder" value="{{ old('holder') }}" placeholder="Your name as stated on your bank account." required>
                    </div>

                    <button type="submit" class="btn btn-primary">Request a payout</button>
                </form>
            </div>
        </div>
    @else
        <div class="alert alert-warning" role="alert">
            You can request a payout as soon as you win your first contest.
        </div>
    @endif
@endsection
