@extends('layouts.app')

@section('content')

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
                <div class="mt-2"></div>
                @foreach($post->comments as $comment)
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-1">
                                    @if(!isset($comment->user->image))
                                        <img src="{{ asset('img/default.png') }}" alt=""
                                             class="rounded-circle" width="60">
                                    @else
                                        <img src="{{ asset($comment->user->image) }}" alt=""
                                             class="rounded-circle" width="60">
                                    @endif
                                </div>
                                <div class="col-md-11">
                                    <b>{{ $comment->user->name }}</b>
                                    <span>({{ $comment->user->role }})</span>
                                    <p class="comment-text">
                                        {{ $comment->description }}
                                    </p>
                                    <span
                                        class="date text-black-50">Created - {{ $comment->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="bg-light p-2">
                    @guest
                        <p class="text-center">Please <a href="{{ route('login') }}">login</a> to continue</p>
                    @else
                        <form action="{{ route('comments.store') }}" method="post">
                            @csrf

                            <div class="d-flex flex-row align-items-start">
                                @if(!isset(auth()->user()->image))
                                    <img src="{{ asset('img/default.png') }}" alt=""
                                         class="rounded-circle" width="80">
                                @else
                                    <img src="{{ asset(auth()->user()->image) }}" alt=""
                                         class="rounded-circle" width="80">
                                @endif
                                <input type="hidden" value="{{ $post->id }}" name="post_id">
                                <textarea
                                    class="form-control ml-1 shadow-none textarea {{ $errors->has('description') ? ' is-invalid' : '' }}"
                                    name="description"
                                    required></textarea>
                                @if($errors->has('description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="mt-2 text-right">
                                <button class="btn btn-primary btn-sm shadow-none" type="submit">Post comment</button>
                            </div>
                        </form>
                    @endguest
                </div>
            </div>
        </div>
    </div>

@endsection
