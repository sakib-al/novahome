@extends('back.layouts.master')
@section('title', 'Create Member')

@section('master')
<form action="#" method="POST">
    @csrf
    <div class="card border-light mt-3 shadow">
        <div class="card-header">
            <a href="{{route('back.members.index')}}" class="btn btn-success btn-sm"><i class="fas fa-angle-double-left"></i> View All</a>
        </div>
        <div class="card-header">
            <h5 class="d-inline-block">Basic Information</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 col-lg-3">
                    <div class="img_groupp uploaded_member_img_group">
                        <div class="text-center">
                            <img class="uploaded_img uploaded_member_img" height="250px" src="{{ $user->profile_path }}">
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-lg-9">
                    <div class="row">
                        <div class="col-sm-12">Name : {{ $user->full_name }}</div>
                        <div class="col-sm-12">Email : {{ $user->email }}</div>
                        <div class="col-sm-12">Member Type: {{ $user->memberType?$user->memberType->name:'' }}</div>
                        @php
                            $info=null;
                            try{
                                $info=json_decode($user->info,true);
                            }catch (Exception $e){
                                $info=null;
                            }
                        @endphp
                        @foreach($info as $key=>$inf)
                            <div class="col-sm-12">{{$key}} : {{ $inf }}</div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
