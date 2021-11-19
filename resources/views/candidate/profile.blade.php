@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">
            <h6 class="text-left">Profile of <b>{{$candidate->name}}</b></h6>
            <a href="{{ route('candidate.profile.edit') }}" class="text-right btn btn-success">Update</a>
        </div>
        <div class="card-body">
            <p>Email: {{$candidate->email}}</p>
            <p>Image:</p>
            @if(!isset($candidate->image))
                <img src="{{ asset('img/default.png') }}" alt="">
            @else
                <img src="{{ asset($candidate->image) }}" alt="">
            @endif
        </div>
    </div>

@endsection
