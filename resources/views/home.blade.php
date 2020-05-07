@extends('layouts.master')

@section('content')
    <div class="main-banner home-banner w-100 mb-5">
        <div class="container d-flex align-items-center h-100">
            <h1 class="text-white">
                <div class="mb-3">{{ __('messages.home.banner') }}</div>
                <a href="{{ route('process') }}" class="btn btn-primary">{{ __('messages.home.cta') }}</a>
            </h1>
        </div>
    </div>

    <div class="container">
        <img src="{{ asset('images/header.jpg') }}" alt="A collaboration of graphic design images" class="img-fluid w-100">

        <div class="bg-white p-4">
            <h2>{{ __('messages.home.content.header') }}</h2>

            <p>{{ __('messages.home.content.paragraph-1') }}</p>
            <p>{{ __('messages.home.content.paragraph-2') }}</p>
            <p class="m-0">{{ __('messages.home.content.paragraph-3') }}</p>
        </div>
    </div>
@endsection
