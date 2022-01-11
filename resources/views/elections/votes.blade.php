@extends('layouts.app')

@section('scripts')
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function () {
            // let table = $('#datatable').DataTable();
            let groupColumn = 3;
            let table = $('#datatable').DataTable({
                "columnDefs": [
                    {"visible": false, "targets": groupColumn}
                ],
                "order": [[groupColumn, 'asc']],
                "displayLength": 10,
                "drawCallback": function (settings) {
                    let api = this.api();
                    let rows = api.rows({page: 'current'}).nodes();
                    let last = null;

                    api.column(groupColumn, {page: 'current'}).data().each(function (group, i) {
                        if (last !== group) {
                            $(rows).eq(i).before(
                                '<tr class="group"><td colspan="4">' + group + '</td></tr>'
                            );

                            last = group;
                        }
                    });
                },
                rowGroup: {
                    dataSrc: 3,
                    startRender: function (rows, group) {
                        console.log(rows)
                        return group + ' (' + rows.count() + ' rows)';
                    }
                }
            });

            // Order by the grouping
            $('#datatable tbody').on('click', 'tr.group', function () {
                let currentOrder = table.order()[0];
                if (currentOrder[0] === groupColumn && currentOrder[1] === 'asc') {
                    table.order([groupColumn, 'desc']).draw();
                } else {
                    table.order([groupColumn, 'asc']).draw();
                }
            });
        });
    </script>
@endsection

@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css"/>
@endsection

@section('content')

    <h3 class="text-primary">List of voters for election: {{ $election->title }}</h3>
    @if(!$election->is_published)
        <a href="{{ route('publish.result', $election->id) }}" class="btn btn-primary" onclick="return confirm('Are you sure?')">Publish result</a>
    @else
        <button class="btn btn-success">Result published</button>
        <h2 class="text-success">Winner is: {{ $election->winner->name }}</h2>
    @endif
    <div class="row mt-2">
        <div class="col-md-12">
            <table class="table table-striped table-bordered mb-5" style="width: 100%">
                <thead>
                <tr>
                    <th>Party</th>
                    <th>Total votes</th>
                </tr>
                </thead>
                <tbody>
                @foreach($winners as $winner)
                    <tr>
                        <td>{{$winner->party->name}}</td>
                        <td>{{$winner->total}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <h3>Votes</h3>
            <table class="table table-striped table-bordered" id="datatable" style="width: 100%">
                <thead>
                <tr>
                    <th>Voter name</th>
                    <th>Voter e-mail</th>
                    <th>Candidate name</th>
                    <th>Party</th>
                </tr>
                </thead>
                <tbody>
                @forelse($vote_counts as $vote)
                    <tr>
                        <td>{{$vote->voter->name}}</td>
                        <td>{{$vote->voter->email}}</td>
                        <td>{{$vote->candidate->name}}</td>
                        <td>{{$vote->candidate->get_party($vote->candidate->party->name)}}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">No voters!</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{--    <div class="d-flex justify-content-center mt-5">--}}
    {{--        {!! $vote_counts->links() !!}--}}
    {{--    </div>--}}

@endsection
