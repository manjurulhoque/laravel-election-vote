@extends('layouts.app')

@section('content')

    <h3 class="text-primary">List of voters for election: {{ $election->title }}</h3>
    <div class="row">
        <table class="table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>City</th>
                <th>Address</th>
            </tr>
            </thead>
            <tbody>
            @forelse($vote_counts as $vote)
                <tr>
                    <td>{{$vote->voter->name}}</td>
                    <td>{{$vote->voter->email}}</td>
                    <td>{{$vote->candidate->name}}</td>
                    <td>{{$vote->candidate->party->name}}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No voters!</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center mt-5">
        {!! $vote_counts->links() !!}
    </div>

@endsection
