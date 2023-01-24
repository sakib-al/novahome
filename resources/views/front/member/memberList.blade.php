@extends('front.layouts.master')
@php
    $page_title="Our Members"
@endphp
@section('head')
    @include('meta::manager', [
        'title' => $page_title.' - ' . ($settings_g['title'] ?? ''),
    ])
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.23/datatables.min.css"/>

<style>
    .board-img {
        height: 200px;
    }

</style>
    <style>
        .button {
            border-radius: 4px;
            background-color: #21734e;
            border: none;
            color: #FFFFFF;
            text-align: center;
            font-size: 28px;
            padding: 20px;
            width: 185px;
            transition: all 0.5s;
            cursor: pointer;
            margin: 5px;
        }

        .button span {
            cursor: pointer;
            display: inline-block;
            position: relative;
            transition: 0.5s;
        }

        .button span:after {
            content: '\00bb';
            position: absolute;
            opacity: 0;
            top: 0;
            right: -20px;
            transition: 0.5s;
        }

        .button:hover span {
            padding-right: 25px;
        }
        .button:hover{
            background-color: #0b3d24;
        }

        .button:hover span:after {
            opacity: 1;
            right: 0;
        }
    </style>
@endsection

@section('master')
<!-- Start Page Header Section -->
<section class="bg-page-header-common">
    <div class="page-header-overlay py-4">
        <div class="container">
            <div >
                <div class="page-header">
                    <div class="page-title text-center">
                        <h2 class="text-center">{{$page_title}}</h2>
                    </div>
                    <!-- .page-title -->
                    <div class="page-header-content text-center">
                        <ol class="breadcrumb">
                            <li><a href="{{route('homepage')}}">Home</a></li>
                            <li>{{$page_title}}</li>
                        </ol>
                    </div>
                    <!-- .page-header-content -->
                </div>
                <!-- .page-header -->
            </div>
            <!-- .row -->
        </div>
        <!-- .container -->
    </div>
    <!-- .page-header-overlay -->
</section>
<!-- End Page Header Section -->
<div class="page_wrap all_member">
    <div class="container-md">
        <div class="py-5">
            <div class="container">
                @foreach ($types as $key => $type)
                    <div class="row justify-content-center mb-4">
                        <div class="col-md-7 text-center">
                            <h5 class="boardsec_title text-uppercase">{{$type->name}}</h5>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        @foreach($type->users as $key_2 => $member)
                            <div class="c_col mb-1">
                                <!-- Row -->
                                <div class="row">
                                    @if($member->profile_path)
                                    <div class="board-img col-md-12" >
                                        <img src="{{$member->profile_path}}" alt="wrapkit" class="img-responsive center-block d-block mx-auto rounded-sm" />
                                    </div>
                                    @endif
                                    <div class="col-md-12 text-center">
                                        <div class="pt-2">
                                            <h6 class="team-title">{{ $member->first_name.' '.$member->last_name }}</h6>
                                            <p class="designation">{{ $member->memberType?$member->memberType->name:'' }}</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Row -->
                            </div>

                            @if($key == 0 && $key_2 == 3)
                                <div class="c_col mb-1 pr-2 border">
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <div class="pt-2">
                                                <div class="wrapper mt-6">
                                                    <button class="button text-center"><span>Sign Up </span></button>
                                                </div>
                                             </div>
                                        </div>
                                    </div>

                                </div>
                            @endif
                        @endforeach
                    </div>
                    <br>
                    <br>
                @endforeach
            </div>
        </div>
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
