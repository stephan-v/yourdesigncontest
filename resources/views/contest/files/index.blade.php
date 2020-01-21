@extends('layouts.master')

@section('content')
    <div class="container">
        <h1>Download source files</h1>

        <div class="col-md-12">
            @foreach ($contest->files->chunk(4) as $files)
                <div class="row">
                    @foreach ($files as $file)
                        <div class="col-md-3">
                            <img src="{{ asset($file->path) }}" alt="" class="img-fluid">
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
@endsection
