@extends('back.layouts.master')
@section('title', 'Member Type')

@section('head')

@endsection

@section('master')
<div class="card border-light mt-3 shadow">
    <div class="card-header">
        <h5 class="d-inline-block">Member Types</h5>

        <a href="{{route('back.member.type.create')}}" class="btn btn-success btn-sm float-right"><i class="fas fa-plus"></i> Create new</a>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-bordered table-sm" id="dataTable">
            <thead>
              <tr>
                <th></th>
                <th scope="col" style="width: 70px">SL</th>
                <th scope="col">Type</th>
                <th scope="col">Amount</th>
                <th scope="col">Limit</th>
                <th scope="col" class="text-right">Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($member_types as $key => $type)
                    <tr>
                        <td scope="row"></td>
                        <th scope="row">{{$key + 1}}</th>
                        <td>
                            {{ $type->name }}
                        </td>
                        <td>
                            {{ $type->amount }}
                        </td>
                        <td>
                            {{ $type->limit }}
                        </td>
                        <td class="text-right" style="width: 85px">
                            <a class="btn btn-success btn-sm" href="{{route('back.member.type.edit',$type->id)}}"><i class="fas fa-edit"></i></a>

                            <form class="d-inline-block" action="{{route('back.member.type.delete',$type->id)}}" method="POST">
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
