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

        .nav-item a {
            font-size: 22px;
        }

        .navbar .navbar-nav > li > a:hover,
        .navbar .navbar-nav > li > a:focus {
            color: #393636 !important;
            background-color: yellow;
        }

    </style>
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm py-0">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Home') }}
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
                            <a class="nav-link text-white" href="{{ route('register.portal') }}">Register</a>
                        </li>

                        {{--                            @if (Route::has('register'))--}}
                        {{--                                <li class="nav-item">--}}
                        {{--                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>--}}
                        {{--                                </li>--}}
                        {{--                            @endif--}}
                    @else
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('published.elections') }}">Results</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('candidates.list') }}">Candidates</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                @if(auth()->user()->role == 'voter')
                                    <a class="dropdown-item" href="{{ route('voter.profile') }}">My Profile</a>
                                @endif

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

    @if(\Route::currentRouteName() == 'welcome')
        <div class="container-fluid p-0">
            @include('layouts.flash')
            @yield('content')
        </div>
    @else
        <main class="py-4">
            <div class="container">
                @include('layouts.flash')
                @yield('content')
            </div>
        </main>
    @endif
</div>

@yield('scripts')
</body>
</html>
