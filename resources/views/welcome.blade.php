@extends('layouts.master')

@section('styles')
    <style>
        body:after {
            content: "";
            background-image: url("/images/pattern.png");
            opacity: 0.1;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            position: absolute;
            z-index: -1;
        }

        .container {
            max-width: 960px;
        }

        .row {
            width: 100%;
        }

        .center {
            overflow: hidden;
            height: 500px;
            background: white;
            display: block;
            border-radius: 1rem;
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.03);
        }

        .center h1 {
            font-size: 1.5rem;
            font-family: "Calistoga", cursive;
        }

        .center h1 .orange {
            color: orange;
        }

        .center p {
            line-height: 1.7;
        }

        .center .image-placeholder {
            border-radius: 20%;
            -webkit-transform: rotate(-60deg);
            transform: rotate(-60deg);
            width: 110%;
            height: 110%;
            position: absolute;
            bottom: -35%;
            right: -5%;
            overflow: hidden;
        }

        .center .image-placeholder .image {
            background-image: url("/images/pexels.jpg");
            background-size: cover;
            -webkit-transform: rotate(60deg);
            transform: rotate(60deg);
            width: 140%;
            height: 140%;
            left: 0;
            top: -35%;
            position: relative;
        }

        .center .image-placeholder .image:after {
            content: "";
            width: 95%;
            height: 95%;
            background: -webkit-gradient(linear, left bottom, left top, from(#006c9c), to(#02b0ff));
            background: linear-gradient(0deg, #006c9c, #02b0ff);
            display: block;
            opacity: 0.8;
        }

        @media (min-width: 768px) {
            h1 {
                font-size: 2rem;
            }
        }
    </style>
@endsection

@section('content')
    <div class="h-100 d-flex align-items-center">
        <div class="container">
            <div class="center d-flex">
                <div class="row">
                    <div class="col-md-6">
                        <div class="p-3 p-sm-5">
                            <h1 class="mb-3 mb-sm-5">YourDesignContest<span class="orange">.</span></h1>
                            <p>We love putting designers and clients in touch with each other.</p>
                            <p>Join us and become part the next wave of independent designers and freelancers.</p>
                            <p>Or host a graphic design contest and attract the best designers in our community.</p>
                        </div><!-- /.p-5 -->
                    </div><!-- /.col-md-6 -->

                    <div class="col-md-6 position-relative">
                        <div class="image-placeholder">
                            <signup></signup>
                            <div class="image"></div>
                        </div><!-- /.image-placeholder -->
                    </div><!-- /.col-md-6 -->
                </div><!-- /.row -->
            </div><!-- /.modal -->
        </div><!-- /.container -->
    </div><!-- d-flex -->
@endsection
