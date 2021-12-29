@extends('layouts.app')

@section('content')

    <h3>List of political parties</h3>
    <div class="row">
        @forelse($parties as $party)
            <div class="col-md-4 col-sm-4">
                <div class="card">
                    <h5 class="card-header">{{$party->name}}</h5>
                    <div class="card-body">
                        @if(!isset($party->image))
                            <img src="{{ asset('img/default.png') }}" alt="" class="bd-placeholder-img card-img-top">
                        @else
                            <img src="{{ asset($party->image) }}" alt="" class="bd-placeholder-img card-img-top">
                        @endif

                        <div class="card-body text-center">
                            <a href="{{ route('candidates.view', $party->id) }}" class="btn btn-primary">
                                View party profile
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
