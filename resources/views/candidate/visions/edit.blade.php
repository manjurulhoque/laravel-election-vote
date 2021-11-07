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

    <form action="{{ route('visions.store') }}">
        @csrf
        <div class="form-group">
            <label for="description">My visions</label>
            <textarea name="description" rows="20" class="form-control" id="description"></textarea>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-outline-success float-right">Update</button>
        </div>
    </form>

@endsection
