@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row pt-5">
            <div class="col-md-8 offset-md-2">
                <h1>{{ $contest->name }}</h1>
                <p>{{ $contest->description }}</p>
                <p>{{ $contest->transaction->payout }}</p>
            </div>
        </div>
    </div>
@endsection
