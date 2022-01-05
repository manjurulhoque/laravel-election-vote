@extends('layouts.app')

@section('content')

    <h3>List of candidates to select</h3>
    <div class="row">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Candidate</th>
                <th>Requested time</th>
                <th>Father name</th>
                <th>Mother name</th>
                <th>Mobile</th>
                <th>Description</th>
                <th>Village</th>
                <th>Post office</th>
                <th>Upazilla</th>
                <th>District</th>
                <th>Profile</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($candidates as $candidate)
                <tr>
                    <td>{{ $candidate->candidate_name }}</td>
                    <td>{{ $candidate->created_at }}</td>
                    <td>{{ $candidate->father_name }}</td>
                    <td>{{ $candidate->mother_name }}</td>
                    <td>{{ $candidate->mobile }}</td>
                    <td>{!! $candidate->description !!}</td>
                    <td>{{ $candidate->village }}</td>
                    <td>{{ $candidate->post_office }}</td>
                    <td>{{ $candidate->upazilla }}</td>
                    <td>{{ $candidate->district }}</td>
                    <td>{{ $candidate->status }}</td>
                    <td>
                        <a href="{{ route('candidates.view', $candidate->candidate->id) }}"
                           class="btn btn-sm btn-outline-primary">View</a>
                    </td>
                    <td>
                        <a href="{{ route('accept.candidate', $candidate->candidate->id) }}"
                           class="btn btn-sm btn-outline-success" onclick="return confirm('Are your sure?')">Accept</a>
                        <a href="{{ route('reject.candidate', $candidate->candidate->id) }}"
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
