@extends('front.layouts.master')
@php
    $page_title=$homeSection->title;
@endphp
@section('head')
    @include('meta::manager', [
        'title' => $homeSection->title.'- ' . ($settings_g['slogan'] ?? '')
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
    <div class="donation" style="margin-top: 100px;">
        <div class="container">
            <div class="Sponsorship_description_r">
                <img src="{{$homeSection->img_paths['original']}}" class="img-fluid" alt="{{ $homeSection->title }}" width="100%" style="max-height: 500px">
                <h5 class="page_title mb-1 mt-2">{{ $homeSection->title }}</h5>
                <div>{!! $homeSection->description !!}</div>
            </div>
        </div>
    </div>
@endsection

