@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-4 col-sm-4">
            <div class="card" style="width: 18rem;">
                <img src="{{ asset('img/voter.png') }}" alt="" class="card-img-top">

                <div class="card-body text-center">
                    <a href="{{ route('voter.register.portal') }}" class="btn btn-primary">Voter Registration</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-4">
            <div class="card" style="width: 18rem;">
                <img src="{{ asset('img/candidate.png') }}" alt="" class="card-img-top">

                <div class="card-body text-center">
                    <a href="{{ route('candidate.register.portal') }}" class="btn btn-primary">
                        Candidate Registration
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-4">
            <div class="card" style="width: 18rem;">
                <img src="{{ asset('img/party.png') }}" alt="" class="card-img-top">

                <div class="card-body text-center">
                    <a href="{{ route('party.register.portal') }}" class="btn btn-primary">Party Registration</a>
                </div>
            </div>
        </div>
    </div>

@endsection
