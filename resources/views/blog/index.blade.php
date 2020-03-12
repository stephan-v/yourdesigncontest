@extends('layouts.master')

@section('title', 'Blog - YourDesignContest')

@section('description', 'Welcome to our blog.')

@section('content')
    <div class="container container-small mb-3 mt-5">
        <div class="blog">
            <div class="blog-posts">
                @foreach ($posts as $post)
                    <article class="post-card">
                        <a href="{{ route('blog.show', $post->id) }}" class="d-block position-relative overflow-hidden">
                            <img src="{{ $post->_embedded->{'wp:featuredmedia'}[0]->media_details->sizes->medium->source_url }}" alt="" class="rounded-top position-absolute h-100">
                            <div class="category position-absolute p-2">{{ $post->category }}</div>
                        </a>

                        <div class="content pt-3">
                            <h2 class="m-0">{!! $post->title->rendered !!}</h2>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </div>
@endsection
