@extends('layouts.master')

@section('meta')
    @php
        $description = "A new design contest - {$contest->name}";
        $image = asset('images/drawing-feedback-logos-critique-17845.jpg');
    @endphp

    <!-- Place this data between the <head> tags of your website -->
    <meta name="description" content="{{ $description }}" />

    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ $contest->name }}">
    <meta itemprop="description" content="{{ $description }}">
    <meta itemprop="image" content="{{ $image }}">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="{{ config('app.name') }}">
    <meta name="twitter:description" content="{{ $description }}">
    <meta name="twitter:creator" content="@author_handle">
    <!-- Twitter summary card with large image must be at least 280x150px -->
    <meta name="twitter:image:src" content="{{ $image }}">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ $contest->name }}" />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:image" content="{{ $image }}" />
    <meta property="og:description" content="{{ $description }}" />
    <meta property="og:site_name" content="{{ config('app.name') }}" />
    <meta property="article:published_time" content="{{ $contest->created_at->toW3cString() }}" />
    <meta property="article:modified_time" content="{{ $contest->updated_at->toW3cString() }}" />
    <meta property="article:section" content="Article Section" />
    <meta property="article:tag" content="Article Tag" />
    <meta property="fb:admins" content="Facebook numberic ID" />
@endsection

@section('content')
    <contest :locked="@json($locked)"></contest>

    @can('manage', $contest)
        @if ($contest->finished)
            <div class="alert alert-warning p-3 m-0 text-center" role="alert">
                The contest is finished.
                Click <a href="{{ route('contests.files.index', $contest) }}">here</a> to review the final design files.
            </div>
        @endif
    @endcan

    <div class="contest-header bg-white pt-5 pb-5">
        <div class="container">
            <div class="row winning-submission">
                <div class="col-md-4">
                    <div class="winner-placeholder intrinsic intrinsic--4x3">
                        @if ($contest->finished)
                            <img src="{{ $contest->winner->path }}" class="intrinsic-item" alt="The design of the contest winner">
                        @else
                            <div class="text-muted intrinsic-item d-flex justify-content-center align-items-center flex-column outline p-3 text-center">
                                <i class="fas fa-pencil-ruler fa-2x mb-3"></i>
                                <p class="m-0">Designers are working on this contest.</p>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-md-8">
                    <h1>{{ $contest->name }}</h1>
                    <p>{{ $contest->description }}</p>

                    <span class="mb-4 alert alert-info small font-weight-bold">
                        @if ($contest->finished)
                            Contest finished
                        @else
                            Ends in {{ $contest->endsIn }}
                        @endif
                    </span>

                    <h3 class="price-money position-relative text-center">
                        <span class="font-weight-bold">{{ $contest->payment->formattedPayout }}</span>
                        <span class="font-weight-bold fade">{{ $contest->payment->formattedPayout }}</span>
                        <span class="text-muted">First price winner</span>
                    </h3>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row pt-5">
            <div class="col-md-12">
                <h5>{{ $submissions->total() }} {{ Str::plural('Submission', $submissions->total()) }} </h5>
            </div>
        </div>

        <div class="row pt-3">
            @if ($contest->active)
{{--                @can('submit', $contest)--}}
                    <div class="col-md-3">
                        <a href="{{ route('contests.submissions.create', $contest) }}" class="submission new-submission mb-3 d-flex align-items-center justify-content-center flex-column text-secondary text-center">
                            <i class="far fa-images fa-2x mb-3"></i>
                            <div>Submit a design</div>
                        </a>
                    </div>
{{--                @endcan--}}
            @endif

            @foreach ($submissions as $submission)
                <div class="col-md-3">
                    <div class="submission mb-3 @if ($submission->winner) border border-warning @endif">
                        <submission :submission='@json($submission)'>
                            @if ($submission->winner)
                                <div class="alert alert-warning text-center mb-0 p-2" role="alert">Winner!</div>
                            @endif

                            <div class="pt-2 pr-2 pl-2">
                                <picture class="intrinsic intrinsic--4x3">
                                    <img src="{{ $submission->path }}" alt="" class="intrinsic-item">
                                </picture>
                            </div>
                        </submission>

                        <stars :initial-rating="{{ $submission->rating ?? 0 }}" route="{{ route('contests.submissions.update', [$contest, $submission]) }}">
                        </stars>

                        <div class="caption p-2 border-top">
                            <small class="text-muted">
                                <span>#{{ $submission->order }} by</span>

                                <a href="{{ route('users.show', $contest->user) }}">
                                    {{ $contest->user->name }}
                                </a>
                            </small>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="row">
            <div class="col-md-12 pt-4 pb-3 d-flex justify-content-center">
                {{ $submissions->links() }}
            </div>
        </div>
    </div>
@endsection
