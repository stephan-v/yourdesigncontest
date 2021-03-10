@extends('layouts.master')

@section('title', 'Home')

@section('nav-classes', 'fixed-top')

@section('content')
    <div class="main-banner w-100">
        <div class="banner-background"></div>

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

    <div class="position-relative bg-white statistics">
        <div class="container">
            <div class="row justify-content-lg-center">
                <div class="col-md-4 mb-7 mb-lg-0">
                    <div data-aos="fade-up" data-aos-delay="100" class="aos-init aos-animate">
                        <!-- Stats -->
                        <div class="text-center px-md-3 px-lg-7">
                            <figure class="mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 71.7 64" width="71" height="64">
                                    <path fill="#FFC107" d="M36.8,14.6L42,25.3c0,0.2,0.2,0.2,0.3,0.3L54,27.2c0.3,0,0.5,0.5,0.3,0.8l-8.5,8.2c-0.2,0.2-0.2,0.3-0.2,0.5
                    l2,11.7c0,0.3-0.3,0.7-0.7,0.5l-10.5-5.6c-0.2,0-0.3,0-0.5,0l-10.5,5.6c-0.3,0.2-0.8-0.2-0.7-0.5l2-11.7c0-0.2,0-0.3-0.2-0.5
                    L18,28.1c-0.3-0.3-0.2-0.8,0.3-0.8L30,25.6c0.2,0,0.3-0.2,0.3-0.3l5.3-10.7C36.1,14.2,36.6,14.2,36.8,14.6z"></path>
                                    <path opacity=".25" fill="#FFC107" d="M56,5.9l1.5,2.8c0,0,0,0,0.2,0l3.1,0.5c0.2,0,0.2,0.2,0,0.2l-2.3,2.3c0,0,0,0,0,0.2l0.5,3.1
                    c0,0.2-0.2,0.2-0.2,0.2L56,13.6h-0.2L53,15.1c-0.2,0-0.2,0-0.2-0.2l0.5-3.1v-0.2l-2.3-2.3V9.2l3.1-0.5c0,0,0,0,0.2,0l1.5-2.8
                    C55.8,5.7,55.8,5.7,56,5.9z"></path>
                                    <path opacity=".25" fill="#FFC107" d="M12.3,0.3l1.3,2.8c0,0,0,0,0.2,0l3,0.5c0.2,0,0.2,0.2,0,0.2l-2.1,2.1c0,0,0,0,0,0.2l0.5,3
                    c0,0.2-0.2,0.2-0.2,0.2l-2.6-1.5c0,0,0,0-0.2,0L9.5,9.2c-0.2,0-0.2,0-0.2-0.2l0.5-3c0,0,0,0,0-0.2L7.5,3.7V3.6l3-0.5c0,0,0,0,0.2,0
                    l1.3-2.8C12.1,0.3,12.3,0.3,12.3,0.3z"></path>
                                    <path opacity=".25" fill="#FFC107" d="M13.9,49.9l1.5,2.8c0,0,0,0,0.2,0l3.1,0.5c0.2,0,0.2,0.2,0,0.2l-2.3,2.3c0,0,0,0,0,0.2l0.5,3.1
                    c0,0.2-0.2,0.2-0.2,0.2l-2.8-1.5h-0.2L11,59.1c-0.2,0-0.2,0-0.2-0.2l0.5-3.1v-0.2L9,53.4v-0.2l3.1-0.5c0,0,0,0,0.2,0l1.3-2.8
                    C13.8,49.8,13.9,49.8,13.9,49.9z"></path>
                                    <path opacity=".25" fill="#FFC107" d="M60.8,53.5l1.6,3.1c0,0,0,0,0.2,0l3.5,0.5c0.2,0,0.2,0.2,0,0.3l-2.5,2.5c0,0,0,0,0,0.2l0.7,3.5
                    c0,0.2-0.2,0.2-0.2,0.2l-3.1-1.6h-0.2l-3.1,1.6c-0.2,0-0.2,0-0.2-0.2l0.7-3.5v-0.2l-2.5-2.5c-0.2-0.2,0-0.2,0-0.3l3.5-0.5h0.2
                    l1.6-3.1C60.4,53.4,60.6,53.4,60.8,53.5z"></path>
                                </svg>
                            </figure>
                            <p class="mb-0"><span class="text-dark font-weight-bold">4.83 out of 5 starts</span> from 53 reviews</p>
                        </div>
                        <!-- End Stats -->
                    </div>
                </div>

                <div class="col-md-4 mb-7 mb-lg-0">
                    <div data-aos="fade-up" class="aos-init aos-animate">
                        <!-- Stats -->
                        <div class="text-center column-divider-md column-divider-20deg px-5">
                            <figure class="mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 71.7 64" width="71" height="64">
                                    <defs>
                                        <circle id="SVGID_1_" cx="50.9" cy="43.1" r="18.9"></circle>
                                    </defs>
                                    <clipPath id="SVGID_2_">
                                        <use xlink:href="#SVGID_1_"></use>
                                    </clipPath>
                                    <g transform="matrix(1 0 0 1 0 1.907349e-06)" style="clip-path:url(#SVGID_2_);">
                                        <image width="100" height="100" xlink:href="{{ asset('images/avatars/img10.jpg') }}" transform="matrix(0.36 0 0 0.36 32.8571 25.1429)"></image>
                                    </g>
                                    <use xlink:href="#SVGID_1_" fill="none" stroke="#FFFFFF" stroke-width="4"></use>
                                    <defs>
                                        <circle id="SVGID_3_" cx="34.6" cy="20.9" r="18.9"></circle>
                                    </defs>
                                    <clipPath id="SVGID_4_">
                                        <use xlink:href="#SVGID_3_"></use>
                                    </clipPath>
                                    <g style="clip-path:url(#SVGID_4_);">
                                        <image width="100" height="100" xlink:href="{{ asset('images/avatars/img3.jpg') }}" transform="matrix(0.36 0 0 0.36 16.5714 2.8571)"></image>
                                    </g>
                                    <use xlink:href="#SVGID_3_" fill="none" stroke="#FFFFFF" stroke-width="4"></use>
                                    <defs>
                                        <circle id="SVGID_5_" cx="20.9" cy="43.1" r="18.9"></circle>
                                    </defs>
                                    <clipPath id="SVGID_6_">
                                        <use xlink:href="#SVGID_5_"></use>
                                    </clipPath>
                                    <g style="clip-path:url(#SVGID_6_);">
                                        <image width="100" height="100" xlink:href="{{ asset('images/avatars/img2.jpg') }}" transform="matrix(0.3771 0 0 0.3771 2 24.2857)"></image>
                                    </g>
                                    <use xlink:href="#SVGID_5_" fill="none" stroke="#FFFFFF" stroke-width="4"></use>
                                </svg>
                            </figure>
                            <p class=" mb-0">Over <span class="text-dark font-weight-bold">500</span> support questions have been closed</p>
                        </div>
                        <!-- End Stats -->
                    </div>
                </div>

                <div class="col-md-4">
                    <div data-aos="fade-up" data-aos-delay="100" class="aos-init aos-animate">
                        <!-- Stats -->
                        <div class="text-center column-divider-md column-divider-20deg px-md-3 px-lg-7">
                            <figure class="mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="71" height="64" viewBox="0 0 71.7 64">
                                    <path fill="none" stroke="#21325b" stroke-width="2" d="M47.9,1.3H20.1c-2,0-3.5,1.5-3.5,3.5v51.4c0,2,1.5,3.5,3.5,3.5h36.5c2,0,3.5-1.5,3.5-3.5v-8.6V21.2v-7.5
                    L47.9,1.3z"></path>
                                    <path fill="#21325b" d="M49.1,14.7c-1.1,0-1.8-0.9-1.8-1.8V2L60,14.7H49.1z"></path>
                                    <line fill="none" stroke="#21325b" stroke-width="2" stroke-linecap="round" x1="48.2" y1="21" x2="28" y2="21"></line>
                                    <line fill="none" stroke="#21325b" stroke-width="2" stroke-linecap="round" x1="48.2" y1="27.9" x2="28" y2="27.9"></line>
                                    <line fill="none" stroke="#21325b" stroke-width="2" stroke-linecap="round" x1="48.2" y1="34.8" x2="28" y2="34.8"></line>
                                    <line fill="none" stroke="#21325b" stroke-width="2" stroke-linecap="round" x1="48.2" y1="42" x2="28" y2="42"></line>
                                    <path opacity=".2" fill="#21325b" d="M17.1,56V10.2c0-1.4-1.1-2.5-2.5-2.5h-0.5c-1.4,0-2.5,1.1-2.5,2.5v51.1c0,1.4,1.1,2.5,2.5,2.5h2.9h34.7
                    c1.4,0,2.5-1.1,2.5-2.5v-0.5c0-1.4-1.1-2.5-2.5-2.5H19.5C18.1,58.4,17.1,57.4,17.1,56z"></path>
                                </svg>
                            </figure>
                            <p class="mb-0"><span class="text-dark font-weight-bold">3,700</span> contests started</p>
                        </div>
                        <!-- End Stats -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
