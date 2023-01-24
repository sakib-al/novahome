@extends('back.layouts.master')
@section('title', 'Donation Funds')

@section('head')
<!--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.23/datatables.min.css"/>-->
@endsection

@section('master')
<div class="card border-light mt-3 shadow">
    <div class="card-header">
        <h5 class="d-inline-block">Donation list</h5>
        <a href="{{route('back.donation.form')}}" class="btn btn-success btn-sm float-right"><i class="fas fa-plus"></i> Donation Form</a>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-bordered table-sm" id="dataTable">
            <thead>
              <tr>
                <th></th>
                <th scope="col">SL</th>
                <th scope="col">User</th>
                  @php
                      $fields=[];
                      try{
                        $fields= json_decode($donation_form->fields);
                      }catch (Exception $e){
                        $fields=[];
                      }
                  @endphp
                  @if(isset($fields))
                      @foreach($fields as $fl)
                          <th scope="col">{{$fl->label}}</th>
                      @endforeach
                  @endif
                <th scope="col">Payment Type</th>
                <th scope="col">Frequency Of Payment</th>
                <th scope="col">Amount</th>
                <th scope="col">Status</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($donations as $key => $donation)
                    <tr>
                        <td></td>
                        <th scope="row">{{$key + 1}}</th>
                        <td>{{$donation->user?$donation->user->full_name:''}}</td>
                        @php
                            $info = null;
                            try{
                                $info= json_decode($donation->info);
                              }catch (Exception $e){
                                $info=null;
                              }
                        @endphp
                        @if(isset($fields))
                            @foreach($fields as $fl)
                                <td>
                                    @if(isset($info))
                                        @php
                                            $ff=$fl->input_name;
                                        @endphp
                                        {{ isset($info->$ff)?$info->$ff:'' }}
                                    @endif
                                </td>
                            @endforeach
                        @endif
                        <td>{{$donation->payment_type==1 ? 'One Time':'Other' }}</td>
                        <td>{{$donation->f_payment}}</td>
                        <td>{{$donation->amount}}</td>
                        <td class="{{$donation->payment_status=='succeeded'?'text-success':'text-danger'}}">
                            {{$donation->payment_status=='succeeded'?'Completed':'Pending'}}
                        </td>
                    </tr>

                @endforeach
            </tbody>
            <tfoot>
                @php
                    $count=0;
                    if (isset($fields)) {
                        $count = count($fields);
                    }
                @endphp
                <td colspan="{{ 5 + $count }}" class="text-right"><strong>Total</strong></td>
                <td colspan="2"><b>{{ $donations->sum('amount') }}</b></td>
            </tfoot>
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
