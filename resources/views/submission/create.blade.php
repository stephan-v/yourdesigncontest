@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row pt-5">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-body">
                        <h1>Add a submission</h1>

                        <form action="{{ route('contests.submissions.store', ['contest' => $contest->id]) }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="file">File</label>
                                <input type="file" class="form-control-file" id="file" name="file">
                            </div>

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <button type="submit" class="btn btn-primary">Upload submission</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
