@extends('layouts.master')

@push('scripts')
    <script src="https://js.stripe.com/v3/"></script>
@endpush

@section('content')
    <div class="container contact-page d-flex justify-content-center flex-grow-1 flex-column">
        <div class="row pt-5">
            <div class="col-md-6">
                <div class="position-relative">
                    <div class="dot-pattern"></div>
                    <h1>Checkout</h1>
                </div>

                <p>You can select any amount of price money for your contest. A higher price will usually result in more contest submissions and higher quality submissions.</p>

                <checkout-form :contest='@json($contest)'></checkout-form>
            </div>

            <div class="col-md-5 offset-md-1">
                <ul class="list-unstyled">
                    <li class="d-flex align-items-center mb-3 alert alert-primary">
                        <i class="fas fa-user-lock fa-2x mr-4"></i>

                        <div>
                            <b>Your information is safe</b>
                            <p>We won't sell your personal contact information for any marketing purposes whatsoever.</p>
                        </div>
                    </li>

                    <li class="d-flex align-items-center mb-3 alert alert-primary">
                        <i class="fas fa-shield-alt fa-2x mr-4"></i>

                        <div>
                            <b>Secure checkout</b>
                            <p>All information is encrypted and transmitted without risk using the SSL protocol.</p>
                        </div>
                    </li>

                    <li class="d-flex align-items-center mb-3 alert alert-primary">
                        <i class="fas fa-hand-holding-usd fa-2x mr-4"></i>

                        <div>
                            <b>Money back guarantee</b>
                            <p>We offer a 100% money-back guarantee within 60 days of payment.</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection
