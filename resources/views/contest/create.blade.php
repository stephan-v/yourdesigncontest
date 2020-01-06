@extends('layouts.master')

@push('scripts')
    <script src="https://js.stripe.com/v3/"></script>
@endpush

@section('content')
    <div class="container">
        <h1>Create a contest</h1>

        <checkout></checkout>
    </div>
@endsection
