@extends('layouts.master')

@push('scripts')
    <script src="https://js.stripe.com/v3/"></script>
@endpush

@section('content')
    <div class="container">
        <div class="row pt-5">
            <div class="col-md-8 offset-md-2">
                <checkout :contest='@json($contest)'></checkout>
            </div>
        </div>
    </div>
@endsection
