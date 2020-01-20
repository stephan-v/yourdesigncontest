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
            <div class="col-md-6 offset-md-3">
                <form class="text-center mb-5 mt-5" method="POST" action="{{ route('winner', ['contest' => $contest, 'submission' => $submission]) }}">
                    @csrf

                    <button type="submit" class="btn btn-primary">Select as winner</button>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 offset-md-3">
                <comments :submission='@json($submission)' :initial-comments='@json($submission->comments)'></comments>
            </div>
        </div>
    </div>
@endsection
