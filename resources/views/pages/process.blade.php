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

    <div class="process-steps-banner text-white p-3 mb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-3 text-center p-4">
                    <h2>Write a briefing</h2>
                    <p>Let us know your wishes, do's and don'ts. Use examples and clearly state what the assignment is.</p>
                </div>

                <div class="col-md-3 text-center p-4">
                    <h2>Designers compete</h2>
                    <p>Our designers will then post submissions that you can review based on your briefing.</p>
                </div>

                <div class="col-md-3 text-center p-4">
                    <h2>Manage your contest</h2>
                    <p>Communicate with designers, provide feedback and review submissions for the best end result.</p>
                </div>

                <div class="col-md-3 text-center p-4">
                    <h2>Pick a winner</h2>
                    <p>Choose the design that best meets your wishes from the submissions and name it the winner.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="shadow-card bg-white pt-3 pr-3 pb-1 pl-3">
                    <h3 class="ml-3">Contest host</h3>

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Determine your own price</li>
                        <li class="list-group-item">Money back guarantee</li>
                        <li class="list-group-item">Easy communication with designers</li>
                        <li class="list-group-item">Choose from a wide range of designs</li>
                        <li class="list-group-item">Get the design files and ownership agreement</li>
                        <li class="list-group-item">No additional costs after the initial payment</li>
                    </ul>
                </div>
            </div>

            <div class="col-md-6">
                <div class="shadow-card bg-white pt-3 pr-3 pb-1 pl-3">
                    <h3 class="ml-3">Designer</h3>

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">You design we handle the rest</li>
                        <li class="list-group-item">Build a portfolio</li>
                        <li class="list-group-item">Work from wherever you want</li>
                        <li class="list-group-item">Communicate with real clients</li>
                        <li class="list-group-item">Easy way to make some extra money</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
