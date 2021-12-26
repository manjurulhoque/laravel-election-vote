@extends('layouts.app')

@section('content')

    @auth
        <a href="{{ route('posts.create') }}" class="btn btn-success mb-2">Create post</a>
    @endauth
    @foreach($posts as $post)
        <div class="d-flex justify-content-center row">
            <div class="col-md-12">
                <div class="d-flex flex-column comment-section">
                    <div class="bg-white p-2">
                        <div class="d-flex flex-row user-info">
                            @if(!isset($post->user->image))
                                <img src="{{ asset('img/default.png') }}" alt=""
                                     class="rounded-circle" width="100" height="90">
                            @else
                                <img src="{{ asset($post->user->image) }}" alt=""
                                     class="rounded-circle" width="100" height="90">
                            @endif
                            <div class="d-flex flex-column justify-content-start ml-2">
                                <span class="d-block font-weight-bold name">
                                    <a href="{{ route('posts.show', $post->id) }}">
                                        {{ $post->description }}
                                    </a>
                                </span>
                                <span class="date text-black-50">
                                    Created - {{ $post->created_at->diffForHumans() }}
                                </span>

                                <p class="text-black">
                                    {{ $post->user->name }} ({{$post->user->role}})
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white">
                        <div class="d-flex flex-row fs-12">
                            <div class="like p-2 cursor"><i class="fa fa-comment"></i>
                                <span class="ml-1">{{count($post->comments)}} Comment</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

@endsection
