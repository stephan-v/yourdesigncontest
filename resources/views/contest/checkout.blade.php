@extends('layouts.master')

@push('scripts')
    <script src="https://js.stripe.com/v3/"></script>
@endpush

@section('content')
    <div class="container">
        <div class="row pt-5">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-body">
                        <h1>Checkout</h1>

                        <checkout-form :contest='@json($contest)'></checkout-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
