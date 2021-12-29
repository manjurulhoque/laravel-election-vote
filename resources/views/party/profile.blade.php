@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Profile of <b>{{ $party->name }}</b>
                </div>
                <div class="card-body">
                    Image:
                    @if(!isset($party->image))
                        <img src="{{ asset('img/default.png') }}" alt="" class="img-thumbnail" width="200">
                    @else
                        <img src="{{ asset($party->image) }}" alt="" class="img-thumbnail" width="200">
                    @endif

                    <h3 class="mt-5">Manifesto</h3>
                    @if($manifesto)
                        <div>{!! $manifesto->description !!}</div>
                    @else
                        <p>No manifesto found!</p>
                    @endif

                    <h3 class="mt-5">Candidates</h3>
                    @forelse($party->party_candidates as $party_candidate)
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

                                    <div class="card-body text-center">
                                        <a href="{{ route('candidates.view', $party_candidate->candidate->id) }}"
                                           class="btn btn-primary">
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
            </div>
        </div>
    </div>

@endsection
