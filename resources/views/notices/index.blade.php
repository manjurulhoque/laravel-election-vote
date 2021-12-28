@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-12">
            @forelse($notices as $notice)
                <div class="card mb-3">
                    <div class="card-header text-white bg-primary">
                        <h3>{{ $notice->title }}</h3>
                        @if(auth()->user()->role == 'election')
                            <form action="{{ route('notices.destroy', $notice->id)}}" method="POST" id="delete-form">
                                @csrf
                                @method("DELETE")
                            </form>
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

@endsection
