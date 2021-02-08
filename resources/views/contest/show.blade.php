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
        @if ($contest->winner)
            <div class="alert alert-warning p-3 m-0 text-center" role="alert">
                The contest is finished.
                Click <a href="{{ route('contests.files.index', $contest) }}">here</a> to review the final design files.
            </div>
        @endif
    @endcan

    @if ($contest->expired && !$contest->winner)
        <div class="alert alert-danger p-3 m-0 text-center" role="alert">
            The contest finished without the host selecting a winner, we will contact the host.
        </div>
    @endif

    <div class="contest-header bg-white py-5">
        <div class="container">
            <div class="row winning-submission">
                <div class="col-md-4">
                    <div class="winner-placeholder intrinsic intrinsic--4x3 mb-4">
                        @if ($contest->winner)
                            <img src="{{ $contest->submissions->firstWhere('winner', true)->path }}" class="intrinsic-item" alt="The design of the contest winner">
                        @else
                            <div class="text-muted intrinsic-item d-flex justify-content-center align-items-center flex-column outline p-3 text-center">
                                <i class="fas fa-pencil-ruler fa-2x mb-3"></i>
                                <b>Designers are working on this contest.</b>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-md-8">
                    <h1>{{ $contest->name }}</h1>
                    <div class="text-muted mb-2">Started by {{ $contest->user->name }}</div>
                    <p>{{ $contest->description }}</p>

                    <span class="mb-4 alert alert-info small font-weight-bold">
                        @if ($contest->winner)
                            Contest finished
                        @else
                            Ends in {{ $contest->endsIn }}
                        @endif
                    </span>

                    <h3 class="prize-money position-relative text-center mt-5 mt-md-0">
                        <span class="font-weight-bold">{{ $contest->payment->format }}</span>
                        <span class="font-weight-bold fade">{{ $contest->payment->format }}</span>
                        <span class="text-muted">First prize winner</span>
                    </h3>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row pt-5">
            <div class="col-md-12">
                <h5>{{ $submissions->where('deleted_at', null)->count() }} {{ Str::plural('Submission', $submissions->where('deleted_at', null)->count()) }}</h5>
            </div>
        </div>

        <div class="row pt-3">
            @if ($contest->active)
                <div class="col-lg-3 col-md-6">
                    <a href="{{ route('contests.submissions.create', $contest) }}" class="submission new-submission mb-3 d-flex align-items-center justify-content-center flex-column text-secondary text-center">
                        <i class="far fa-images fa-2x mb-3"></i>
                        <b>Submit a design</b>
                    </a>
                </div>
            @endif

            @foreach ($submissions as $submission)
                <div class="col-lg-3 col-md-6">
                    <div class="submission position-relative overflow-hidden mb-3">
                        @if ($submission->deleted_at)
                            <div class="deleted">
                                <picture class="intrinsic intrinsic--4x3">
                                    <div class="absolute-center font-weight-bold text-center small">Deleted by user</div>
                                    <img src="{{ $submission->path }}" alt="" class="intrinsic-item">
                                </picture>
                            </div>
                        @else
                            <submission :submission='@json($submission)'>
                                @if ($submission->winner)
                                    <div class="ribbon position-absolute">
                                        <i class="fas fa-award text-white position-relative"></i>
                                    </div>
                                @endif

                                <picture class="intrinsic intrinsic--4x3 overflow-hidden rounded">
                                    <img src="{{ $submission->path }}" alt="" class="intrinsic-item">
                                </picture>
                            </submission>
                        @endif

                        @can('restore', $submission)
                            @if ($submission->deleted_at)
                                <restore route="{{ route('contests.submission.restore', [$contest, $submission]) }}"></restore>
                            @endif
                        @endcan

                        <div class="d-flex justify-content-between py-2">
                            <small class="text-muted">
                                <span class="mr-1">#{{ $submission->order }}</span>

                                <a href="{{ route('users.show', $submission->user) }}" class="font-weight-bold">
                                    {{ $submission->user->name }}
                                </a>
                            </small>

                            <stars :initial-rating="{{ $submission->rating ?? 0 }}"
                                   :editable="@json(optional($user)->can('manage', $contest) && empty($submission->deleted_at))"
                                   route="{{ route('contests.submissions.update', [$contest, $submission]) }}">
                            </stars>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="row">
            <div class="col-md-12 pt-4 d-flex justify-content-center">
                {{ $submissions->links() }}
            </div>
        </div>
    </div>
@endsection
