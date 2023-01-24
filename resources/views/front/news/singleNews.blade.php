@extends('front.layouts.master')
@php
    $page_title=$blog->title;
@endphp
@section('head')
    @include('meta::manager', [
        'title' => $blog->title.'- ' . ($settings_g['slogan'] ?? '')
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
                @if($blog->image)
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <img src="{{$blog->img_paths['original']}}" class="img-fluid" alt="{{ $blog->title }}" width="100%" style="max-height: 500px">
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <h5 class="page_title mb-1 mt-2">{{ $blog->title }}</h5>
                        <p class=""><i>Posted on</i> <span class="text-danger">{{ \Carbon\Carbon::parse($blog->created_at)->format('j F, Y') }}</span> </p>
                        <div>{!! $blog->description !!}</div>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                @if($blog->video_type== "Embade Code" && $blog->video_embade_code)
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6 mb-4 mt-4">
                            {!! $blog->video_embade_code !!}
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                @elseif($blog->video_type== "File" && $blog->video)
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6 mb-4 mt-4">
                            <video class="img-fluid" autoplay loop muted>
                                <source src="{{ $blog->video_path }}" type="video/mp4" />
                            </video>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

