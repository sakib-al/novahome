@extends('back.layouts.master')
@section('title', 'Member Reports')

@section('head')

@endsection

@section('master')
<div class="card border-light mt-3 shadow">
    <div class="card-header">
        <h5 class="d-inline-block">Member Reports</h5>
    </div>
    <div class="card border-light shadow mb-4">
        <form action="{{route('back.report.member')}}" method="GET">
            <div class="card-header">
                <h5 class="d-inline-block">Filter</h5>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label><b>Select Status</b></label>
                            <select name="status" class="form-control form-control-sm">
                                <option value="" {{!request('status') ? 'selected' : ''}}>All</option>
                                <option value="approved" {{request('status') == 'approved' ? 'selected' : ''}}>Approved</option>
                                <option value="pending" {{request('status') == 'pending' ? 'selected' : ''}}>Pending</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-10">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="d-block"><b>Member Types</b></label>
                                    <select name="member_type_id" class="form-control form-control-sm selectpicker">
                                        <option value="">Select One</option>
                                        @foreach ( $member_types as $type)
                                            <option value="{{$type->id}}" {{request('member_type_id') == $type->id ? 'selected' : ''}}>{{$type->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label><b>From Date</b></label>
                                    <input type="date" name="from_date" value="{{request('from_date')}}" class="form-control form-control-sm">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label><b>To Date</b></label>
                                    <input type="date" name="to_date" value="{{request('to_date')}}" class="form-control form-control-sm">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label style="visibility: hidden">.</label>
                                    <br>
                                    <button name="type" value="filter" class="btn btn-success btn-sm"><i class="fas fa-search"></i> Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- <div class="card-footer">
                <button name="type" value="excel" class="btn btn-primary"><i class="fas fa-table"></i> Export Excel</button>
                <button name="type" value="pdf" class="btn btn-success"><i class="fas fa-sticky-note"></i> Export PDF</button>
                <a href="{{route('back.report.orders')}}" class="btn btn-info"><i class="fas fa-undo-alt"></i> Reset</a>
            </div> --}}
        </form>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-bordered table-sm" id="dataTable">
            <thead>
              <tr>
                <th scope="col" style="width: 70px">SL</th>
                <th scope="col">Member Type</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($users as $key => $user)
                    <tr>
                        <th scope="row">{{$key + 1}}</th>
                        <td>{{$user->memberType?$user->memberType->name:''}}</td>
                        <td>
                            <p class="mb-0">{{$user->last_name}}</p>
                        </td>
                        <td><p class="mb-0">{{$user->email}}</p></td>
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
                order: [[ 1, 'asc' ]]
            });
        });
    </script>
@endsection
