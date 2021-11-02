@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-4 col-sm-4">
            <div class="card" style="width: 18rem;">
                <svg class="bd-placeholder-img card-img-top" width="100%" height="180"
                     xmlns="http://www.w3.org/2000/svg" aria-label="Placeholder: Image cap"
                     preserveAspectRatio="xMidYMid slice" role="img"><title>Placeholder</title>
                    <rect width="100%" height="100%" fill="#868e96"/>
                    <text x="50%" y="50%" fill="#dee2e6" dy=".3em">Image cap</text>
                </svg>

                <div class="card-body text-center">
                    <a href="{{ route('voter.register.portal') }}" class="btn btn-primary">Voter Registration</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-4">
            <div class="card" style="width: 18rem;">
                <svg class="bd-placeholder-img card-img-top" width="100%" height="180"
                     xmlns="http://www.w3.org/2000/svg" aria-label="Placeholder: Image cap"
                     preserveAspectRatio="xMidYMid slice" role="img"><title>Placeholder</title>
                    <rect width="100%" height="100%" fill="#868e96"/>
                    <text x="50%" y="50%" fill="#dee2e6" dy=".3em">Image cap</text>
                </svg>

                <div class="card-body text-center">
                    <a href="{{ route('candidate.register.portal') }}" class="btn btn-primary">
                        Candidate Registration
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-4">
            <div class="card" style="width: 18rem;">
                <svg class="bd-placeholder-img card-img-top" width="100%" height="180"
                     xmlns="http://www.w3.org/2000/svg" aria-label="Placeholder: Image cap"
                     preserveAspectRatio="xMidYMid slice" role="img"><title>Placeholder</title>
                    <rect width="100%" height="100%" fill="#868e96"/>
                    <text x="50%" y="50%" fill="#dee2e6" dy=".3em">Image cap</text>
                </svg>

                <div class="card-body text-center">
                    <a href="{{ route('party.register.portal') }}" class="btn btn-primary">Party Registration</a>
                </div>
            </div>
        </div>
    </div>

@endsection
