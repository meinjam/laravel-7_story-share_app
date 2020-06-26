@if (count($stories) == 0)
<h1>Opps, No Story Found!!!</h1>
@else
@foreach ($stories as $story)
<div class="card mb-3 shadow">
    <img class="card-img-top" src="{{ asset($story->image) }}" alt="{{ $story->title }}">
    <div class="card-body">
        <h2 class="card-title">{{ $story->title }}</h2>
        <div class="d-flex justify-content-between">
            <p><i class="far fa-user"></i> <a
                    href="{{ route('profile', $story->user->slug) }}">{{ ucwords($story->user->name) }}</a></p>
            <p><i class="far fa-bookmark"></i> <a
                    href="{{ route('show.category', strtolower($story->category->name)) }}">{{ ucfirst($story->category->name) }}</a>
            </p>
            <p><i class="far fa-clock"></i> {{ $story->created_at->diffForHumans() }}</p>
        </div>
        <div class="d-flex justify-content-between">
            <p><i class="fas fa-tags"></i>
                @foreach ($story->tags as $tag)
                <a href="{{ route('show.tag', strtolower($tag->tag)) }}">{{ ucfirst($tag->tag) }},</a>
                @endforeach
            </p>
            <p><i class="far fa-comment-dots"></i> Comments: {{ $story->comments->count() }}</p>
        </div>
        <div class="d-flex justify-content-between">
            <div class="mt-2">
                @if (Auth::id() == $story->user->id)
                <a href="{{ route('edit.story', $story->slug) }}"><i
                        class="far fa-edit text-success fa-2x mr-2"></i></a>
                <a href="{{ route('delete.story', $story->slug) }}"><i
                        class="fas fa-trash-alt text-danger fa-2x"></i></a>
                @endif
            </div>
            <a href="{{ route('single.story', $story->slug) }}" class="btn btn-primary float-right">Read More >>></a>
        </div>
    </div>
</div>
@endforeach
{{ $stories->links() }}
@endif