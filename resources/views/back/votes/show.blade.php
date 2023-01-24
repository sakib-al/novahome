@extends('back.layouts.master')
@section('title', 'Vote Result')
@section('head')

@endsection
@section('master')
<div class="card">
    <div class="card-header">
        <a href="{{route('back.votes.index')}}" class="btn btn-success btn-sm"><i class="fas fa-angle-double-left"></i> View All</a>
        <a href="{{route('back.votes.create')}}" class="btn btn-info btn-sm"><i class="fas fa-plus"></i> Create</a>
        <a href="{{route('back.votes.edit', $vote->id)}}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>

        <form class="d-inline-block" action="{{route('back.votes.destroy', $vote->id)}}" method="POST">
            @method('DELETE')
            @csrf
            <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Are you sure to remove?')"><i class="fas fa-trash"></i> Delete</button>
        </form>
    </div>
</div>

<div class="card border-light mt-3 shadow">
    <div class="card-body">
        <div id="piechart"></div>
        <div class="card-header">
            <div class="card-body table-responsive">
                <table class="table table-bordered table-sm" id="dataTable">
                    <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">SL.</th>
                        <th scope="col" class="text-center">User</th>
                        <th scope="col" class="text-center">Answer</th>
                        <th scope="col" class="text-center">IP</th>
                        <th scope="col" class="text-center">Location</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($vote->voteAnswer as $key => $vote)
                        <tr>
                            <td ></td>
                            <td>{{$key + 1}}</td>
                            <td class="text-center">
                                @php
                                    $user = $vote->user;
                                @endphp
                                {{$user?$user->first_name.''.$user->last_name:''}}
                            </td>
                            <td class="text-center">{{$vote->answer}}</td>
                            <td class="text-center">{{$vote->ip}}</td>
                            <td class="text-center">{{$vote->location}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
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
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script type="text/javascript">
    // Load google charts
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    // Draw the chart and set the chart values
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
      ['Task', 'Hours per Day'],
      ['Yes', {{ $yes }}],
      ['No', {{ $no }}],
      ['No Comments', {{ $no_comments }}],
    ]);

      // Optional; add a title and set the width and height of the chart
      var options = {'title':'Vote Results', 'width':550, 'height':250};

      // Display the chart inside the <div> element with id="piechart"
      var chart = new google.visualization.PieChart(document.getElementById('piechart'));
      chart.draw(data, options);
    }
    </script>
@endsection

