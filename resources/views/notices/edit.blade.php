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

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Edit notice</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('notices.update', $notice->id) }}" method="post">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="title">Notice title</label>
                                <input type="text"
                                       class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}"
                                       id="title" name="title" placeholder="Enter title" required value="{{ $notice->title }}">

                                @if($errors->has('title'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="description">Notice description</label>
                                <textarea class="form-control {{ $errors->has('description') ? ' is-invalid' : '' }}"
                                          name="description"
                                          id="description" rows="10">{{ $notice->description }}</textarea>

                                @if($errors->has('description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary float-right">Update notice</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
