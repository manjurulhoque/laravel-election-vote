@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/feature.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/timer.css') }}" type="text/css">

    <style>
        .card.commission {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
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

        .banner {
            background-image: url("{{ asset('img/banner.jpeg') }}") !important;
            background-position: bottom;
            background-repeat: no-repeat;
            background-size: cover;
            height: 700px !important;
            margin-bottom: 0;
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

    @if(auth()->guest() || (auth()->check() && auth()->user()->role != 'election'))
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
    @else
        <div class="jumbotron banner">
            <h1 class="text-white text-center">Online election management system</h1>
        </div>

        <div class="row mt-2">
            <div class="col-md-2">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        Notice board
                        <a href="{{ route('notices.index') }}" class="text-white float-right">See all</a>
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
                                        <a href="{{ route('notices.edit', $notice->id) }}"
                                           class="btn btn-sm btn-success">Edit</a>
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
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        Election commission
                    </div>
                    <div class="card-body">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link">
                                    <i class="fa fa-chevron-right"></i>
                                    ১৬ জানুয়ারী ২০২২ তারিখে অনুষ্ঠিতব্য নির্বাচন উপলক্ষে আইনশৃঙ্খলা সমন্বয় ও মনিটরিং সেল
                                    গঠন ।
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link">
                                    <i class="fa fa-chevron-right"></i>
                                    জাতীয় সংসদের ১৩৬ টাঙ্গাইল-৭ আসনের নির্বাচনে ইলেক্ট্রনিক ভোটিং মেশিন (ইভিএম) এর
                                    মাধ্যমে ভোটগ্রহণ সংক্রান্ত পরিপত্র
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link">
                                    <i class="fa fa-chevron-right"></i>
                                    নারায়ণগঞ্জ সিটি কর্পোরেশন নির্বাচন, ২০২২ এ ইলেক্ট্রনিক ভোটিং মেশিন (ইভিএম) এর
                                    মাধ্যমে ভোটগ্রহণ সংক্রান্ত পরিপত্র
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link">
                                    <i class="fa fa-chevron-right"></i>
                                    ০৫ টি পৌরসভার সাধারণ নির্বাচন ইলেক্ট্রনিক ভোটিং মেশিন (ইভিএম) এর মাধ্যমে ভোটগ্রহণ
                                    সংক্রান্ত পরিপত্র
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link">
                                    <i class="fa fa-chevron-right"></i>
                                    আগামী ১৬ জানুয়ারি, ২০২২ খ্রিঃ তারিখে অনুষ্ঠিতব্য পৌরসভা নির্বাচন উপলক্ষে বিজ্ঞ
                                    জুডিসিয়াল ম্যাজিস্ট্রেটগণের নিয়োগ সংক্রান্ত প্রজ্ঞাপন
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link">
                                    <i class="fa fa-chevron-right"></i>
                                    নারায়ণগঞ্জ সিটি কর্পোরেশন নির্বাচনে নির্বাচনি বিরোধ সংক্রান্ত দরখাস্ত/ আপিল গ্রহণ,
                                    শুনানি ও নিষ্পত্তির লক্ষ্যে "নির্বাচনি ট্রাইব্যুনাল" ও "নির্বাচনি আপিল ট্রাইব্যুনাল"
                                    গঠন সংক্রান্ত প্রজ্ঞাপন
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link">
                                    <i class="fa fa-chevron-right"></i>
                                    একাদশ জাতীয় সংসদের শূন্য ঘোষিত ১৩৬ টাঙ্গাইল-৭ আসনে নির্বাচন উপলক্ষে বিজ্ঞ জুডিসিয়াল
                                    ম্যাজিস্ট্রেট নিয়োগ সংক্রান্ত প্রজ্ঞাপন
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link">
                                    <i class="fa fa-chevron-right"></i>
                                    নারায়ণগঞ্জ সিটি কর্পোরেশন নির্বাচন উপলক্ষে বিজ্ঞ জুডিসিয়াল ম্যাজিস্ট্রেটগণের নিয়োগ
                                    সংক্রান্ত প্রজ্ঞাপন
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="card commission">
                    <div class="card-header bg-dark text-white">
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
    @endif

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
