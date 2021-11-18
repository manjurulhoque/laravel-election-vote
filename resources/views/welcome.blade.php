@extends('layouts.app')

@section('styles')

    <link rel="stylesheet" href="{{ asset('css/feature.css') }}" type="text/css">

@endsection

@section('content')

    <div class="feature_area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title t_center">
                        <!-- title -->
                        <h2>what we do</h2>
                        <!-- IMAGE -->
                        <div class="em-image">
                            <img src="{{ asset('img/icon.png') }}" alt="title image"/>
                        </div>
                        <!-- TEXT -->
                        <p class=" text-alignm">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-6 col-xm-6">
                        <div class="em-feature">
                            <div class="feature_inner_box">
                                <div class="feature_inner">
                                    <div class="em_feature-icon">
                                        <span><i class="fa fa-location-arrow"></i></span>
                                    </div>
                                    <div class="em-feature-title">
                                        <h2>Our Campaign</h2>
                                    </div>
                                </div>
                                <div class="em_content_text">
                                    <div class="em-feature-desc">
                                        <p>Lorem ipsum dolor sit amet, cata adipisicing elit, sed do eiusmod temapor
                                            incididunt utn labore et dolore magna</p>
                                    </div>
                                </div>
                                <div class="f-readmore">
                                    <div class="feature_button">
                                        <a href="#">Read More<span><i class="fa fa-long-arrow-right"></i></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xm-6">
                        <div class="em-feature">
                            <div class="feature_inner_box">
                                <div class="feature_inner">
                                    <div class="em_feature-icon">
                                        <span><i class="fa fa-volume-up"></i></span>
                                    </div>
                                    <div class="em-feature-title">
                                        <h2>Become A Member</h2>
                                    </div>
                                </div>
                                <div class="em_content_text">
                                    <div class="em-feature-desc">
                                        <p>Lorem ipsum dolor sit amet, cata adipisicing elit, sed do eiusmod temapor
                                            incididunt utn labore et dolore magna</p>
                                    </div>
                                </div>
                                <div class="f-readmore">
                                    <div class="feature_button">
                                        <a href="#">Read More<span><i class="fa fa-long-arrow-right"></i></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xm-6">
                        <div class="em-feature">
                            <div class="feature_inner_box">
                                <div class="feature_inner">
                                    <div class="em_feature-icon">
                                        <span><i class="fa fa-mobile-phone"></i></span>
                                    </div>
                                    <div class="em-feature-title">
                                        <h2>Energy Policy</h2>
                                    </div>
                                </div>
                                <div class="em_content_text">
                                    <div class="em-feature-desc">
                                        <p>Lorem ipsum dolor sit amet, cata adipisicing elit, sed do eiusmod temapor
                                            incididunt utn labore et dolore magna</p>
                                    </div>
                                </div>
                                <div class="f-readmore">
                                    <div class="feature_button">
                                        <a href="#">Read More<span><i class="fa fa-long-arrow-right"></i></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
