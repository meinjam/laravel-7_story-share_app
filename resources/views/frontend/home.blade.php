@extends('layouts.app')
@section('title') Homepage @endsection
@section('content')
<div class="container">
    @include('layouts.message')
    <h1>Recent Stories</h1>
    <hr>
    <div class="row">
        <div class="col-md-8">
            @include('frontend.mainsection')
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
                    <p><i class="fas fa-circle"></i> <a href="{{ route('show.category', strtolower($category->name)) }}">{{ ucfirst($category->name) }}</a> ({{ $category->stories->count() }} stories)</p>
                    @endforeach
                </div>
            </div>
            <div class="card mb-3 shadow">
                <div class="card-header">
                    <h2>Top 5 Tags</h2>
                </div>
                <div class="card-body">
                    @foreach ($tagssss as $tag)
                    <p><i class="fas fa-tags"></i> <a href="{{ route('show.tag', strtolower($tag->tag)) }}">{{ ucfirst($tag->tag) }}</a> ({{ $tag->stories->count() }} stories)</p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection