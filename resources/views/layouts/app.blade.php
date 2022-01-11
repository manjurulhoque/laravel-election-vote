<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"/>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/litera/bootstrap.min.css" rel="stylesheet">

    @yield('styles')
    <style>
        .jumbotron {
            background-image: url("{{ asset('img/bg.png') }}");
            background-position: top;
            height: 300px;
            margin-bottom: 0;
        }

        .cards .card-img-top {
            height: 170px;
        }
    </style>
</head>
<body>
<div id="app">
    @if(Route::currentRouteName() == 'welcome')
        <div class="jumbotron">
            <h1 class="text-white text-center">Online election management system</h1>
        </div>
        <section class="mt-5 mb-3 cards">
            <div class="row">
                <div class="container">
                    <div class="col-md-4">
                        <div class="card" style="width: 18rem;">
                            <img class="card-img-top" src="{{ asset('img/1.jpg') }}" alt="Card image cap">
                            <div class="card-body">
                                <p>
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                    Ipsum
                                    has been the industry's standard dummy text ever since the 1500s, when an unknown
                                    printer took a galley of type and scrambled it to make a type specimen book.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card" style="width: 18rem;">
                            <img class="card-img-top" src="{{ asset('img/2.jpg') }}" alt="Card image cap">
                            <div class="card-body">
                                <p>
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                    Ipsum
                                    has been the industry's standard dummy text ever since the 1500s, when an unknown
                                    printer took a galley of type and scrambled it to make a type specimen book.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card" style="width: 18rem;">
                            <img class="card-img-top" src="{{ asset('img/3.jpeg') }}" alt="Card image cap">
                            <div class="card-body">
                                <p>
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                    Ipsum
                                    has been the industry's standard dummy text ever since the 1500s, when an unknown
                                    printer took a galley of type and scrambled it to make a type specimen book.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            Elections
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('elections.by.type', 'National') }}">National</a>
                            <a class="dropdown-item" href="{{ route('elections.by.type', 'City') }}">City</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('notices.index') }}">Notices</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('published.elections') }}">Elections</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('candidates.list') }}">Candidates</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('parties.list') }}">Parties</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('election.commission.profile') }}">Election
                            Commission</a>
                    </li>
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('register.portal') }}">Register portal</a>
                        </li>

                        {{--                            @if (Route::has('register'))--}}
                        {{--                                <li class="nav-item">--}}
                        {{--                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>--}}
                        {{--                                </li>--}}
                        {{--                            @endif--}}
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                @if(auth()->user()->role == 'candidate')
                                    <a class="dropdown-item" href="{{ route('posts.index') }}">Posts</a>
                                    <a class="dropdown-item" href="{{ route('visions.create') }}">
                                        My Vision
                                    </a>
                                    <a class="dropdown-item" href="{{ route('candidate.profile') }}">
                                        My Profile
                                    </a>
                                    <a class="dropdown-item" href="{{ route('request.to.party') }}">
                                        Request to party
                                    </a>
                                    <a class="dropdown-item" href="{{ route('request.status') }}">
                                        Request status
                                    </a>
                                @endif

                                @if(auth()->user()->role == 'party')
                                    <a class="dropdown-item" href="{{ route('selected.candidates') }}">
                                        Our candidates
                                    </a>
                                    <a class="dropdown-item" href="{{ route('all.candidates.to.select') }}">
                                        Select candidate
                                    </a>
                                    <a class="dropdown-item" href="{{ route('our.manifesto') }}">
                                        Our Manifesto
                                    </a>
                                    <a class="dropdown-item" href="{{ route('upload.profile.image') }}">
                                        Upload profile image
                                    </a>
                                @endif

                                @if(auth()->user()->role == 'election')
                                    <a class="dropdown-item" href="{{ route('parties.list') }}">
                                        Party list
                                    </a>
                                    <a class="dropdown-item" href="{{ route('voter.list') }}">
                                        Voter list
                                    </a>
                                    <a class="dropdown-item" href="{{ route('notices.create') }}">
                                        Create notice
                                    </a>
                                    <a class="dropdown-item" href="{{ route('elections.index') }}">
                                        Election list
                                    </a>
                                    <a class="dropdown-item" href="{{ route('elections.create') }}">
                                        Create new election
                                    </a>
                                    <a class="dropdown-item" href="{{ route('upload.profile.image') }}">
                                        Upload profile image
                                    </a>
                                @endif

                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        <div class="container">
            @include('layouts.flash')
            @yield('content')
        </div>
    </main>
</div>

@yield('scripts')
</body>
</html>
