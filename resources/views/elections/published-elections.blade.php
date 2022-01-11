@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="container">
            @foreach($elections as $election)
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-primary">List of voters for election: {{ $election->title }}</h3>
                        <h2 class="text-success">Winner is: {{ $election->winner->name }}</h2>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered mb-5" style="width: 100%">
                            <thead>
                            <tr>
                                <th>Party</th>
                                <th>Total votes</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($election->winners() as $winner)
                                <tr>
                                    <td>{{$winner->party->name}}</td>
                                    <td>{{$winner->total}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
