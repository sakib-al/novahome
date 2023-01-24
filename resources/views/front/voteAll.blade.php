@extends('front.layouts.master')
@php
    $page_title='All votes';
@endphp
@section('head')
    @include('meta::manager', [
        'title' => 'All votes - ' . ($settings_g['slogan'] ?? '')
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
    <div class="donation" id="app" style="margin-top: 100px;">
        <div class="container">
            <div class="row">
                @foreach($votes as $key=>$vote)
                    <div class="col-md-4">
                        <vote-create app_url="{{env('APP_URL')}}" :vote="{{$vote}}" ip="{{Request::ip()}}" img_path="{{$vote->img_paths['small']}}" :questions="{{ $vote->Questions }}" answers="{{$vote->voteAnswer}}" user_id="{{auth()->check()?auth()->id():null }}" all_page="1"></vote-create>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
@endsection
@section('footer')
    <script type="text/javascript" src="{{asset('back/js/app.js')}}"></script>
@endsection
