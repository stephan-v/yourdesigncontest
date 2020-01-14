@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-6">
                <div class="company">
                    <p class="absolute-center text-center text-white">
                        I'm a designer who wants to join in design contests for prices.
                    </p>

                    <img src="/images/company.jpg" alt="" class="img-fluid w-100">
                </div>
            </div>

            <div class="col-md-6">
                <div class="designer">
                    <p class="absolute-center text-center text-white">
                        I'm a company looking for a winning design.
                    </p>
                    
                    <img src="/images/designer.jpg" alt="" class="img-fluid w-100">
                </div>
            </div>
        </div>

        <div class="row pt-5">
            <div class="col-md-8 offset-md-2">
                <h1>Contests</h1>

                @foreach ($contests as $contest)
                    {{ $contest->name }}
                @endforeach
            </div>
        </div>
    </div>
@endsection
