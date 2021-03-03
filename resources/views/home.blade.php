@extends('layouts.master')

@section('nav-classes', 'fixed-top')

@section('content')
    <div class="main-banner w-100">
        <div class="image-test">

        </div>

        <div class="container d-flex align-items-center h-100">
            <div class="wrapper">
                <h1 class="font-weight-bold">Creative &amp; bold designs <br> custom made for you</h1>

                <p class="p-0 col-8">Get quality design ideas from a large pool of talented designers for your next graphic design project.</p>

                <a href="{{ route('contests.create') }}" class="btn btn-primary font-weight-bold mb-5">Start a contest</a>

                <div class="companies">
                    <p class="font-weight-bold position-relative">Trusted by</p>
                    <img src="{{ asset('images/svg/vivid_health.svg') }}" alt="Vivid Health" class="vivid-health">
                    <img src="{{ asset('images/svg/truvisory.svg') }}" alt="Truvisory" class="truvisory">
                    <img src="{{ asset('images/svg/wripple.svg') }}" alt="Wripple" class="wripple">
                </div>
            </div>
        </div>
    </div>

    <div class="position-relative">
        <div class="container category-container">
            <div class="row">
                <div class="col-md-6 d-none d-lg-block">
                    <div class="collage">
                        <div class="border-circle position-absolute"></div>
                        <div class="circle position-absolute"></div>

                        <img src="{{ asset('images/collage-1.jpg') }}" alt="" class="img-fluid img-1">
                        <img src="{{ asset('images/collage-2.jpg') }}" alt="" class="img-fluid img-2">
                        <img src="{{ asset('images/collage-3.jpg') }}" alt="" class="img-fluid img-3">
                        <img src="{{ asset('images/collage-4.jpg') }}" alt="" class="img-fluid img-4">
                    </div>
                </div>

                <div class="col-lg-6 categories">
                    <div class="mb-3 mb-md-5 position-relative">
                        <div class="dot-pattern"></div>
                        <h2 class="font-weight-bold">Explore your <br> category</h2>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-1 mb-md-4">
                            <span class="fa-stack fa-2x mb-2 graphic-design">
                                <i class="fas fa-square fa-stack-2x"></i>
                                <i class="fas fa-pencil-ruler fa-stack-1x fa-inverse"></i>
                            </span>

                            <h3 class="font-weight-bold">Graphic Design</h3>
                            <p>Logo design, style guides, illustrations and much more. Explore our vast pool of creative talent.</p>
                        </div>

                        <div class="col-md-6 mb-1 mb-md-4">
                            <span class="fa-stack fa-2x mb-2 website-design">
                                <i class="fas fa-square fa-stack-2x"></i>
                                <i class="fas fa-laptop fa-stack-1x fa-inverse"></i>
                            </span>

                            <h3 class="font-weight-bold">Website Design</h3>
                            <p>Streamline your designs from mobile UI apps to landing pages all the way to full blown platforms.</p>
                        </div>

                        <div class="col-md-6 mb-1 mb-md-4">
                            <span class="fa-stack fa-2x mb-2 app-design">
                                <i class="fas fa-square fa-stack-2x"></i>
                                <i class="fas fa-mobile-alt fa-stack-1x fa-inverse"></i>
                            </span>

                            <h3 class="font-weight-bold">App Design</h3>
                            <p>Outsource your app UI design project and get it done quickly and delivered remotely online.</p>
                        </div>

                        <div class="col-md-6 mb-1 mb-md-4">
                            <span class="fa-stack fa-2x mb-2 product-design">
                                <i class="fas fa-square fa-stack-2x"></i>
                                <i class="fas fa-box-open fa-stack-1x fa-inverse"></i>
                            </span>

                            <h3 class="font-weight-bold">Product Design</h3>
                            <p>Bring your product to life with drawings, 3D models, blueprints, and much more!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <figure class="svg-scoop">
            <svg preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 1920 100.1">
                <path fill="#fff" d="M0,0c0,0,934.4,93.4,1920,0v100.1H0L0,0z"></path>
            </svg>
        </figure>
    </div>

    <div class="position-relative bg-white" style="height: 200px"></div>
@endsection
