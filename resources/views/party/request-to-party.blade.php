@extends('layouts.app')

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.10.1/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'lists',
        });
    </script>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    Nomination form
                </div>
                <div class="card-body">
                    @if($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">
                                {{ $error }}
                            </div>
                        @endforeach
                    @endif
                    <form action="{{ route('request.to.party.submit') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label>Candidate image:</label>
                            @if(!isset($candidate->image))
                                <img src="{{ asset('img/default.png') }}" alt="" width="100">
                            @else
                                <img src="{{ asset($candidate->image) }}" alt="">
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="candidate_name">Candidate name</label>
                            <input type="text" id="candidate_name" class="form-control" name="candidate_name" required>
                        </div>

                        <div class="form-group">
                            <label for="mother_name">Mother name</label>
                            <input type="text" id="mother_name" class="form-control" name="mother_name" required>
                        </div>

                        <div class="form-group">
                            <label for="father_name">Father name</label>
                            <input type="text" id="father_name" class="form-control" name="father_name" required>
                        </div>

                        <div class="form-group">
                            <label for="mobile">Mobile number</label>
                            <input type="text" id="mobile" class="form-control" name="mobile" required>

                            @if($errors->has('mobile'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('mobile') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control {{ $errors->has('description') ? ' is-invalid' : '' }}"
                                      name="description"
                                      id="description" rows="10"></textarea>

                            @if($errors->has('description'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif
                        </div>

                        <h4>Address</h4>
                        <div class="form-group">
                            <label for="village">Village</label>
                            <input type="text" id="village" class="form-control" name="village" required>
                        </div>

                        <div class="form-group">
                            <label for="post_office">Post office</label>
                            <input type="text" id="post_office" class="form-control" name="post_office" required>
                        </div>

                        <div class="form-group">
                            <label for="upazilla">Upazilla</label>
                            <input type="text" id="upazilla" class="form-control" name="upazilla" required>
                        </div>

                        <div class="form-group">
                            <label for="district">District</label>
                            <input type="text" id="district" class="form-control" name="district" required>
                        </div>

                        {{--                        <div class="form-group">--}}
                        {{--                            <label for="party">Choose party</label>--}}
                        {{--                            <select name="party_id" id="party" class="form-control" required>--}}
                        {{--                                <option value="" selected>Select party</option>--}}
                        {{--                                @foreach($parties as $party)--}}
                        {{--                                    <option value="{{ $party->id }}">{{ $party->name }}</option>--}}
                        {{--                                @endforeach--}}
                        {{--                            </select>--}}
                        {{--                        </div>--}}

                        <div class="form-group">
                            <button type="submit" class="btn btn-success"
                                    onclick="return confirm('Are you sure? After submission, you wont be able to cancel it.')">
                                Submit request
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
