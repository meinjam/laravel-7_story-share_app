<div class="card mb-3">
    <img class="card-img-top" src="{{ asset('img/images/image.jpg') }}" alt="sample image">
    <div class="card-body">
        <h2>A Simple Story Sharing Website</h2>
        <p class="card-text text-justify">Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam, beatae fugiat
            maxime sed,
            aliquid doloremque omnis nesciunt earum iure, aut sequi dolores praesentium optio quis libero tempora esse
            debitis laborum?</p>
    </div>
</div>
<div class="card mb-3">
    <div class="card-header">
        <h2>Categories</h2>
    </div>
    <div class="card-body">
        @foreach ($story->category as $category)
        <p><i class="fas fa-circle"></i> {{ $category->name }}</p>
        @endforeach
    </div>
</div>
<div class="card mb-3">
    <div class="card-header">
        <h2>Tags</h2>
    </div>
    <div class="card-body">
        @foreach ($story->tags as $tag)
        {{ $tag->tag }},
        @endforeach
    </div>
</div>