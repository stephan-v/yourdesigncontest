@extends('layouts.master')

@section('content')
    <div class="position-relative home-header">
        <img src="{{ asset('images/svg/header.svg') }}" alt="">

        <div class="container position-absolute">
            <img src="{{ asset('images/svg/designers.svg') }}" alt="" class="designers">
        </div>
    </div>
@endsection
