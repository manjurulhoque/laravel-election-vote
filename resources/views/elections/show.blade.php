@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">
            <p class="float-left">Election {{ $election->title }}</p>
            @if($election->is_active)
                <p class="float-right text-primary">Currently active</p>
            @else
                <p class="float-right text-success">Currently not active</p>
            @endif
            <a href="{{ route('elections.show', $election->id) }}" class="float-right mr-1 btn btn-sm btn-outline-info">Edit</a>
        </div>
        <div class="card-body">
            <div>{!! $election->description !!}</div>
        </div>
    </div>

@endsection
