@extends('layouts.app')

@section('styles')
    <link href="https://unpkg.com/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker3.min.css" rel="stylesheet">
@endsection

@section('scripts')
    <script src="https://unpkg.com/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.10.1/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'lists',
        });

        let date = new Date();
        date.setDate(date.getDate());

        $('#start_date').datepicker({
            format: 'yyyy-mm-dd',
            startDate: date,
            autoclose: true
        }).on('changeDate', function (selected) {
            let minDate = new Date(selected.date.valueOf());
            $('#end_date').datepicker('setStartDate', minDate);
        }).on('changeDate', function (selected) {
            let start_date = new Date(selected.date.valueOf());
            let end_date = new Date($('#end_date').val());
            if (start_date > end_date) {
                start_date.setDate(start_date.getDate() + 1);
                $('#end_date').datepicker('setDate', start_date);
            }
        });

        $('#end_date').datepicker({
            format: 'yyyy-mm-dd',
            startDate: date,
            autoclose: true
        });
    </script>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>Create new election</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('elections.store') }}" method="post">
                        @csrf

                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text"
                                   class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}"
                                   id="title" name="title" placeholder="Enter title" required>

                            @if($errors->has('title'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('title') }}</strong>
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

                        <div class="form-group">
                            <label for="type">Type</label>
                            <select name="type" id="type" class="form-control" required>
                                <option value="" selected>Select election type</option>
                                <option value="National">National</option>
                                <option value="City">City</option>
                            </select>

                            @if($errors->has('type'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('type') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="start_date">Start date</label>
                            <input type="text"
                                   class="form-control {{ $errors->has('start_date') ? ' is-invalid' : '' }}"
                                   id="start_date" name="start_date" placeholder="Enter start date" required
                                   autocomplete="false">

                            @if($errors->has('start_date'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('start_date') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="end_date">End date</label>
                            <input type="text"
                                   class="form-control {{ $errors->has('end_date') ? ' is-invalid' : '' }}"
                                   id="end_date" name="end_date" placeholder="Enter end date" required
                                   autocomplete="false">

                            @if($errors->has('end_date'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('end_date') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-check">
                            <input type="checkbox"
                                   class="form-check-input {{ $errors->has('is_active') ? ' is-invalid' : '' }}"
                                   id="is_active" name="is_active">
                            @if($errors->has('is_active'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('is_active') }}</strong>
                                </span>
                            @endif
                            <label class="form-check-label" for="is_active">Is Active</label>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-outline-success float-right">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
