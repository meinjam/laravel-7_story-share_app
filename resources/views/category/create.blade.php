@extends('layouts.app')
@section('title') Add New Category @endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            @include('layouts.message')
            <div>
                <h2>Add New Category</h2>
                <hr>

                <div class="card shadow">
                    <form action="{{ route('store.category') }}" method="post" class="p-5">
                        @csrf
                        <div class="form-group">
                            <label for="category">Enter Category Name</label>
                            <div>
                                <input id="category" type="text" class="form-control @error('category') is-invalid @enderror"
                                    name="category" value="{{ old('category') }}" autocomplete="category" autofocus>
                                @error('tag')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Submit</button>
                            <a href="{{ route('create.story') }}" class="btn btn-primary">Back To Story</a>
                        </div>
                    </form>
                </div>

                <h1 class="mt-3">All Categories</h1>
                <table class="table table-striped table-bordered table-hover">
                    <thead class="bg-secondary text-light">
                        <tr>
                            <th>#</th>
                            <th>Category Name</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$category->name}}</td>
                            <td>{{$category->created_at->format('h:i a, M d, Y')}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $categories->links() }}
                
            </div>
        </div>
    </div>
</div>
@endsection