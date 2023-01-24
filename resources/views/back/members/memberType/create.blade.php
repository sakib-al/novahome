@extends('back.layouts.master')
@section('title', 'Create Member Type')

@section('master')
<form action="{{route('back.member.type.store')}}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="card border-light mt-3 shadow">
        <div class="card-header">
            <a href="{{route('back.member.type.index')}}" class="btn btn-success btn-sm"><i class="fas fa-angle-double-left"></i> View All</a>
        </div>
        <div class="card-body">
            <member-type-add></member-type-add>
        </div>
    </div>

    <div class="card border-light mt-3 shadow">
        <div class="card-footer">
            <button class="btn btn-success btn-lg">Create</button>
            <br>
            <small><b>NB: *</b> marked are required field.</small>
        </div>
    </div>
</form>
@endsection
@section('footer')
    <script type="text/javascript" src="{{asset('back/js/app.js')}}"></script>
@endsection
