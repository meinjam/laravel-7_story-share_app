@extends('layouts.admin-app')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-2">
            <div class="bg-success">
                <div class="card text-center bg-dark text-white mb-2">
                    <div class="card-body">
                        <h1 class="lead">Users</h1>
                        <h4 class="display-5">
                            <i class="fas fa-user"></i> {{ $user->count() }}
                        </h4>
                    </div>
                </div>
            </div>
            <div class="bg-success">
                <div class="card text-center bg-dark text-white mb-2">
                    <div class="card-body">
                        <h1 class="lead">Admins</h1>
                        <h4 class="display-5">
                            <i class="fas fa-user-cog"></i> {{ $admin->count() }}
                        </h4>
                    </div>
                </div>
            </div>
            <div class="bg-success">
                <div class="card text-center bg-dark text-white mb-2">
                    <div class="card-body">
                        <h1 class="lead">Stories</h1>
                        <h4 class="display-5">
                            <i class="fab fa-readme"></i> {{ $story->count() }}
                        </h4>
                    </div>
                </div>
            </div>
            <div class="bg-success">
                <div class="card text-center bg-dark text-white mb-2">
                    <div class="card-body">
                        <h1 class="lead">Categories</h1>
                        <h4 class="display-5">
                            <i class="far fa-bookmark"></i> {{ $category->count() }}
                        </h4>
                    </div>
                </div>
            </div>
            <div class="bg-success">
                <div class="card text-center bg-dark text-white mb-2">
                    <div class="card-body">
                        <h1 class="lead">Tags</h1>
                        <h4 class="display-5">
                            <i class="fas fa-tag"></i> {{ $tag->count() }}
                        </h4>
                    </div>
                </div>
            </div>
            <div class="bg-success">
                <div class="card text-center bg-dark text-white mb-2">
                    <div class="card-body">
                        <h1 class="lead">Comments</h1>
                        <h4 class="display-5">
                            <i class="fas fa-comments"></i> {{ $comment->count() }}
                        </h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-10">
            @include('layouts.message')

            <h2>Search Result</h2>
            <hr>
            <form action="{{ route('search.stories') }}" method="get">
                <div class="input-group mb-3 input-group-lg">
                    <input type="text" class="form-control" name="search" placeholder="Search stories by title & body text">
                    <div class="input-group-append">
                      <button class="btn btn-success btn-lg" type="submit">Search</button>
                    </div>
                </div>
            </form>

            @if (!$result->count())
                <h2>Sorry, No story found.</h2>
            @else
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Date & Time</th>
                        <th>Author</th>
                        <th>Comments</th>
                        <th>Details</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($result as $story)
                    <tr>
                        <td>{{ $story->id }}</td>
                        <td><img src="{{ asset($story->image) }}" height="70" alt="{{ $story->title }}"></td>
                        <td>{{ $story->title }}</td>
                        <td>{{ $story->created_at->format('h:i a, d M Y') }}</td>
                        <td><a href="{{ route('profile', $story->user->slug) }}" target="_blank">{{ $story->user->name }}</a></td>
                        <td>{{ $story->comments->count() }}</td>
                        <td><a href="{{ route('single.story', $story->slug) }}" class="btn btn-info" target="_blank">Preview</a></td>
                        <td>
                            @if (!$story->is_published)
                            <a href="{{ route('unblock.story', $story->slug) }}" class="btn btn-success">Unblock</a>
                            @else
                            <a href="{{ route('block.story', $story->slug) }}" class="btn btn-danger">Block</a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $result->links() }}
            @endif

        </div>
    </div>
</div>
@endsection