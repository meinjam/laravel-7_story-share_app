@extends('layouts.admin-app')
@section('title') Add New Admin @endsection
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

            <h2>Create New Admin</h2>
            <hr>
            
            <div class="card-body">
                <form method="POST" action="{{ route('store.admin') }}">
                    @csrf

                    {{-- Name --}}
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    {{-- Email --}}
                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    {{-- Password --}}
                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-success">Add Admin</button>
                            <a href="{{ route('admin.all-admins') }}" class="btn btn-primary">Back to Admin Page</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection