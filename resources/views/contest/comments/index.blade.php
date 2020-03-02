@extends('layouts.master')

@section('content')
    <div class="container mt-5">
        @component('components.tabs')
            @slot('tabs')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contests.files.index', $contest) }}">Files</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link active"  href="{{ route('contests.comments.index', $contest) }}">Comments</a>
                </li>
           @endslot

            @slot('content')
                <div class="download-files">
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <h1>Comments</h1>
                    </div>

                    <div class="row">
                        <div class="col-md-12">

                        </div>
                    </div>
                </div>
            @endslot
        @endcomponent
    </div>
@endsection
