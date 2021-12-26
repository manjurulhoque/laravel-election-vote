@extends('layouts.app')

@section('content')

    <h3>List of voters</h3>
    <div class="row">
        @forelse($voters as $voter)
            <div class="col-md-4 col-sm-4 mt-3">
                <div class="card">
                    <h5 class="card-header">
                        {{$voter->name}}
                        <small>({{$voter->email}})</small>
                    </h5>
                    <div class="card-body">
                        @if(!isset($voter->image))
                            <img src="{{ asset('img/default.png') }}" alt="" class="bd-placeholder-img card-img-top">
                        @else
                            <img src="{{ asset($voter->image) }}" alt="" class="bd-placeholder-img card-img-top">
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <p>No voters found!</p>
        @endforelse
    </div>

@endsection
