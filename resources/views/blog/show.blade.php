@extends('layouts.master')

@section('title', $post->title . ' - YourDesignContest')

@section('description', $post->content)

@section('content')
    <div class="container">
        <article class="blog-post mt-5 mb-5">
            <header class="hero-inner-blog mb-4">
                <div class="blog-heading text-center">
                    <h1 class="font-weight-bold">{{ $post->title }}</h1>

                    <div class="publish-date mb-4">
                        {{ $post->date }}
                    </div><!-- /.publish-date -->

                    <img src="{{ $post->thumbnail->size('large') }}" alt="">
                </div><!-- /.heading -->
            </header><!-- /.hero-inner-blog -->

            <section class="container container-small blog-content">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        {!! $post->content !!}
                    </div><!-- /.col-md-9 -->
                </div><!-- /.row -->
            </section><!-- /.container -->
        </article>
    </div><!-- /.container -->
@endsection
