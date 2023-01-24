@extends('back.layouts.master')
@section('title', 'All Members')

@section('head')
<!--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.23/datatables.min.css"/>-->
@endsection

@section('master')
<div class="card border-light mt-3 shadow">
    <div class="card-header">
        <h5 class="d-inline-block">Team List</h5>

        <a href="{{route('back.teams.create')}}" class="btn btn-success btn-sm float-right"><i class="fas fa-plus"></i> Create new</a>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-bordered table-sm" id="dataTable">
            <thead>
              <tr>
                <th></th>
                <th scope="col" style="width: 70px">SL</th>
                <th scope="col">Name</th>
                <th scope="col">Designation</th>
                <th scope="col">Member Type</th>
                <th scope="col">position</th>
                <th scope="col">Status</th>
                <th scope="col" class="text-right">Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($teams as $key => $user)
                    <tr>
                        <td></td>
                        <th scope="row">{{$key + 1}}</th>
                        <td>
                            <p class="mb-0">{{$user->name}}</p>
                        </td>
                        <td><p class="mb-0">{{$user->designation}}</p></td>
                        <td>{{ $user->member_type==1 ?'Board':'Executive' }}</td>
                        <td>{{ $user->position }}</td>
                        <td>
                            @include('switcher::switch', [
                                'table' => 'our_teams',
                                'data' => $user,
                                'column'=>'status',
                            ])
                        </td>
                        <td class="text-right" style="width: 85px">
                            <a class="btn btn-success btn-sm" href="{{route('back.teams.edit', $user->id)}}"><i class="fas fa-edit"></i></a>

                            <form class="d-inline-block" action="{{route('back.teams.destroy', $user->id)}}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('Are you sure to remove?')"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('footer')
<!--<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.23/datatables.min.js"></script>

<script>
    $(document).ready( function () {
        $('#dataTable').DataTable({
            order: [[0, "asc"]],
        });
    });
</script>-->
<script>
    $(document).ready(function(){
        $('#dataTable').DataTable({
            responsive: true,
            dom: 'Bfrtip',
            buttons: [
                'colvis',
                {
                    extend: 'excelHtml5',
                    text: 'Excel',
                    exportOptions: {
                        rows: function ( idx, data, node ) {
                            var dt = new $.fn.dataTable.Api('#example' );
                            var selected = dt.rows( { selected: true } ).indexes().toArray();

                            if( selected.length === 0 || $.inArray(idx, selected) !== -1)
                                return true;

                            return false;
                        },
                        columns: ':visible'
                    }
                },
                {
                    extend: 'pdfHtml5',
                    orientation: 'landscape',
                    text: 'PDF',
                    exportOptions: {
                        rows: function ( idx, data, node ) {
                            var dt = new $.fn.dataTable.Api('#example' );
                            var selected = dt.rows( { selected: true } ).indexes().toArray();

                            if( selected.length === 0 || $.inArray(idx, selected) !== -1)
                                return true;

                            return false;
                        },
                        columns: ':visible'
                    }
                },
                {
                    extend: 'print',
                    autoPrint: false,
                    text: 'Print',
                    exportOptions: {
                        rows: function ( idx, data, node ) {
                            var dt = new $.fn.dataTable.Api('#example' );
                            var selected = dt.rows( { selected: true } ).indexes().toArray();

                            if( selected.length === 0 || $.inArray(idx, selected) !== -1)
                                return true;

                            return false;
                        },
                        columns: ':visible'
                    }
                }
            ],
            columnDefs: [ {
                orderable: false,
                className: 'select-checkbox',
                targets:   0
            } ],
            select: {
                style:    'multi',
                selector: 'td:first-child'
            },
            order: [[ 1, 'desc' ]]
        });
    });
</script>
@endsection
