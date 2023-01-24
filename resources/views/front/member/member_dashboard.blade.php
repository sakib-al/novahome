@extends('front.layouts.master')

@section('head')
@include('meta::manager', [
    'title' => 'Dashboard - ' . ($settings_g['slogan'] ?? '')
])
@endsection

@section('master')
<div class="page_wrap pages_page_wrap" style="margin-top: 100px">
    <div class="container-md">
        <div class="row">
            @include('front.member.sidebar')

            <div class="col-md-6 col-lg-9">
                <div class="up_content_wrap">
                    <div class="card shadow mb-4">
                        <div class="card-header bg-success">
                            <h4 class="text-white">Dashboard</h4>
                        </div>

                        <div class="card-body">
                            <div class="dashboard_items counter-section">
                                <div class="row">
                                    <div class="col-lg-6 col-xl-3 mb-1">
                                        <div class="card mb-3 text-black bg-white custom_dashboard_card w-100 h-100">
                                            <a href="{{ route('member.contribution') }}" class="card-body a_custom text-black-50 text-center">
                                                <img src="{{ env('AWS_URL').'/front/dashboard/contribution.jpg' }}" class="img-fluid img_60" alt="">
                                                <h1 class="card-title">{{ $contribution_total }}</h1>
                                                <p class="card-text">Contribution</p>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-xl-3 mb-1">
                                        <div class="card mb-3 text-black bg-white custom_dashboard_card w-100 h-100">
                                            <a href="{{ route('member.contribution') }}" class="card-body a_custom text-black-50 text-center ">
                                                <img src="{{ env('AWS_URL').'/front/dashboard/contribution_amount.jpg' }}" class="img-fluid img_60" alt="">
                                                <h1 class="card-title">{{ $contribution_amount }}</h1>
                                                <p class="card-text">Contribution Amount</p>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-xl-3 mb-1">
                                        <div class="card mb-3 text-black bg-white custom_dashboard_card w-100 h-100">
                                            <a href="{{ route('member.event_join') }}" class="card-body a_custom text-black-50 text-center">
                                                <img src="{{ env('AWS_URL').'/front/dashboard/join.jpg' }}" class="img-fluid img_60" alt="">
                                                <h1 class="card-title">{{ $total_event_join }}</h1>
                                                <p class="card-text">Event Join</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
