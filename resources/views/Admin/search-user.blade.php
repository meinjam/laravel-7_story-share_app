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

            <h2>All Search Results</h2>
            <hr>
            <form action="{{ route('search.users') }}" method="get">
                <div class="input-group mb-3 input-group-lg">
                    <input type="text" class="form-control" name="search"
                        placeholder="Search user by their name">
                    <div class="input-group-append">
                        <button class="btn btn-success btn-lg" type="submit">Search</button>
                    </div>
                </div>
            </form>

            @if (!$result->count())
                <h2>Sorry, no results found.</h2>
            @else
                
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Joining Date</th>
                        <th>Stories</th>
                        <th>Comments</th>
                        <th>Profile</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($result as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td><img src="{{ asset($user->avatar) }}" height="70" alt="{{ $user->name }}"></td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->created_at->format('h:i a, d M Y') }}</td>
                        <td>{{ $user->stories->count() }}</td>
                        <td>{{ $user->comments->count() }}</td>
                        <td>
                            <a href="{{ route('profile', $user->slug) }}" class="btn btn-secondary btn-sm"
                                target="_blank">Profile</a>
                        </td>
                        <td>
                            <a href="{{ route('make.admin', $user->slug) }}" class="btn btn-success btn-sm">Make Admin</a>
                            <a href="{{ route('delete.user', $user->slug) }}" class="btn btn-danger btn-sm">Block</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- {{ $result->links() }} --}}
            @endif
        </div>
    </div>
</div>
@endsection