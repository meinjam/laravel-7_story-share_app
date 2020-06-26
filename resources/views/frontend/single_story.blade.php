@extends('layouts.app')

@section('content')
<div class="container">
    @include('layouts.message')
    <div class="row">
        <div class="col-md-8">

            <div class="card mb-4 shadow">
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
                    <p class="text-justify">{!! nl2br(e($story->story))!!}</p>
                    <strong><i class="far fa-comment-dots"></i> Comments: {{ $story->comments->count() }}</strong>
                </div>
            </div>

            @guest
                <h2 class="text-danger">Please <a href="{{ URL('/login') }}">Sign in</a> for seeing and posting comments.</h2>
            @else
            <h2>Leave a Reply?</h2>
                @if ($story->is_published)
                    <form action="{{ route('store.comment', $story->id) }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="comment">Enter Comment:</label>
                            <div>
                                <textarea name="comment" class="form-control" id="comment" rows="5" value="{{ old('comment') }}"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Post Comment</button>
                        </div>
                    </form>
                @else
                    <h3 class="text-danger">Sorry, The Story is blocked by the admin. You can not reply.</h3>
                @endif

            <h2 class="mt-4">All Comments ({{ $story->comments->count() }})</h2>
            @foreach ($story->comments as $comment)
            <div class="card p-3 shadow mb-2">
                <div class="row">
                    <div class="col-2">
                        @if ($comment->user->avatar)
                        <img src="{{ asset($comment->user->avatar) }}" class="img-fluid rounded-circle" alt="">
                        @else
                        <img src="{{ asset('img/images/user.jpg') }}" class="img-fluid rounded-circle" alt="profile picture">
                        @endif
                    </div>
                    <div class="col-10">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h3 class="d-inline mr-2 my-2"><a href="{{route('profile', $comment->user->slug) }}">{{ $comment->user->name }}</a></h3>
                                @if ($comment->user->is_admin)
                                <p class="d-inline badge badge-pill badge-success">Admin</p>
                                @else
                                <p class="d-inline badge badge-pill badge-secondary">User</p>
                                @endif
                            </div>
                            @if (Auth::id() == $comment->user->id)
                            <a href="{{ route('delete.comment', $comment->id) }}" class="d-inline text-danger"><i class="fas fa-trash-alt text-danger"></i></a>
                            @endif
                        </div>
                        <p class="text-justify">{{ $comment->comment }}</p>
                        <p class="text-muted">{{ $comment->created_at->format('M d, Y h:i a') }}</p>
                    </div>
                </div>
            </div>
            @endforeach
            @endauth

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
                    <h2>Top 5 Categories</h2>
                </div>
                <div class="card-body">
                    @foreach ($categories as $category)
                    <p><i class="fas fa-circle"></i> <a
                            href="{{ route('show.category', strtolower($category->name)) }}">{{ ucwords($category->name) }}</a> ({{ $category->stories->count() }} stories)
                    </p>
                    @endforeach
                </div>
            </div>
            <div class="card mb-3 shadow">
                <div class="card-header">
                    <h2>Top 5 Tags</h2>
                </div>
                <div class="card-body">
                    @foreach ($tags as $tag)
                    <p><i class="fas fa-tags"></i> <a
                            href="{{ route('show.tag', strtolower($tag->tag)) }}">{{ ucwords($tag->tag) }}</a> ({{ $tag->stories->count() }} stories)</p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection