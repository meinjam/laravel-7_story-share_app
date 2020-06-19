@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Update Profile Picture</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('update.profile.picture') }}" enctype="multipart/form-data">
                        @csrf

                        {{-- Profile Picture --}}
                        <div class="form-group row">
                            <label for="avatar" class="col-md-4 col-form-label text-md-right">{{ __('Profile Picture') }}</label>

                            <div class="col-md-6">
                                <div class="custom-file">
                                    <input type="file" name="avatar" class="custom-file-input @error('gender') is-invalid @enderror" id="avatar">
                                    <label class="custom-file-label" for="avatar">Choose file...</label>
                                </div>

                                @error('avatar')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-success">
                                    Update
                                </button>
                                <a href="{{ route('home') }}" class="btn btn-primary">Go Back to Profile</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
