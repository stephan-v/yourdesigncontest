@extends('layouts.master')

@section('content')
    <div class="container notifications-index">
        <div class="row">
            <div class="col-md-12">
                <h1 class="mt-5 mb-3">Notifications</h1>

                <ul class="list-group list-unstyled">
                    @foreach ($notifications as $notification)
                        <notification :notification='@json($notification)' class="bg-white mb-3 rounded"></notification>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 pt-4 pb-3 d-flex justify-content-center">
                {{ $notifications->links() }}
            </div>
        </div>
    </div>
@endsection
