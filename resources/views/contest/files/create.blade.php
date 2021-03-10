@extends('layouts.master')

@section('title', 'File upload')

@section('content')
    <div class="container">
        <uppy :contest-id='@json($contestId)'></uppy>
    </div>
@endsection
