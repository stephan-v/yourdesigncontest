@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex align-content-center justify-content-center p-3">
                    <img src="{{ asset($submission->file) }}" alt="" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
@endsection
