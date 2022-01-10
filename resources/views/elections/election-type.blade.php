@extends('layouts.app')

@section('content')

    <h3>Elections by type: {{ $type }}</h3>
    <div class="row">
        @foreach($elections as $election)
            <div class="col-md-12 mt-3">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        {{ $election->title }}
                    </div>
                    <div class="card-body">
                        <p>{!! $election->description !!}</p>
                    </div>
                    <div class="card-footer">
                        <p>Is running: {{ $election->is_active ? "Yes": "No" }}</p>
                        <p>Start at: {{ $election->start_date }}</p>
                        <p>End at: {{ $election->end_date }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@endsection
