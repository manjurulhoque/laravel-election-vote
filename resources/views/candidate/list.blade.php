@extends('layouts.app')

@section('content')

    <h3>List of candidates</h3>
    <div class="row">
        @forelse($candidates as $candidate)
            <div class="col-md-4 col-sm-4">
                <div class="card">
                    <h5 class="card-header">{{$candidate->name}}</h5>
                    <div class="card-body text-center">
                        @if($candidate->vision)
                            <p class="card-text">{!! $candidate->vision->description !!}</p>
                        @else
                            <p class="card-text">No vision found!</p>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <p>No candidates found!</p>
        @endforelse
    </div>

@endsection
