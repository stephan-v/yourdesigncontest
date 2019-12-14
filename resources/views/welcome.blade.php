@extends('layouts.master')

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
