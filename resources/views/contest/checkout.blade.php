@extends('layouts.master')

@push('scripts')
    <script src="https://js.stripe.com/v3/"></script>
@endpush

@section('content')
    <div class="container d-flex justify-content-center flex-grow-1 flex-column">
        <div class="row pt-5">
            <div class="col-md-7 mb-5">
                <div class="position-relative page-header mb-3">
                    <div class="dot-pattern"></div>
                    <h1>Checkout</h1>
                </div>

                <p>You can select any amount of price money for your contest. A higher price will usually result in more contest submissions and higher quality submissions.</p>

                <checkout-form :contest='@json($contest)'></checkout-form>
            </div>

            <div class="col-md-5">
                <ul class="list-unstyled">
                    <li class="d-flex align-items-center mb-3 bg-white py-2 pr-3 pl-3">
                        <i class="fas fa-shield-alt fa-lg mr-4"></i>

                        <div>
                            <b>Secure checkout</b>
                            <p class="m-0">All information is encrypted and transmitted without risk using the SSL protocol.</p>
                        </div>
                    </li>

                    <li class="d-flex align-items-center mb-3 bg-white py-2 pr-3 pl-3">
                        <i class="fas fa-hand-holding-usd fa-lg mr-4"></i>

                        <div>
                            <b>Money back guarantee</b>
                            <p class="m-0">We offer a 100% money-back guarantee within 30 days of payment.</p>
                        </div>
                    </li>

                    <div class="d-flex justify-content-center">
                        <i class="fab fa-stripe fa-2x mr-3"></i>
                        <i class="fab fa-google-pay fa-2x mr-3"></i>
                        <i class="fab fa-apple-pay fa-2x mr-3"></i>
                        <i class="fab fa-cc-visa fa-2x mr-3"></i>
                        <i class="fab fa-cc-mastercard fa-2x mr-3"></i>
                        <i class="fab fa-cc-amex fa-2x mr-3"></i>
                    </div>
                </ul>
            </div>
        </div>
    </div>
@endsection
