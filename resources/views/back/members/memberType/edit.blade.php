@extends('back.layouts.master')
@section('title', 'Edit Member Type')

@section('master')
<div class="card">
    <div class="card-header">
        <a href="{{route('back.member.type.index')}}" class="btn btn-success btn-sm"><i class="fas fa-angle-double-left"></i> View All</a>
        <a href="{{route('back.member.type.create')}}" class="btn btn-info btn-sm"><i class="fas fa-plus"></i> Create</a>

        <form class="d-inline-block" action="{{route('back.member.type.delete', $memberType->id)}}" method="POST">
            @method('DELETE')
            @csrf

            <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Are you sure to remove?')"><i class="fas fa-trash"></i> Delete</button>
        </form>
    </div>
</div>

<form action="{{route('back.member.type.update', $memberType->id)}}" method="POST">
    @csrf
    @method('POST')

    <div class="card border-light mt-3 shadow">
        <div class="card-body">
            <member-type-update :member_type="{{$memberType}}"></member-type-update>
        </div>
    </div>

    <div class="card border-light mt-3 shadow">
        <div class="card-footer">
            <button class="btn btn-success btn-lg">Update</button>
            <br>
            <small><b>NB: *</b> marked are required field.</small>
        </div>
    </div>

</form>
@endsection
@section('footer')
    <script type="text/javascript" src="{{asset('back/js/app.js')}}"></script>
@endsection
