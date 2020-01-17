@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row pt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center">
                        Briefing
                    </div>

                    <div class="card-body">
                        <h1>{{ $contest->name }}</h1>
                        <p>{{ $contest->description }}</p>
                        <p>{{ $contest->transaction->payout }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <p>Add submission</p>
            </div>
        </div>

        <div class="row">
            @foreach ($contest->submissions as $submission)
                <div class="col-md-3">
                    <div class="submission ">
                        <div class="d-flex align-content-center justify-content-center p-3">
                            <img src="{{ asset($submission->file) }}" alt="" class="img-fluid">
                        </div>

                        <div class="caption p-3 border-top">
                            {{ $contest->user->name }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
