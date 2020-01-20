@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex align-content-center justify-content-center p-3">
                    <img src="{{ asset($submission->path) }}" alt="" class="img-fluid" style="max-height: 300px">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <comments :submission='@json($submission)' :initial-comments='@json($submission->comments)'></comments>
            </div>
        </div>
    </div>
@endsection
