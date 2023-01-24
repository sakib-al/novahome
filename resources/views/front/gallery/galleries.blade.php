@extends('front.layouts.master')
@php
    $page_title='Gallery';
@endphp
@section('head')
    @include('meta::manager', [
        'title' => 'Gallery - ' . ($settings_g['slogan'] ?? '')
    ])
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
                            <li><a href="/">Home</a></li>
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
    <div class="donation" style="margin-top: 30px;">
        <div class="container">
            <div class="row mb-2">
                @foreach ($galleries as $gallery)
                    <div class="col-sm-3">
                        <!-- Rotating card -->
                        <div class="card-wrapper">
                            <div id="card-2" class="card card-rotating text-center">
                                <!--Front Side-->
                                <div class="face front">
                                    <!-- Image-->
                                    <div class="view overlay card-img-wrap gallery">
                                        <img class="card-img-top img-fluid" src="{{$gallery->img_paths['medium']}}" alt="{{$gallery->name}}">
                                        <a>
                                            <div class="mask rgba-white-slight"></div>
                                        </a>
                                    </div>
                                    <!--Content-->
                                    <div class="card-body">
                                        <h4 class="">{{$gallery->name}}</h4>
                                        <a href="{{route('gallery.single',$gallery->id)}}" class="more">View Derails <i class="fa fa-chevron-right"></i></a>
                                    </div>
                                </div>
                                <!--Front Side-->
                            </div>
                        </div>
                        <!-- Rotating card -->
                    </div>
    {{--                    <div class="col-lg-4">
                        <div class="single-blog mt-30">
                            <div class="blog-image">
                                <a href="#">
                                    <img src="{{$gallery->img_paths['medium']}}" alt="{{$gallery->name}}">
                                </a>
                            </div>
                            <div class="blog-content">
                                <ul class="meta">
                                    <li><a href="#">{{date('d M, Y', strtotime($gallery->created_at))}}</a></li>
                                </ul>
                                <h4 class="blog-title"><a href="#">{{$gallery->name}}</a></h4>
                                <a href="#" class="more">View Derails <i class="fal fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </div> --}}
                @endforeach
            </div>
        </div>
    </div>
@endsection
@section('footer')

@endsection
