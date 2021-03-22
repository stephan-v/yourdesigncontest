@extends('layouts.master')

@section('title', 'Contests')

@section('content')
    <div class="container">
        <div class="row mt-5 mb-3">
            <div class="col-md-6 mb-5">
                <div class="company rounded overflow-hidden">
                    <a href="{{ route('register') }}" class="d-block">
                        <p class="absolute-center text-center text-white">
                            I'm a designer wanting to compete for prizes.
                        </p>

                        <img src="{{ asset('images/company.jpg') }}" alt="" class="img-fluid w-100">
                    </a>
                </div>
            </div>

            <div class="col-md-6 mb-5">
                <div class="designer rounded overflow-hidden">
                    <a href="{{ route('contests.create') }}" class="d-block">
                        <p class="absolute-center text-center text-white">
                            I'm a company looking for a winning design.
                        </p>

                        <img src="{{ asset('images/designer.jpg') }}" alt="" class="img-fluid w-100">
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <section class="contests">
                    <div class="page-header position-relative">
                        <div class="dot-pattern"></div>
                        <h1 class="mb-4">Contests</h1>
                    </div>

                    <div class="d-flex font-weight-bold mb-3 contest-attributes">
                        <span class="col">Name</span>
                        <span class="col-2">Category</span>
                        <span class="col-2">Submissions</span>
                        <span class="col-2">Prize</span>
                        <span class="col-2">Ends in</span>
                    </div>

                    @foreach ($contests as $contest)
                        <a href="{{ route('contests.show', $contest) }}" class="w-100 bg-white py-4 mb-3 rounded d-flex unlink">
                            <span class="col">{{ $contest->title }}</span>
                            <span class="col-2">{{ $contest->category }}</span>
                            <span class="col-2">{{ $contest->submissions->count() }}</span>
                            <span class="col-2">{{ $contest->payment->format }}</span>
                            <span class="col-2">{{ $contest->active ? $contest->endsIn : 'finished' }}</span>
                        </a>
                    @endforeach
                </section>
            </div>
        </div>

        <div class="row mb-5">
            <div class="col-md-12 pt-4 d-flex justify-content-center">
                {{ $contests->links() }}
            </div>
        </div>
    </div>
@endsection
