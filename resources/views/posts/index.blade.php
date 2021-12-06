@extends('layouts.app')

@section('content')

    @foreach($posts as $post)
        <div class="d-flex justify-content-center row">
            <div class="col-md-12">
                <div class="d-flex flex-column comment-section">
                    <div class="bg-white p-2">
                        <div class="d-flex flex-row user-info">
                            @if(!isset($post->user->image))
                                <img src="{{ asset('img/default.png') }}" alt=""
                                     class="rounded-circle" width="100">
                            @else
                                <img src="{{ asset($post->user->image) }}" alt=""
                                     class="rounded-circle" width="100">
                            @endif
                            <div class="d-flex flex-column justify-content-start ml-2"><span
                                    class="d-block font-weight-bold name">{{ $post->user->name }}</span>
                                ({{$post->user->role}})
                                <span class="date text-black-50">Created - Jan 2020</span></div>
                        </div>
                        <div class="mt-2">
                            <p class="comment-text">
                                {{ $post->description }}
                            </p>
                        </div>
                    </div>
                    <div class="bg-white">
                        <div class="d-flex flex-row fs-12">
                            <div class="like p-2 cursor"><i class="fa fa-commenting-o"></i><span
                                    class="ml-1">{{count($post->comments)}} Comment</span>
                            </div>
                        </div>
                    </div>
                    <div class="bg-light p-2">
                        <form action="{{ route('comments.store') }}" method="post">
                            @csrf

                            <div class="d-flex flex-row align-items-start">
                                @if(!isset(auth()->user->image))
                                    <img src="{{ asset('img/default.png') }}" alt=""
                                         class="rounded-circle" width="80">
                                @else
                                    <img src="{{ asset(auth()->user->image) }}" alt=""
                                         class="rounded-circle" width="80">
                                @endif
                                <input type="hidden" value="{{ $post->id }}" name="post_id">
                                <textarea class="form-control ml-1 shadow-none textarea" name="description"
                                          required></textarea>
                            </div>
                            <div class="mt-2 text-right">
                                <button class="btn btn-primary btn-sm shadow-none" type="submit">Post comment</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

@endsection
