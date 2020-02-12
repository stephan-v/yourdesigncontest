@extends('layouts.master')

@section('content')
    @if (count($contest->files))
        <div class="container download-files">
            <div class="d-flex justify-content-between align-items-center mt-5">
                <h1>Your design files</h1>

                @can('manage', $contest)
                    <a class="btn btn-primary" href="{{ route('zip', $contest) }}" role="button">
                        <i class="fas fa-file-archive"></i> Download zip
                    </a>
                @endif;
            </div>

            <div class="row">
                <div class="col-md-12">
                    <ul class="list-unstyled">
                        @foreach ($contest->files as $file)
                            <li class="media card p-3 mt-3 flex-row align-items-center">
                                <img src="{{ asset('images/svg/041-folder.svg') }}" alt="" class="img-fluid">

                                <div class="media-body ml-3">
                                    <h5 class="mt-0 mb-1">{{ $file->name }}</h5>
                                    <div>uploaded: {{ $file->created_at->diffForHumans() }}</div>
                                    <div>size: {{ $file->size }}</div>
                                </div>

                                <a class="btn btn-secondary" href="{{ route('contests.files.show', [$contest, $file]) }}" role="button">
                                    Download
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @else
        <div class="container flex-grow-1 d-flex align-items-center justify-content-center no-files">
            <div class="row">
                <div class="col-md-12 text-center">
                    <img src="{{ asset('images/svg/041-folder.svg') }}" alt="Files folder" class="img-fluid mb-3">
                    <h1 class="mb-3">No source files have been added yet.</h1>
                    <p>We have sent out a notification asking the winner to upload the source files.</p>
                    <p>Once the first files are uploaded you will receive a message.</p>
                </div>
            </div>
        </div>
    @endif
@endsection
