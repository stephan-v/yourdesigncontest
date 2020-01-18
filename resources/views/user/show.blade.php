@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                {{ $user->name }}
            </div>
        </div>
    </div>
@endsection
