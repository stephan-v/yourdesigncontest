@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if (count($contests))
                    <h1 class="mt-5">Send an invite</h1>

                    <form action="{{ route('users.invites.store', $invitee) }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="contest_id">Contest</label>

                            <select name="contest_id" class="form-control @error('contest') is-invalid @enderror" id="contest_id">
                                @foreach ($contests as $contest)
                                    <option value="{{ $contest->id }}" @if (old('contest_id') == $contest->id) selected @endif>
                                        {{ $contest->name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('contest_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="message">Your invitation message.</label>

                            <textarea class="form-control @error('message') is-invalid @enderror"
                                      placeholder="Optionally provide a custom message"
                                      id="message"
                                      rows="3"
                                      name="message">{{ old('message') }}</textarea>

                            @error('message')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Invite</button>
                    </form>
                @else
                    <h1>You don't have any running contests to invite a user to.</h1>
                @endif
            </div>
        </div>
    </div>
@endsection
