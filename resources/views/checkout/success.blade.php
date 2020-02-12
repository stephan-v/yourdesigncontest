@extends('layouts.master')

@section('content')
    <div class="h-100 d-flex align-items-center">
        <div class="container">
            <div class="row mb-3">
                <div class="col-md-8 offset-md-2">
                    <h1 class="success font-weight-bold mb-3">
                        <i class="fas fa-check-circle"></i>
                        Payment confirmed
                    </h1>

                    <p>Thank you, your payment has been successful and your contest is now live.</p>
                    <p>A confirmation email has been sent to: {{ $email }}.</p>

                    <a href="{{ route('contests.show', $contest) }}">
                        Click here to continue to your contest.
                    </a>
                </div>
            </div>

            <div class="row order-summary">
                <div class="col-md-8 offset-md-2">
                    <div class="card w-100">
                        <div class="card-body">
                            <h5 class="card-title">Order summary</h5>

                            <table class="table table-borderless mb-0">
                                <tbody>
                                    <tr>
                                        <td class="w-50">Product</td>
                                        <td class="w-50">Design contest</td>
                                    </tr>

                                    <tr>
                                        <td class="w-50">Email:</td>
                                        <td class="w-50">{{ $email }}</td>
                                    </tr>

                                    <tr>
                                        <td class="w-50">Total price</td>
                                        <td class="w-50">{{ number_format($amount, 2)}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
