@extends('layouts.master')

@section('content')
    <div class="position-relative home-header">
        <img src="{{ asset('images/svg/header.svg') }}" alt="">

        <div class="container position-absolute d-flex">
            <img src="{{ asset('images/svg/designers.svg') }}" alt="" class="designers col-6">

            <div class="col-6 slogan text-right">
                <div class="position-relative">
                    <h1>
                        <span>Fresh designs</span><br>
                        <span class="orange">Juiced daily</span>
                    </h1>

                    <p>Get a custom design you’ll love with our global creative platform. YourDesignContest is the best place to find and hire talented designers to grow your business.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
