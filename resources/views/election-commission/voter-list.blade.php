@extends('layouts.app')

@section('content')

    <h3 class="text-primary">List of voters</h3>
    <div class="row">
        <table class="table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Image</th>
                <th>City</th>
                <th>Address</th>
                <th>Age</th>
                <th>Date of birth</th>
                <th>Gender</th>
                <th>NID</th>
                <th>Mobile</th>
            </tr>
            </thead>
            <tbody>
            @forelse($voters as $voter)
                <tr>
                    <td>{{$voter->name}}</td>
                    <td>{{$voter->email}}
                    <td>
                        @if(!isset($voter->image))
                            <img src="{{ asset('img/default.png') }}" alt="" class="bd-placeholder-img card-img-top" style="width: 50px">
                        @else
                            <img src="{{ asset($voter->image) }}" alt="" class="bd-placeholder-img card-img-top" style="width: 50px">
                        @endif
                    </td>
                    <td>{{$voter->city}}
                    <td>{{$voter->mobie}}
                    <td>{{$voter->age}}
                    <td>{{$voter->dob}}
                    <td>{{$voter->gender}}
                    <td>{{$voter->nid}}
                    <td>{{$voter->mobile}}
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
        {!! $voters->links() !!}
    </div>

@endsection
