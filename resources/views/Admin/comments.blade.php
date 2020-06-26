@extends('layouts.admin-app')
@section('title') All Comments @endsection
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

            <h2>Latest Comments by user</h2>
            <hr>

            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Comment</th>
                        <th>By</th>
                        <th>Date & Time</th>
                        <th>View</th>
                        {{-- <th>Comments</th>
                        <th>Details</th> --}}
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($comments as $comment)
                    <tr>
                        <td>{{ $comment->id }}</td>
                        <td>{{ $comment->comment }}</td>
                        <td>
                            <a href="{{ route('profile', $comment->user->slug) }}" target="_blank">{{ $comment->user->name }}</a>
                        </td>
                        <td>{{ $comment->created_at->format('h:i a, d M Y') }}</td>
                        <td>
                            <a href="{{ route('single.story', $comment->story->slug) }}" class="btn btn-success" target="_blank">View Story</a>
                        </td>
                        <td>
                            <a href="{{ route('delete.comment', $comment->id) }}" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $comments->links() }}
        </div>
    </div>
</div>
@endsection