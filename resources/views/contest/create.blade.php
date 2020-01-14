@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row pt-5">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-body">
                        <h1>Create a contest</h1>

                        <form action="/contests" method="post">
                            @csrf

                            <div class="form-group">
                                <label for="name">Contest name</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Name of your contest" value="{{ old('name') }}">
                                <small class="form-text text-muted">Please provide the name of your design contest.</small>
                            </div>

                            <div class="form-group">
                                <label for="name">Contest description</label>
                                <textarea name="description" class="form-control" id="description" rows="5" placeholder="Briefing of your contest" value="{{ old('description') }}"></textarea>
                                <small class="form-text text-muted">Please provide a short briefing for your design contest.</small>
                            </div>

                            <div class="form-group">
                                <label for="expires_at">Expires in</label>
                                <select name="expires_at" class="form-control" id="expires_at">
                                    @for ($i = 1; $i <= 4; $i++)
                                        <option value="{{ $i }}" @if (old('expires_at') == $i) selected @endif>
                                            {{ $i }} {{ Str::plural('week', $i) }}
                                        </option>
                                    @endfor
                                </select>
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

                            <button type="submit" class="btn btn-primary">Next</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection