@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ $notice->title }}
                    <a href="{{ route('notices.edit', $notice->id) }}" class="btn btn-outline-primary">Edit</a>
                </div>
                <div class="card-body">
                    <p>{!! $notice->description !!}</p>
                </div>
            </div>
        </div>
    </div>

@endsection
