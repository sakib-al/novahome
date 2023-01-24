@extends('back.layouts.master')
@section('title', 'Donation Reports')

@section('head')

@endsection

@section('master')
<div class="card border-light mt-3 shadow">
    <div class="card-header">
        <h5 class="d-inline-block">Donation Reports</h5>
    </div>
    <div class="card border-light shadow mb-4">
        <form action="{{route('back.report.donation')}}" method="GET">
            <div class="card-header">
                <h5 class="d-inline-block">Filter</h5>
            </div>

            <div class="card-body">
                <div class="row">

                    <div class="col-md-10">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label><b>Contribution</b></label>
                                    <select name="fund_raiser_id" class="form-control form-control-sm">
                                        <option value="" {{!request('fund_raiser_id') ? 'selected' : ''}}>All</option>
                                        @foreach ($contributions as $cont)
                                            <option value="{{$cont->id}}" {{request('fund_raiser_id') == $cont->id ? 'selected' : ''}}>{{$cont->title}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label><b>Payment Type</b></label>
                                    <select name="payment_type" class="form-control form-control-sm">
                                        <option value="" {{!request('payment_type') ? 'selected' : ''}}>All</option>
                                        <option value="1" {{request('payment_type') == 1 ? 'selected' : ''}}>One Time</option>
                                        <option value="2" {{request('payment_type') == 2 ? 'selected' : ''}}>Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="d-block"><b>Frequency Of Payment</b></label>
                                    <select name="f_of_payment" class="form-control form-control-sm selectpicker">
                                        <option value="">Select One</option>
                                        @foreach ( $f_of_payments as $type)
                                            <option value="{{$type}}" {{request('f_of_payment') == $type ? 'selected' : ''}}>{{$type}}</option>
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
                <th scope="col">SL</th>
                <th scope="col">Date</th>
                <th scope="col">User</th>
                <th scope="col">Contribution</th>
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
                        <td scope="row">{{$key + 1}}</td>
                        <td>{{date('d/m/Y', strtotime($donation->created_at))}}</td>
                        <td>{{$donation->user?$donation->user->full_name:''}}</td>
                        <td>
                            {{$donation->fundRaiser?$donation->fundRaiser->title:''}}
                        </td>
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
                                        {{$info->$ff }}
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
                <td colspan="{{ 6 + $count }}" class="text-right"><strong>Total</strong></td>
                <td colspan="2"><b>{{ $donations->sum('amount') }}</b></td>
            </tfoot>
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
