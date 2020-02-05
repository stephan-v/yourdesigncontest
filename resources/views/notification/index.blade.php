@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Notifications</h1>

                @foreach ($user->notifications as $notification)
                    {{ $notification->type }}
                @endforeach
            </div>
        </div>
    </div>
@endsection
