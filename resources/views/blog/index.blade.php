@extends('layouts.master')

@section('title', 'Blog - YourDesignContest')

@section('description', 'Welcome to our blog.')

@section('content')
    <div class="container container-small mb-3 mt-5">
        <div class="blog">
            <div class="blog-posts position-relative">
                <div class="dot-bg position-absolute"></div>

                @foreach ($posts as $post)
                    <article class="post-card">
                        <a href="{{ route('blog.show', $post->id) }}" class="d-block position-relative overflow-hidden" style="background-image: url({{ $post->image }})">
                            <div class="category position-absolute p-2">{{ $post->category }}</div>
                        </a>

                        <div class="content pt-3">
                            <h2 class="m-0 font-weight-bold">{!! $post->title->rendered !!}</h2>

                            <div class="author mt-3 d-flex align-items-center">
                                <img src="{{ asset('/avatars/user.svg') }}" class="ml-1" alt="">
                                <span class="author">YourDesignContest</span>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </div>
@endsection
