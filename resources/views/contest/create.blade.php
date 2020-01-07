@extends('layouts.master')

@push('scripts')
    <script src="https://js.stripe.com/v3/"></script>
@endpush

@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-8 offset-md-2">
                <h1>Create a contest</h1>

                <checkout></checkout>
            </div>
        </div>
    </div>
@endsection
