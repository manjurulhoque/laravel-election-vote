@extends('layouts.app')

@section('content')

    <h3>List of candidates to select</h3>
    <div class="row">
        @forelse($candidates as $candidate)
            <div class="col-md-4 col-sm-4">
                <div class="card">
                    <h5 class="card-header">{{$candidate->name}}</h5>
                    <div class="card-body">
                        @if(!isset($candidate->image))
                            <img src="{{ asset('img/default.png') }}" alt="" class="bd-placeholder-img card-img-top">
                        @else
                            <img src="{{ asset($candidate->image) }}" alt="" class="bd-placeholder-img card-img-top">
                        @endif

                        <div class="card-body text-center">
                            <a href="{{ route('select.candidate', $candidate->id) }}" class="btn btn-primary">
                                Select candidate
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p>No candidates found to select!</p>
        @endforelse
    </div>

@endsection
