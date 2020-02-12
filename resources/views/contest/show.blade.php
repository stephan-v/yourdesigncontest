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
    <div class="container">
        @can('manage', $contest)
            @if ($contest->finished)
                <div class="alert alert-warning mt-5" role="alert">
                    The contest is finished.
                    Click <a href="{{ route('contests.files.index', $contest) }}">here</a> to review the final design files.
                </div>
            @endif
        @endcan

        <div class="row mt-5 mb-5">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header text-center">
                        Briefing
                    </div>

                    <div class="card-body">
                        <h1>{{ $contest->name }}</h1>
                        <p>{{ $contest->description }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                @if ($contest->active)
                    <div class="text-right mb-3">
                        <a class="btn btn-info btn-lg w-100" href="{{ route('contests.submissions.create', $contest) }}" role="button">
                            Submit a design
                        </a>
                    </div>
                @endif

                <div class="card text-right mb-3">
                    <div class="card-header">Payout</div>

                    <div class="card-body">
                        <p class="mb-0 payout">{{ $contest->payment->formattedPayout }}</p>
                    </div>
                </div>
            </div>
        </div>

        @can('submit', $contest)
            <div class="row mb-5">
                <div class="col-md-12 text-center">
                    <a href="{{ route('contests.submissions.create', $contest) }}" class="btn btn-primary">
                        Add submission
                    </a>
                </div>
            </div>
        @endcan

        <div class="row">
            @foreach ($submissions as $submission)
                <div class="col-md-3">
                    <div class="submission mb-3 @if ($submission->winner) border border-warning @endif">
                        <submission :submission='@json($submission)'>
                            @if ($submission->winner)
                                <div class="alert alert-warning text-center mb-0" role="alert">Winner!</div>
                            @endif

                            <div class="p-2 d-flex justify-content-center align-items-center">
                                <img src="{{ $submission->path }}" alt="" class="img-fluid">
                            </div>
                        </submission>

                        <stars :initial-rating="{{ $submission->rating ?? 0 }}"
                               route="{{ route('contests.submissions.update', [$contest, $submission]) }}">
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
