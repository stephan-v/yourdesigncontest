@extends('layouts.master')

@section('content')
    <div class="main-banner home-banner w-100 mb-5">
        <div class="container d-flex align-items-center h-100">
            <h1 class="text-white">
                <div>Quick and cheap creative services</div>
                <a href="{{ route('process') }}" class="text-white "><u>check how it works</u></a>
            </h1>
        </div>
    </div>

    <div class="container">
        <img src="{{ asset('images/header.jpg') }}" alt="A collaboration of graphic design images" class="img-fluid w-100">

        <div class="bg-white p-4">
            <h2>Do you need a logo or other graphic design?</h2>

            <p>
                Creative talent is everywhere. Through our platform we give creatives from all kind
                of disciplines and backgrounds the change to create engaging content for their favourite brands.
            </p>

            <p>
                On our platform we publish graphic design contests which you can join for free. You decide for yourself
                which contests you want to enter, what you submit and who you work with. By joining contests you gain experience
                catering to real clients, work on your portfolio and expand your network all while earning cash.
            </p>

            <p class="m-0">
                GraphicDesignContests is the place to brand yourself as a creative specialist. Click here to learn more.
            </p>
        </div>
    </div>
@endsection
