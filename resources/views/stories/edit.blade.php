@extends('layouts.app')
@section('title') Edit Story - {{ $story->title }} @endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            @include('layouts.message')
            <div class="d-flex">
                <h2>Edit Story</h2>
            </div>
            <hr>

            <div class="card shadow">
                <form action="{{ route('update.story', $story->slug) }}" method="post" enctype="multipart/form-data"
                    class="p-5">
                    @csrf

                    {{-- Title --}}
                    <div class="form-group">
                        <label for="title">Enter Title:</label>
                        <div>
                            <input id="title" type="text" class="form-control" name="title" value="{{ $story->title }}">
                        </div>
                    </div>

                    {{-- Category --}}
                    <div class="form-group">
                        <label for="category">Select a Category:</label>
                        <select name="category_id" id="category" class="form-control">
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                <?php if($category->id == $story->category_id) echo "selected" ?>>{{ $category->name }}
                            </option>
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
                            <label><input type="checkbox" name="tags[]" value="{{ $tag->id }}" @foreach ($story->tags as
                                $t)
                                @if ($tag->id==$t->id)
                                checked
                                @endif
                                @endforeach
                                > {{ $tag->tag }}</label>
                        </div>
                        @endforeach
                        <small class="text-muted">If tags don't match to your story, please <a
                                href="{{ route('create.tag') }}"><strong>create</strong></a> new tags.</small>
                    </div>

                    {{-- Image --}}
                    <div class="form-group">
                        <label for="image">Select Image:</label>

                        <div class="custom-file">
                            <input type="file" name="image" class="custom-file-input" id="image">
                            <label class="custom-file-label" for="image">Choose file...</label>
                        </div>
                    </div>

                    {{-- Description --}}
                    <div class="form-group">
                        <label for="story">Enter Description:</label>
                        <div>
                            <textarea name="story" class="form-control" id="story"
                                rows="5">{{ $story->story }}</textarea>
                        </div>
                    </div>

                    {{-- Submit --}}
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Update</button>
                        <a href="{{ route('profile', Auth::user()->slug) }}" class="btn btn-primary">Back To Profile</a>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>
@endsection