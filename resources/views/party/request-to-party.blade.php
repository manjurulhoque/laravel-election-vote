@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Submit to party
                </div>
                <div class="card-body">
                    <form action="{{ route('request.to.party.submit') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="party">Choose party</label>
                            <select name="party_id" id="party" class="form-control" required>
                                <option value="" selected>Select party</option>
                                @foreach($parties as $party)
                                    <option value="{{ $party->id }}">{{ $party->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-success" onclick="return confirm('Are you sure? After submission, you wont be able to cancel it.')">Submit request</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
