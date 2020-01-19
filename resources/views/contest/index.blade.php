@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-6">
                <div class="company">
                    <a href="{{ route('register') }}" class="d-block">
                        <p class="absolute-center text-center text-white">
                            I'm a designer who wants to join in design contests for prices.
                        </p>

                        <img src="/images/company.jpg" alt="" class="img-fluid w-100">
                    </a>
                </div>
            </div>

            <div class="col-md-6">
                <div class="designer">
                    <a href="{{ route('register') }}" class="d-block">
                        <p class="absolute-center text-center text-white">
                            I'm a company looking for a winning design.
                        </p>

                        <img src="/images/designer.jpg" alt="" class="img-fluid w-100">
                    </a>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-12">
                <section class="contests">
                    <h1>Contests</h1>

                    <table class="contest-table table table-bordered">
                        <thead>
                            <tr>
                                <td>Contest name</td>
                                <td>Category</td>
                                <td>Submissions</td>
                                <td>Price</td>
                                <td>Ends in</td>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($contests as $contest)
                                <tr>
                                    <td>
                                        <a href="{{ route('contests.show', ['contest' => $contest]) }}">
                                            {{ $contest->name }}
                                        </a>
                                    </td>
                                    <td>{{ $contest->category }}</td>
                                    <td>{{ $contest->submissions->count() }}</td>
                                    <td>{{ $contest->transaction->payout }}</td>
                                    <td>{{ $contest->expires_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </section>
            </div>
        </div>
    </div>
@endsection
