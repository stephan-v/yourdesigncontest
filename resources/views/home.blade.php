@extends('layouts.master')

@section('nav-classes', 'fixed-top')

@section('content')
    <div class="main-banner w-100">
        <div class="image-test">

        </div>

        <div class="container d-flex align-items-center h-100">
            <div class="wrapper">
                <h1 class="font-weight-bold">Work with talented graphic <br> designers online</h1>

                <p class="p-0 col-8">Get quality design ideas and say goodbye to time consuming offline meetings.</p>

                <a href="{{ route('process') }}" class="btn btn-primary font-weight-bold mb-5">Get started <i class="fas fa-arrow-right fa-fw"></i></a>

                <div class="companies">
                    <p class="font-weight-bold position-relative">Trusted by</p>
                    <img src="{{ asset('images/svg/vivid_health.svg') }}" alt="Vivid Health" class="vivid-health">
                    <img src="{{ asset('images/svg/truvisory.svg') }}" alt="Truvisory" class="truvisory">
                    <img src="{{ asset('images/svg/wripple.svg') }}" alt="Wripple" class="wripple">
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-6 d-none d-lg-block">
                <div class="collage">
                    <div class="border-circle position-absolute"></div>
                    <div class="circle position-absolute"></div>

                    <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1950&q=80" alt="" class="img-fluid img-1">
                    <img src="https://images.unsplash.com/photo-1558401549-29b4893f4d9a?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1942&q=80" alt="" class="img-fluid img-2">
                    <img src="https://images.unsplash.com/photo-1488751045188-3c55bbf9a3fa?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=934&q=80" alt="" class="img-fluid img-3">
                    <img src="https://images.unsplash.com/photo-1531537571171-a707bf2683da?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1567&q=80" alt="" class="img-fluid img-4">
                </div>
            </div>

            <div class="col-lg-6 categories">
                <div class="mb-5 position-relative">
                    <div class="dot-pattern"></div>
                    <h2 class="font-weight-bold">Explore your <br> category</h2>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-5">
                        <span class="fa-stack fa-2x mb-2 graphic-design">
                            <i class="fas fa-square fa-stack-2x"></i>
                            <i class="fas fa-pencil-ruler fa-stack-1x fa-inverse"></i>
                        </span>

                        <h3 class="font-weight-bold">Graphic Design</h3>
                        <p>Logo design, style guides, illustrations and much more. Explore our vast pool of creative talent.</p>
                    </div>

                    <div class="col-md-6 mb-5">
                        <span class="fa-stack fa-2x mb-2 website-design">
                            <i class="fas fa-square fa-stack-2x"></i>
                            <i class="fas fa-laptop fa-stack-1x fa-inverse"></i>
                        </span>

                        <h3 class="font-weight-bold">Website Design</h3>
                        <p>Streamline your designs from mobile UI apps to landing pages all the way to full blown platforms.</p>
                    </div>

                    <div class="col-md-6 mb-5">
                        <span class="fa-stack fa-2x mb-2 app-design">
                            <i class="fas fa-square fa-stack-2x"></i>
                            <i class="fas fa-mobile-alt fa-stack-1x fa-inverse"></i>
                        </span>

                        <h3 class="font-weight-bold">App Design</h3>
                        <p>Outsource your app UI design project and get it done quickly and delivered remotely online.</p>
                    </div>

                    <div class="col-md-6 mb-5">
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

{{--    <div class="container">--}}
{{--        <img src="{{ asset('images/header.jpg') }}" alt="A collaboration of graphic design images" class="img-fluid w-100">--}}

{{--        <div class="bg-white p-4">--}}
{{--            <h2>Do you need a logo or other graphic design?</h2>--}}

{{--            <p>--}}
{{--                Creative talent is everywhere. Through our platform we give creatives from all kind--}}
{{--                of disciplines and backgrounds the change to create engaging content for their favourite brands.--}}
{{--            </p>--}}

{{--            <p>--}}
{{--                On our platform we publish graphic design contests which you can join for free. You decide for yourself--}}
{{--                which contests you want to enter, what you submit and who you work with. By joining contests you gain experience--}}
{{--                catering to real clients, work on your portfolio and expand your network all while earning cash.--}}
{{--            </p>--}}

{{--            <p class="m-0">--}}
{{--                GraphicDesignContests is the place to brand yourself as a creative specialist. Click here to learn more.--}}
{{--            </p>--}}
{{--        </div>--}}
{{--    </div>--}}
@endsection
