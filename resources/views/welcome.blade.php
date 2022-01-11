@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/feature.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/timer.css') }}" type="text/css">

    <style>
        .card.commission {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            max-width: 300px;
            margin: auto;
            text-align: center;
        }

        .title {
            color: grey;
            font-size: 18px;
        }

        button {
            border: none;
            outline: 0;
            display: inline-block;
            padding: 8px;
            color: white;
            background-color: #000;
            text-align: center;
            cursor: pointer;
            width: 100%;
            font-size: 18px;
        }

        a {
            text-decoration: none;
            color: black;
        }

        button:hover, a:hover {
            opacity: 0.7;
        }
    </style>
@endsection

@section('scripts')
    <script src="{{ asset('js/timer.js') }}" type="text/javascript"></script>
@endsection

@section('content')

    @if($election && $election->is_active && !$election->is_published)
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body text-center">
                        <h4>Running election</h4>
                        <div id="timer" data-election-start-time="{{ $election->start_time }}"
                             data-election-end-time="{{ $election->end_date }}"></div>
                        <a href="{{ route('vote.now', $election->id) }}" class="btn btn-primary">Vote now</a>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-secondary text-white">
                    Notice board
                </div>
                <div class="card-body">
                    @forelse($notices as $notice)
                        <div class="card mb-3">
                            <div class="card-header text-white bg-primary">
                                <h3>{{ $notice->title }}</h3>
                                @if(auth()->check() && auth()->user()->role == 'election')
                                    <form action="{{ route('notices.destroy', $notice->id)}}" method="POST"
                                          id="delete-form">
                                        @csrf
                                        @method("DELETE")
                                    </form>
                                    <a href="{{ route('notices.show', $notice->id) }}" class="btn btn-sm btn-dark">Show</a>
                                    <a href="{{ route('notices.edit', $notice->id) }}" class="btn btn-sm btn-success">Edit</a>
                                    <a href="{{ route('notices.destroy', $notice->id) }}"
                                       class="btn btn-sm btn-danger" onclick="event.preventDefault();
                                                     document.getElementById('delete-form').submit();">Delete</a>
                                @endif
                            </div>
                            <div class="card-body">
                                <p>{!! $notice->description !!}</p>
                            </div>
                        </div>
                    @empty
                        <h2>No notice found!</h2>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card commission">
                <div class="card-header bg-primary text-white">
                    Election commission
                </div>
                <div class="card-body">
                    @if(!isset($commission->image))
                        <img src="{{ asset('img/default.png') }}" alt=""
                             class="bd-placeholder-img card-img-top" style="width:100%">
                    @else
                        <img src="{{ asset($commission->image) }}" alt=""
                             class="bd-placeholder-img card-img-top" style="width:100%">
                    @endif
                    <h4>{{ $commission->name }}</h4>
                    <p class="title">Election commissioner</p>
                    <p>Email: {{ $commission->email }}</p>
                    <p>
                        <button>Contact</button>
                    </p>
                </div>
            </div>
        </div>
    </div>

{{--    <div class="feature_area">--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <div class="col-md-12">--}}
{{--                    <div class="section-title t_center">--}}
{{--                        <!-- title -->--}}
{{--                        <h2>what we do</h2>--}}
{{--                        <!-- IMAGE -->--}}
{{--                        <div class="em-image">--}}
{{--                            <img src="{{ asset('img/icon.png') }}" alt="title image"/>--}}
{{--                        </div>--}}
{{--                        <!-- TEXT -->--}}
{{--                        <p class=" text-alignm">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam </p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="row">--}}
{{--                    <div class="col-md-4 col-sm-6 col-xm-6">--}}
{{--                        <div class="em-feature">--}}
{{--                            <div class="feature_inner_box">--}}
{{--                                <div class="feature_inner">--}}
{{--                                    <div class="em_feature-icon">--}}
{{--                                        <span><i class="fa fa-location-arrow"></i></span>--}}
{{--                                    </div>--}}
{{--                                    <div class="em-feature-title">--}}
{{--                                        <h2>Our Campaign</h2>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="em_content_text">--}}
{{--                                    <div class="em-feature-desc">--}}
{{--                                        <p>Lorem ipsum dolor sit amet, cata adipisicing elit, sed do eiusmod temapor--}}
{{--                                            incididunt utn labore et dolore magna</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="f-readmore">--}}
{{--                                    <div class="feature_button">--}}
{{--                                        <a href="#">Read More<span><i class="fa fa-long-arrow-right"></i></span>--}}
{{--                                        </a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-md-4 col-sm-6 col-xm-6">--}}
{{--                        <div class="em-feature">--}}
{{--                            <div class="feature_inner_box">--}}
{{--                                <div class="feature_inner">--}}
{{--                                    <div class="em_feature-icon">--}}
{{--                                        <span><i class="fa fa-volume-up"></i></span>--}}
{{--                                    </div>--}}
{{--                                    <div class="em-feature-title">--}}
{{--                                        <h2>Become A Member</h2>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="em_content_text">--}}
{{--                                    <div class="em-feature-desc">--}}
{{--                                        <p>Lorem ipsum dolor sit amet, cata adipisicing elit, sed do eiusmod temapor--}}
{{--                                            incididunt utn labore et dolore magna</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="f-readmore">--}}
{{--                                    <div class="feature_button">--}}
{{--                                        <a href="#">Read More<span><i class="fa fa-long-arrow-right"></i></span>--}}
{{--                                        </a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-md-4 col-sm-6 col-xm-6">--}}
{{--                        <div class="em-feature">--}}
{{--                            <div class="feature_inner_box">--}}
{{--                                <div class="feature_inner">--}}
{{--                                    <div class="em_feature-icon">--}}
{{--                                        <span><i class="fa fa-mobile-phone"></i></span>--}}
{{--                                    </div>--}}
{{--                                    <div class="em-feature-title">--}}
{{--                                        <h2>Energy Policy</h2>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="em_content_text">--}}
{{--                                    <div class="em-feature-desc">--}}
{{--                                        <p>Lorem ipsum dolor sit amet, cata adipisicing elit, sed do eiusmod temapor--}}
{{--                                            incididunt utn labore et dolore magna</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="f-readmore">--}}
{{--                                    <div class="feature_button">--}}
{{--                                        <a href="#">Read More<span><i class="fa fa-long-arrow-right"></i></span>--}}
{{--                                        </a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

@endsection
