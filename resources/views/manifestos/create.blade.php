@extends('layouts.app')

@section('styles')
@endsection

@section('scripts')
    {{--        <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>--}}
    {{--        <script type="text/javascript">--}}
    {{--            CKEDITOR.replace('description');--}}
    {{--        </script>--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.10.1/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'lists',
        });
    </script>
@endsection

@section('content')

    <form action="{{ route('store.manifesto') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="description">Create Manifesto</label>
            <textarea name="description" rows="20"
                      class="form-control  {{ $errors->has('description') ? ' is-invalid' : '' }}"
                      id="description"></textarea>

            @if($errors->has('description'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('description') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-outline-success float-right">Create</button>
        </div>
    </form>

@endsection
