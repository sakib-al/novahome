@extends('front.layouts.master')
@php
    $page_title=$gallery->name;
@endphp
@section('head')
    @include('meta::manager', [
        'title' => $gallery->name.' - ' . ($settings_g['slogan'] ?? '')
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
                @foreach ($gallery->GalleryItems as $item)
                    <div class="col-sm-3">
                        <!-- Rotating card -->
                        <div class="card-wrapper">
                            <div id="card-2" class="card card-rotating text-center">
                                <!--Front Side-->
                                <div class="face front">
                                    <!-- Image-->
                                    <div class="view overlay card-img-wrap gallery">
                                        <img class="card-img-top img-fluid" src="{{$item->img_paths['original']}}" alt="{{$gallery->name}}">
                                        <a>
                                            <div class="mask rgba-white-slight"></div>
                                        </a>
                                    </div>
                                </div>
                                <!--Front Side-->
                            </div>
                        </div>
                        <!-- Rotating card -->
                    </div>
                @endforeach

            </div>
        </div>
    </div>
@endsection
@section('footer')

@endsection
