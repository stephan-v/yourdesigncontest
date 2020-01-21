@extends('layouts.master')

@section('content')
    <div class="container flex-grow-1 d-flex align-items-center justify-content-center">
        @if (count($contest->files))
            <a class="btn btn-primary" href="{{ route('zip', ['contest' => $contest]) }}" role="button">
                Download all files
            </a>

            <div class="col-md-12">
                @foreach ($contest->files->chunk(4) as $files)
                    <div class="row">
                        @foreach ($files as $file)
                            <div class="col-md-3">
                                <div>
                                    <img src="{{ asset($file->path) }}" alt="" class="img-fluid">

                                    <div class="caption p-3 border-top">
                                        <small class="text-muted">
                                            <span>Uploaded at: {{ $file->created_at }}</span>
                                        </small>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        @else
            <div class="row no-files">
                <div class="col-md-12 text-center">
                    <img src="{{ asset('/images/svg/041-folder.svg') }}" alt="Files folder" class="img-fluid mb-3">
                    <h2 class="mb-3">No source files have been added yet.</h2>
                    <p>We have sent out a notification asking the winner to upload the source files.</p>
                    <p>Once the first files are uploaded you will receive a message.</p>
                </div>
            </div>
        @endif
    </div>
@endsection
