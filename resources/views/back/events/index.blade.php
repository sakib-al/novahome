@extends('back.layouts.master')
@section('title', 'Events')

@section('head')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.23/datatables.min.css"/>
@endsection

@section('master')
<div class="card border-light mt-3 shadow">
    <div class="card-header">
        <h5 class="d-inline-block">Event list</h5>

        <a href="{{route('back.events.create')}}" class="btn btn-success btn-sm float-right"><i class="fas fa-plus"></i> Create New</a>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-bordered table-sm" id="dataTable">
            <thead>
              <tr>
                <th scope="col">SL</th>
                <th scope="col">Image</th>
                <th scope="col">Title</th>
                <th scope="col">Date</th>
                <th scope="col">Feature</th>
                <th scope="col" class="text-center">Response</th>
                <th scope="col" class="text-right">Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($events as $key => $event)
                    <tr>
                        <th scope="row">{{  (count($events) - $key) }}</th>
                        <td><img src="{{$event->img_paths['small']}}" style="width: 30px"></td>
                        <td>{{$event->title}}</td>
                        <td>{{date('h:mi d/m/Y', strtotime($event->date))}}</td>
                        <td>
                            @include('switcher::switch', [
                                'table' => 'events',
                                'data' => $event,
                                'column' => 'featured'
                            ])
                        </td>
                        <td class="text-center"><a href="{{route('back.event.response',$event->id)}}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i> View Response </a></td>
                        <td class="text-right">
                            <a class="btn btn-sm btn-success" href="{{route('back.events.edit', $event->id)}}"><i class="fas fa-edit"></i></a>

                            <form class="d-inline-block" action="{{route('back.events.destroy', $event->id)}}" method="POST">
                                @method('DELETE')
                                @csrf

                                <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Are you sure to remove?')"><i class="fas fa-trash"></i></button>
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
            order: [[0, "desc"]],
        });
    });
</script>
@endsection
