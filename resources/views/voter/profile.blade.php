@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">
            <h6 class="text-left">Profile of <b>{{$voter->name}}</b></h6>
{{--            <a href="{{ route('candidate.profile.edit') }}" class="text-right btn btn-success">Update</a>--}}
        </div>
        <div class="card-body">
            <p>Name: {{$voter->name}}</p>
            <p>Email: {{$voter->email}}</p>
            <p>Age: {{$voter->age}}</p>
            <p>Gender: {{$voter->gender}}</p>
            <p>NID: {{$voter->nid}}</p>
            <p>Image:</p>
            @if(!isset($voter->image))
                <img src="{{ asset('img/default.png') }}" alt="">
            @else
                <img src="{{ asset($voter->image) }}" alt="">
            @endif
        </div>
    </div>

@endsection
