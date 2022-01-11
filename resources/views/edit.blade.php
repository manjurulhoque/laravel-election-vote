@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">
            <h6 class="text-left">Update profile of <b>{{$user->name}}</b></h6>
        </div>
        <div class="card-body">
            <form action="{{ route('store.profile.image') }}" enctype="multipart/form-data" method="post">
                @method('PUT')
                @csrf

                <div class="form-group">
                    Previous image:
                    @if(!isset($user->image))
                        <img src="{{ asset('img/default.png') }}" alt="" class="img-thumbnail" width="200">
                    @else
                        <img src="{{ asset($user->image) }}" alt="" class="img-thumbnail" width="200">
                    @endif
                </div>

                <div class="form-group">
                    <label for="image">Image:</label>
                    <input type="file" accept="image/*" required placeholder="Upload your image" name="image" id="image">

                    @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>

@endsection
