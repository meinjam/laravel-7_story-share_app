@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-3 shadow">
                <img class="card-img-top" src="{{ asset($story->image) }}" alt="{{ $story->title }}">
                <div class="card-body">
                    <h2 class="card-title text-justify">{{ $story->title }}</h2>
                    <div class="d-flex justify-content-between mb-2">
                        @if (Auth::id() == $story->user->id)
                        <a href="{{ route('edit.story', $story->slug) }}"><i
                                class="far fa-edit text-success fa-2x mr-2"></i></a>
                        <a href="{{ route('delete.story', $story->slug) }}"><i
                                class="fas fa-trash-alt text-danger fa-2x"></i></a>
                        @endif
                    </div>
                    <div class="d-flex justify-content-between">
                        <p><i class="far fa-user"></i> <a
                                href="{{ route('profile', $story->user->slug) }}">{{ $story->user->name }}</a></p>
                        <p><i class="far fa-clock"></i> {{ $story->created_at->format('h:i a, d M Y') }}</p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <p><i class="far fa-bookmark"></i> <a
                                href="{{ route('show.category', strtolower($story->category->name)) }}">{{ ucwords($story->category->name) }}</a>
                        </p>
                        <p><i class="fas fa-tags"></i>
                            @foreach ($story->tags as $tag)
                            <a href="{{ route('show.tag', strtolower($tag->tag)) }}">{{ ucwords($tag->tag) }},</a>
                            @endforeach
                        </p>
                    </div>
                    <p class="text-justify">{{ $story->story }}</p>
                    <p><i class="far fa-comment-dots"></i> Comments: 0</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-3 shadow">
                <img class="card-img-top" src="{{ asset('img/images/image.jpg') }}" alt="sample image">
                <div class="card-body">
                    <h2>A Simple Story Sharing Website</h2>
                    <p class="card-text text-justify">Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam,
                        beatae fugiat
                        maxime sed,
                        aliquid doloremque omnis nesciunt earum iure, aut sequi dolores praesentium optio quis libero
                        tempora esse
                        debitis laborum?</p>
                </div>
            </div>
            <div class="card mb-3 shadow">
                <div class="card-header">
                    <h2>Categories</h2>
                </div>
                <div class="card-body">
                    @foreach ($categories as $category)
                    <p><i class="fas fa-circle"></i> <a
                            href="{{ route('show.category', strtolower($category->name)) }}">{{ ucwords($category->name) }}</a>
                    </p>
                    @endforeach
                </div>
            </div>
            <div class="card mb-3 shadow">
                <div class="card-header">
                    <h2>Tags</h2>
                </div>
                <div class="card-body">
                    @foreach ($tags as $tag)
                    <p><i class="fas fa-tags"></i> <a
                            href="{{ route('show.tag', strtolower($tag->tag)) }}">{{ ucwords($tag->tag) }}</a></p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection