@extends('layouts.app')

@section('styles')

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

@section('content')

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
                                @if(auth()->user()->role == 'election')
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

@endsection
