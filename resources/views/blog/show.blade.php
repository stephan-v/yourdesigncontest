@extends('layouts.master')

@section('title', $post->title->rendered . ' - YourDesignContest')

@section('description', $post->content->rendered)

@section('content')
    <div class="container">
        <article class="blog-post">
            <header class="hero-inner-blog mb-5">
                <div class="blog-heading text-center">
                    <h1>{!! $post->title->rendered !!}</h1>

                    <div class="publish-date">
                        {{ Carbon\Carbon::parse($post->date)->toFormattedDateString() }}
                    </div><!-- /.publish-date -->
                </div><!-- /.heading -->
            </header><!-- /.hero-inner-blog -->

            <section class="container container-small blog-content">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        {!! $post->content->rendered !!}
                    </div><!-- /.col-md-9 -->
                </div><!-- /.row -->
            </section><!-- /.container -->
        </article>
    </div><!-- /.container -->
@endsection
