@extends('layouts.app')

@section('content')

    <h3>List of our selected candidates</h3>
    <div class="row">
        @forelse($party_candidates as $party_candidate)
            <div class="col-md-4 col-sm-4">
                <div class="card">
                    <h5 class="card-header">{{$party_candidate->candidate->name}}</h5>
                    <div class="card-body">
                        @if(!isset($party_candidate->candidate->image))
                            <img src="{{ asset('img/default.png') }}" alt="" class="bd-placeholder-img card-img-top">
                        @else
                            <img src="{{ asset($party_candidate->candidate->image) }}" alt="" class="bd-placeholder-img card-img-top">
                        @endif

                        <div class="card-body text-center">
                            <a href="{{ route('candidates.view', $party_candidate->candidate->id) }}" class="btn btn-primary">
                                View candidate
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p>No candidates found!</p>
        @endforelse
    </div>

@endsection
