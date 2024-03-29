@extends('layouts.master')

@section('title', 'Comments')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-3">Handover</h1>

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
                <div class="contest-comments">
                    <div class="row">
                        <div class="col-md-12">
                            <comments route="{{ route('api.contests.comments.index', $contest) }}"></comments>
                        </div>
                    </div>
                </div>
            @endslot
        @endcomponent
    </div>
@endsection
