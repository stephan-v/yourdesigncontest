@extends('layouts.master')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-3">Handover</h1>

        @component('components.tabs')
            @slot('tabs')
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('contests.files.index', $contest) }}">Files</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link"  href="{{ route('contests.comments.index', $contest) }}">Comments</a>
                </li>
           @endslot

            @slot('content')
                @if (count($contest->files))
                    <div class="contest-files">
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <div class="font-weight-bold">Source design files</div>

                            @can('manage', $contest)
                                <a class="btn btn-primary" href="{{ route('zip', $contest) }}" role="button">
                                    <i class="fas fa-file-archive mr-2"></i> Download all as ZIP file
                                </a>
                            @endif
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

                                            @can('delete', $file)
                                                <form method="POST" action="{{ route('contests.files.destroy', [$contest, $file]) }}">
                                                    @method('DELETE')
                                                    @csrf

                                                    <button type="submit" class="btn btn-danger mr-3" role="button">
                                                        Delete
                                                    </button>
                                                </form>
                                            @endcan

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
                    <div class="flex-grow-1 d-flex align-items-center justify-content-center no-files">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <img src="{{ asset('images/svg/041-folder.svg') }}" alt="Files folder" class="img-fluid mb-3 mt-3">
                                <h1 class="mb-3">No source files have been added yet.</h1>

                                <p class="mb-0">We have sent out a notification asking {{ $contest->winner->name }} to upload the final source files.</p>
                                <hr>
                                <p>Once the first files are uploaded you will receive a message.</p>
                            </div>
                        </div>
                    </div>
                @endif
            @endslot
        @endcomponent
    </div>
@endsection
