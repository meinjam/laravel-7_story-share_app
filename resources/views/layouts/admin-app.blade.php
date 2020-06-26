<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | A Simple Story Sharing App (by inzam)</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    {{-- Font Awesome --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/js/all.min.js"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body{
            font-family: 'Nunito', sans-serif, "SolaimanLipiNormal";
        }
    </style>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-info shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ route('admin.homepage') }}">
                    App Admin Panel
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ route('admin.homepage') }}">Home</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ route('profile', Auth::user()->slug) }}" target="_blank">Profile</a>
                        </li>
                        {{-- @auth
                        
                        @if (Auth::user()->is_admin)
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ url('/admin') }}">Admin Panel</a>
                        </li>
                        @endif
                        @endauth --}}
                        @guest
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown active">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('homepage') }}">
                                    Go To Frontend
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <section class="bg-secondary">
            <div class="container py-4">
                <div class="row">
                    <div class="col-md-2">
                        <a href="{{ route('admin.homepage') }}" class="btn btn-success btn-block">All Stories</a>
                    </div>
                    <div class="col-md-2">
                        <a href="{{ route('admin.all-users') }}" class="btn btn-dark btn-block">All Users</a>
                    </div>
                    <div class="col-md-2">
                        <a href="{{ route('admin.all-admins') }}" class="btn btn-danger btn-block">All Admins</a>
                    </div>
                    <div class="col-md-2">
                        <a href="{{ route('admin.category') }}" class="btn btn-warning btn-block">All Categories</a>
                    </div>
                    <div class="col-md-2">
                        <a href="{{ route('admin.tag') }}" class="btn btn-light btn-block">All Tags</a>
                    </div>
                    <div class="col-md-2">
                        <a href="{{ route('all.comments') }}" class="btn btn-primary btn-block">All Comments</a>
                    </div>
                </div>
            </div>
        </section>

        <main class="py-4">
            @yield('content')
        </main>

        <footer class="bg-info text-white pt-4 pb-1">
            <div class="container">
                <h5 class="text-center">Copyright &copy; 2020. Story Share App. All rights reserved</h5>
                <p class="lead text-center">made with ❤️️ by <a href="https://github.com/meinjam"
                        target="_blank">ইনজামামুল হক</a></p>
            </div>
        </footer>
    </div>
</body>

</html>