@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="col-md-6 mx-auto">
                <h3 class="mb-5">Status of request to party</h3>
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Party</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($party_candidates as $party_candidate)
                        <tr>
                            <td>{{ $party_candidate->party->name }}</td>
                            <td>{{ $party_candidate->status }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
