@extends('layouts.master')

@section('content')
    <div class="main-banner process-banner w-100">
        <div class="container d-flex align-items-center justify-content-center text-center h-100">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <h1 class="text-white">A smooth collaboration between companies and designers in four simple steps.</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="process-steps-banner bg-white p-3 mb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-3 text-center p-4">
                    <img src="{{ asset('images/svg/034-poster.svg') }}" alt="" class="img-fluid mb-3">
                    <h2>Write a briefing</h2>
                    <p>Let us know your wishes, do's and don'ts. Use examples and clearly state what the assignment is.</p>
                </div>

                <div class="col-md-3 text-center p-4">
                    <img src="{{ asset('images/svg/050-tablet pen.svg') }}" alt="" class="img-fluid mb-3">
                    <h2>Designers compete</h2>
                    <p>Our designers will then post submissions that you can review based on your briefing.</p>
                </div>

                <div class="col-md-3 text-center p-4">
                    <img src="{{ asset('images/svg/030-website.svg') }}" alt="" class="img-fluid mb-3">
                    <h2>Manage your contest</h2>
                    <p>Communicate with designers, provide feedback and review submissions for the best end result.</p>
                </div>

                <div class="col-md-3 text-center p-4">
                    <img src="{{ asset('images/svg/042-payment.svg') }}" alt="" class="img-fluid mb-3">
                    <h2>Pick a winner</h2>
                    <p>Choose the design that best meets your wishes from the submissions and name it the winner.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container pros-list">
        <div class="row">
            <div class="col-md-6">
                <div class="shadow-card bg-white pt-3 pr-3 pb-1 pl-3 text-center">
                    <h3 class="ml-3">Contest host</h3>

                    <ul class="list-group list-group-flush mb-3 text-left">
                        <li class="list-group-item">
                            <i class="far fa-check-circle mr-1 success"></i> Determine your own price
                        </li>

                        <li class="list-group-item">
                            <i class="far fa-check-circle mr-1 success"></i> Money back guarantee
                        </li>

                        <li class="list-group-item">
                            <i class="far fa-check-circle mr-1 success"></i> Easy communication with designers
                        </li>

                        <li class="list-group-item">
                            <i class="far fa-check-circle mr-1 success"></i> Choose from a wide range of designs
                        </li>

                        <li class="list-group-item">
                            <i class="far fa-check-circle mr-1 success"></i> Get the design files and ownership agreement
                        </li>

                        <li class="list-group-item border-0">
                            <i class="far fa-check-circle mr-1 success"></i> No additional costs after the initial payment
                        </li>
                    </ul>

                    <a class="btn btn-primary mb-3" href="{{ route('contests.create') }}" role="button">Create a contest</a>
                </div>
            </div>

            <div class="col-md-6">
                <div class="shadow-card bg-white pt-3 pr-3 pb-1 pl-3 text-center">
                    <h3 class="ml-3">Designer</h3>

                    <ul class="list-group list-group-flush mb-3 text-left">
                        <li class="list-group-item">
                            <i class="far fa-check-circle mr-1 success"></i> You design we handle the rest
                        </li>

                        <li class="list-group-item">
                            <i class="far fa-check-circle mr-1 success"></i> Build a portfolio
                        </li>

                        <li class="list-group-item">
                            <i class="far fa-check-circle mr-1 success"></i> Work from wherever you want
                        </li>

                        <li class="list-group-item">
                            <i class="far fa-check-circle mr-1 success"></i> Communicate with real clients
                        </li>

                        <li class="list-group-item border-0">
                            <i class="far fa-check-circle mr-1 success"></i> Easy way to make some extra money
                        </li>
                    </ul>

                    <a class="btn btn-primary mb-3" href="{{ route('contests.index')  }}" role="button">View all contests</a>
                </div>
            </div>
        </div>
    </div>
@endsection
