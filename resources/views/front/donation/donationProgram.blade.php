@extends('front.layouts.master')
@php
    $page_title='Donation Programs';
@endphp
@section('head')
    @include('meta::manager', [
        'title' => 'Donation Programs - ' . ($settings_g['slogan'] ?? '')
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
            <section class="content_section_5">
                <div class="container-fluid">
                    <div class="row row-cols-1 row-cols-md-3 g-4 pb-5">
                        @foreach($fund_raisers as $fund)
                            <div class="col-md-4">
                                <div class="card h-100">
                                    <div class="img_inner_border">
                                        <img src="{{ $fund->img_paths['small'] }}" class="card-img-top" alt="...">
                                    </div>

                                    <div class="card-body">
                                        @if($fund->targeted_fund)
                                            <div class="raised">
                                                <span class="raised_title"> Raised {{$fund->targeted_fund}}</span> <span class="raised_font">Raised {{$fund->targeted_fund}}</span>
                                            </div>
                                        @endif
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped bg-success active" role="progressbar" style="width: {{ $fund->collected_fund }}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                                {{ $fund->collected_fund }}
                                            </div>
                                        </div>
                                        <div class="card_content">
                                            <h5 class="card-title">{{ $fund->title }}</h5>
                                            <div class="card-text">
                                                {!! \Illuminate\Support\Str::limit($fund->short_description,150) !!}
                                            </div>

                                        </div>
                                    </div>
                                    <div>
                                        <a href="{{ route('donate',$fund->id) }}" class="animated-button6 bt_back nav ml-1">
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                            Donate Now
                                        </a>
                                        {{-- <a href="{{ route('donate',$fund->id) }}" class=" btn btn-danger animated-button6 nav mr-3 mb-3" style="float: right">
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                            Donate Now
                                        </a> --}}
                                        {{--                                                   <button class="btn btn-danger mr-3 mb-3"  style="float: right">
                                            <a class="text-white" href="{{ route('donate',$fund->id) }}">Donate now</a>
                                        </button>--}}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
@section('footer')

@endsection
