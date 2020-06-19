@extends('layouts.app')

@section('content')
<div class="container">
    @include('layouts.message')
    <div class="row">
        <div class="col-md-4">
            <p class="text-center">
                <img src="{{ asset(Auth::user()->avatar) }}" height="280" class="rounded-circle" alt="profile picture">
            </p>
            <h2 class="text-center">{{ Auth::user()->name }}</h2>
            <div class="ml-5 pl-3">
                <p>Email: {{ Auth::user()->email }}</p>
                <p>Phone: {{ Auth::user()->phone }}</p>
                <p>Gender: {{ Auth::user()->gender }}</p>
                <p>Birthday: {{ Auth::user()->dob }}</p>
            </div>
            <a href="{{ route('edit.profile.info', Auth::user()->id) }}" class="btn btn-primary btn-sm btn-block">Edit Profile Info</a>
            <a href="{{ route('edit.profile.picture', Auth::user()->id) }}" class="btn btn-secondary btn-sm btn-block">Edit Profile Picture</a>
            <a href="{{ route('edit.profile.password', Auth::user()->id) }}" class="btn btn-success btn-sm btn-block">Update Password</a>
        </div>
        <div class="col-md-8">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quibusdam accusamus, exercitationem esse
                excepturi, eligendi veritatis illo magni distinctio quo odit, quisquam voluptates aspernatur! Nisi iusto
                reprehenderit incidunt est numquam consequuntur cumque magni, asperiores, non, ipsum cum voluptas magnam
                odio laudantium. Quo illum corrupti iusto dolore facere harum asperiores nulla assumenda reprehenderit
                dolorum fuga repellendus eaque exercitationem perferendis repudiandae recusandae, impedit eum aperiam
                similique officia et totam. Consequatur quia itaque quos quas, repellendus, molestias quae, velit vero
                adipisci deleniti eius labore corrupti reprehenderit aut incidunt magni omnis ratione! Praesentium ipsa
                non repellendus quod consequuntur, tempore ullam fugit nam distinctio odit facere repellat illum nobis
                cupiditate in eligendi dicta unde fuga nihil vitae officia magnam nesciunt atque nostrum. Optio dolorum
                quos alias odio beatae accusantium facilis modi amet quis possimus. Minima necessitatibus exercitationem
                dolore molestiae velit dolorum distinctio est autem doloremque eaque eum quas delectus reprehenderit
                laboriosam facilis non nihil quo debitis, vel itaque placeat voluptatem tenetur ipsa cupiditate?
                Tempora, sint soluta nihil enim a incidunt illum et ab eum voluptatum expedita saepe rem officiis labore
                eligendi? Doloribus, tenetur. Facilis blanditiis iste consectetur repellendus libero. Placeat minima
                itaque laboriosam ullam, fugit exercitationem asperiores odit repellat tempore provident tempora in sunt
                perspiciatis magnam?</p>
        </div>
    </div>
</div>
@endsection