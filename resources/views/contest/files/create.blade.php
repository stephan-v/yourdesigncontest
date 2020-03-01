@extends('layouts.master')

@section('content')
    <div class="container">
        <uppy :contest-id='@json($contestId)'></uppy>
    </div>
@endsection
