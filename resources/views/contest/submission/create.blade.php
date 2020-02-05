@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row pt-5">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-body">
                        <h1>Add a submission</h1>

                        <div class="alert alert-info" role="alert">Max filesize is 1MB</div>

                        <form action="{{ route('contests.submissions.store', ['contest' => $contest]) }}"
                              enctype="multipart/form-data"
                              method="POST">
                            @csrf

                             <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror"
                                          placeholder="Optionally provide the motivation behind your design"
                                          id="description"
                                          rows="3"
                                          name="description">{{ old('description') }}</textarea>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="file">File</label>
                                <input type="file" class="form-control-file" id="file" name="file">

                                @error('file')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Upload submission</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
