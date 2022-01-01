@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h3>Vote now</h3>
                </div>
                <div class="card-body">
                    <h3>List of candidates</h3>
                    <div class="row">
                        @forelse($party_candidates as $party_candidate)
                            <div class="col-md-4 col-sm-4">
                                <div class="card">
                                    <h5 class="card-header">{{$party_candidate->candidate->name}}</h5>
                                    <div class="card-body">
                                        @if(!isset($party_candidate->candidate->image))
                                            <img src="{{ asset('img/default.png') }}" alt=""
                                                 class="bd-placeholder-img card-img-top">
                                        @else
                                            <img src="{{ asset($party_candidate->candidate->image) }}" alt=""
                                                 class="bd-placeholder-img card-img-top">
                                        @endif

                                        <div class="text-center">

                                            @if($party_candidate->party)
                                                <p>Party: {{ $party_candidate->party->name }}</p>
                                            @else
                                                <p>Party: </p>
                                            @endif

                                            <a href="{{ route('candidates.view', $party_candidate->candidate->id) }}"
                                               class="btn btn-primary">
                                                View candidate
                                            </a>
                                            @if(auth()->check() && auth()->user()->role == 'voter')
                                                <a href="{{ route('vote.now.store', [$election->id, $party_candidate->candidate->id]) }}"
                                                   class="btn btn-success" onclick="return confirm('Are you sure?')">
                                                    Vote me!
                                                </a>
                                            @else
                                                <p class="text-danger">You are not allowed to vote!</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p>No candidates found!</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
