@extends('layouts.app')

@section('content')

    <h3>List of elections</h3>
    <div class="row">
        @forelse($elections as $election)
            <div class="col-md-4 col-sm-4">
                <div class="card">
                    <h5 class="card-header">{{$election->title}}</h5>
                    <div class="card-body">
                        <p>{!! $election->description !!}</p>
                    </div>
                    <div class="card-footer text-center">
                        <a href="{{ route('elections.show', $election->id) }}" class="btn btn-outline-success">View</a>
                        <a href="{{ route('elections.edit', $election->id) }}" class="btn btn-outline-primary">Edit</a>
                    </div>
                </div>
            </div>
        @empty
            <p>No candidates found!</p>
        @endforelse
    </div>

@endsection
