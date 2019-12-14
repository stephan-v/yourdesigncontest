@extends('layouts.master')

@section('content')
    <h1>Contests</h1>

    @foreach ($contests as $contest)
        {{ $contest->title }}
    @endforeach
@endsection
