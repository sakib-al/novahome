@extends('back.layouts.master')
@section('title', 'Donation Programs')

@section('head')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.23/datatables.min.css"/>
@endsection

@section('master')
<div class="card border-light mt-3 shadow">
    <div class="card-header">
        <h5 class="d-inline-block">Donation Program list</h5>

        <a href="{{route('back.fund-raisers.create')}}" class="btn btn-success btn-sm float-right"><i class="fas fa-plus"></i> Create new</a>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-bordered table-sm" id="dataTable">
            <thead>
              <tr>
                <th scope="col">SL</th>
                <th scope="col">Title</th>
                <th scope="col">Targeted Fund</th>
                <th scope="col">Collected Fund</th>
                <th scope="col">No. of Donner</th>
                <th scope="col">Donner</th>
                  <th scope="col">Status</th>
                <th scope="col" class="text-right">Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($fundRaisers as $key => $fundRaiser)
                    <tr>
                        <th scope="row">{{$key + 1}}</th>
                        <td>{{$fundRaiser->title}}</td>
                        <td>{{$fundRaiser->targeted_fund}}</td>
                        <td>{{$fundRaiser->donations()->where(['payment_status'=>'succeeded'])->sum('amount') }}</td>
                        <td>{{$fundRaiser->donations()->where(['payment_status'=>'succeeded'])->count()}}</td>
                        <td class="text-center">
                            <a href="{{route('back.donation.list_l',$fundRaiser->id)}}" class="btn btn-info btn-sm">
                                <i class="fas fa-eye"></i> View </a>
                        </td>
                        <td>
                            @include('switcher::switch', [
                                'table' => 'fund_raisers',
                                'data' => $fundRaiser
                            ])
                            {{--{{$fundRaiser->status == 1 ? 'Done' : 'Active'}}--}}
                        </td>
                        <td class="text-right">
                            <a class="btn btn-success btn-sm" href="{{route('back.fund-raisers.edit', $fundRaiser->id)}}"><i class="fas fa-edit"></i></a>

                            <form class="d-inline-block" action="{{route('back.fund-raisers.destroy', $fundRaiser->id)}}" method="POST">
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
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.23/datatables.min.js"></script>

<script>
    $(document).ready( function () {
        $('#dataTable').DataTable({
            order: [[0, "asc"]],
        });
    });
</script>
@endsection
