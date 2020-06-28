@extends('layouts.app')
@section('title') Create New Story @endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            @include('layouts.message')
                <h2 class="text-center">Add New Story</h2>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <a href="{{ route('create.tag') }}" class="btn btn-primary btn-block mb-3">Add New Tag</a>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ route('create.category') }}" class="btn btn-secondary btn-block mb-3">Add New Category</a>
                    </div>
                </div>
            <div class="card shadow">
                <form action="{{ route('store.story') }}" method="post" enctype="multipart/form-data" class="p-5">
                    @csrf

                    {{-- Title --}}
                    <div class="form-group">
                        <label for="title">Enter Title:</label>
                        <div>
                            <input id="title" type="text" class="form-control @error('title') is-invalid @enderror"
                                name="title" value="{{ old('title') }}" autocomplete="title" autofocus>
                            @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    {{-- Category --}}
                    <div class="form-group">
                        <label for="category">Select a Category:</label>
                        <select name="category_id" id="category" class="form-control">
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <small class="text-muted">If category don't match to your story, please <a
                                href="{{ route('create.category') }}"><strong>create</strong></a> a new
                            category.</small>
                    </div>

                    {{-- Tags --}}
                    <div class="form-group">
                        <label>Select Tags:</label>
                        @foreach ($tags as $tag)
                        <div class="checkbox">
                            <label><input type="checkbox" name="tags[]" value="{{ $tag->id }}"> {{ $tag->tag }}</label>
                        </div>
                        @endforeach
                        <small class="text-muted">If tags don't match to your story, please <a
                                href="{{ route('create.tag') }}"><strong>create</strong></a> new tags.</small>
                    </div>

                    {{-- Image --}}
                    <div class="form-group">
                        <label for="image">Select Image:</label>

                        <div class="custom-file">
                            <input type="file" name="image"
                                class="custom-file-input @error('image') is-invalid @enderror" id="image">
                            <label class="custom-file-label" for="image">Choose file...</label>
                        </div>

                        @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    {{-- Description --}}
                    <div class="form-group">
                        <label for="story">Enter Description:</label>
                        <div>
                            {{-- <input id="story" type="text" class="form-control @error('category') is-invalid @enderror"
                                name="category" value="{{ old('category') }}" autocomplete="category" autofocus> --}}
                            <textarea name="story" class="form-control @error('story') is-invalid @enderror" id="story"
                                rows="5" value="{{ old('story') }}" autocomplete="story" autofocus></textarea>
                            @error('story')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    {{-- Submit --}}
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Submit</button>
                        <a href="{{ route('profile', Auth::user()->slug) }}" class="btn btn-primary">Back To Profile</a>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>
@endsection