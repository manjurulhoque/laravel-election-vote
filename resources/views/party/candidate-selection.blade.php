@extends('layouts.app')

@section('content')

    <h3>List of candidates to select</h3>
    <div class="row">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Candidate</th>
                <th>Requested time</th>
                <th>Profile</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($candidates as $candidate)
                <tr>
                    <td>{{ $candidate->name }}</td>
                    <td>{{ $candidate->created_at }}</td>
                    <td>
                        <a href="{{ route('candidate.profile', $candidate->id) }}"
                           class="btn btn-sm btn-outline-primary">View</a>
                    </td>
                    <td>
                        <a href="{{ route('accept.candidate', $candidate->id) }}"
                           class="btn btn-sm btn-outline-success" onclick="return confirm('Are your sure?')">Accept</a>
                        <a href="{{ route('reject.candidate', $candidate->id) }}"
                           class="btn btn-sm btn-outline-danger" onclick="return confirm('Are your sure?')">Reject</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @forelse($candidates as $candidate)
            {{--            <div class="col-md-4 col-sm-4">--}}
            {{--                <div class="card">--}}
            {{--                    <h5 class="card-header">{{$candidate->name}}</h5>--}}
            {{--                    <div class="card-body">--}}
            {{--                        @if(!isset($candidate->image))--}}
            {{--                            <img src="{{ asset('img/default.png') }}" alt="" class="bd-placeholder-img card-img-top">--}}
            {{--                        @else--}}
            {{--                            <img src="{{ asset($candidate->image) }}" alt="" class="bd-placeholder-img card-img-top">--}}
            {{--                        @endif--}}

            {{--                        <div class="card-body text-center">--}}
            {{--                            <a href="{{ route('select.candidate', $candidate->id) }}" class="btn btn-primary">--}}
            {{--                                Select candidate--}}
            {{--                            </a>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            </div>--}}
        @empty
            <p>No candidates found to select!</p>
        @endforelse
    </div>

@endsection
