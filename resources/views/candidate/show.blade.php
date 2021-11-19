@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">
            Candidate details
        </div>
        <div class="card-body">
            <h3>Name: {{ $candidate->name }}</h3>
            @if(!isset($candidate->image))
                <img src="{{ asset('img/default.png') }}" alt="" class="img-thumbnail">
            @else
                <img src="{{ asset($candidate->image) }}" alt="" class="img-thumbnail">
            @endif
            <h4 class="mt-3">Vision: </h4>
            @if($candidate->vision)
                <div>{!! $candidate->vision->description !!}</div>
            @else
                <p>No vision found!</p>
            @endif
        </div>
    </div>

@endsection
