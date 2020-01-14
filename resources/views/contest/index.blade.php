@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row pt-5">
            <div class="col-md-8 offset-md-2">
                <h1>Contests</h1>

                @foreach ($contests as $contest)
                    {{ $contest->name }}
                @endforeach
            </div>
        </div>
    </div>
@endsection
