@extends('front.layouts.master')
@php
    $page_title="Latest News"
@endphp
@section('head')
    @include('meta::manager', [
        'title' => 'Latest News - ' . ($settings_g['slogan'] ?? '')
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
    <div class="row" style="margin-top: 100px;width: 100%">
        @for($i=0; $i<count($news); $i += 3)
            <div class="container" style="min-height: 600px">
                <div class="row row-cols-1 row-cols-md-3 g-4 pb-5">
                    @for($j=0; $j<3; $j++)
                        @if(isset($news[$i+$j]))
                            <div class="col-sm-4">
                                <div class="card h-100">
                                    <div class="img_inner_border">
                                        <img src="{{ $news[$i+$j]->img_paths['small'] }}" class="card-img-top" alt="...">
                                    </div>
                                    <div class="card-body overlap_content h-100">
                                        <h5 class="card-title" style="min-height: 60px">{{$news[$i+$j]->title}}</h5>
                                        <p class=""><i>Posted on</i> <span class="text-danger">{{ \Carbon\Carbon::parse($news[$i+$j]->created_at)->format('j F, Y') }}</span> </p>
                                        <div class="card-text">
                                            {!! \Illuminate\Support\Str::limit($news[$i+$j]->short_description,150) !!}
                                        </div>
                                        <div>
                                            <a href="{{route('news.single',$news[$i+$j]->id)}}" class="animated-button6 bt_back nav mt-2">
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                Read More
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endfor
                </div>
            </div>
        @endfor
    </div>
@endsection
