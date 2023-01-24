@extends('front.layouts.master')
@php
    $page_title="Events"
@endphp
@section('head')
    @include('meta::manager', [
        'title' => 'Events - ' . ($settings_g['slogan'] ?? '')
    ])

    {{-- <link rel="stylesheet" href="{{asset('front/css/owl.carousel.min.css')}}"> --}}

    <style>
        .card-img-wrap {
            z-index: 999;
        }
        .card-img-wrap img{height: unset}
        .upcoming_events .owl-carousel .owl-nav{float: left;}
        .upcoming_events .owl-dots {
            margin-top: 3px;
        }
    </style>
@endsection

@section('master')
    <!-- Start Page Header Section -->
    <section class="bg-page-header-common">
        <div class="page-header-overlay py-4">
            <div class="container">
                <div>
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

    <div class="mb-5">
        <div class="container-fluid">
            @if(count($featured_events))
            <div class="row mt-5">
                <div class="col-md-12 offset-min-1">
                    <h2>Feature Events</h2>
                </div>
            </div>

            <div class="row justify-content-center">
                @foreach($featured_events as $featured_event)
                    <div class="col-md-3">
                        <a href="{{route('event', $featured_event->id)}}" class="ue_box d-block">
                            <div class="thumb">
                                <img src="{{ $featured_event->img_paths['small'] }}" alt="{{$featured_event->title}}" class="whp">

                                <div class="ue_date">
                                    {{Carbon\Carbon::parse($featured_event->date)->format('M')}}
                                    <br>
                                    {{Carbon\Carbon::parse($featured_event->date)->format('d')}}
                                </div>
                            </div>

                            <div class="ue_text">
                                <div class="ue_title">{{$featured_event->title}}</div>

                                <p class="mb-0">{{$featured_event->short_description ?? $featured_event->title}}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

            <br>
            <div class="text-center">
                <a href="{{route('event.feature')}}" class="animated-button6 bt_back d-inline-block nav mt-2">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    View All
                </a>
            </div>

            {{-- <div class="upcoming_events" style="background: #FFFFFF">
                <div class="">
                    <div class="ue_wrap">
                        <div class="feature_events_items owl-carousel">
                            @foreach ($featured_events as $featured)
                                <div class="a_ue_item">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="upcoming_events_items">
                                                <div class="ue_owl_item">
                                                    <a href="{{route('event', $featured->id)}}" class="ue_box d-block">
                                                        <div class="thumb card-img-wrap event_image_container">
                                                            <div class="event_image_wrap">
                                                                <img src="{{ $featured->img_paths['original'] }}" alt="{{ $featured->title }}" class="whp">
                                                            </div>

                                                            <div class="ue_date">
                                                                {{\Illuminate\Support\Carbon::parse($featured->date)->format('M')}}
                                                                <br>
                                                                {{\Illuminate\Support\Carbon::parse($featured->date)->format('d')}}
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4" >
                                            <div class="ue_right_text" style="background: #FFFFFF">
                                                <h2 class="ue_section_title">{{ $featured->title }}</h2>
                                                <div class="ue_section_content mb-3">{!! $featured->short_description ?? $featured->title !!}</div>
                                                <a href="{{route('event', $featured->id)}}" class="ue_button">View Details <i class="fas fa-arrow-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div> --}}
            @endif

            {{-- @if($featured)
            <div class="feature_event">
                <div class="row mt-5">
                    <div class="col-md-12 offset-min-1">
                        <h2>Featured Events</h2>
                    </div>
                </div>

                <a href="{{route('event', $featured->id)}}" class="ue_box d-block">
                    <div class="thumb">
                        <img src="{{ $featured->img_paths['small'] }}" alt="{{$featured->title}}" class="whp">

                        <div class="ue_date">
                            {{\Illuminate\Support\Carbon::parse($featured->date)->format('M')}}
                            <br>
                            {{\Illuminate\Support\Carbon::parse($featured->date)->format('d')}}
                        </div>
                    </div>

                    <div class="ue_text">
                        <div class="ue_title">{{$featured->title}}</div>

                        <p class="mb-0">{{$featured->short_description ?? $featured->title}}</p>
                    </div>
                </a>
            </div>
            @endif --}}

            @if(count($events))
            <div class="row mt-5">
                <div class="col-md-12 offset-min-1">
                    <h2>Upcoming Events</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                @foreach($events as $event)
                    <div class="col-md-4">
                        <a href="{{route('event', $event->id)}}" class="ue_box d-block">
                            <div class="thumb">
                                <img src="{{ $event->img_paths['small'] }}" alt="{{$event->title}}" class="whp">

                                <div class="ue_date">
                                    {{\Illuminate\Support\Carbon::parse($event->date)->format('M')}}
                                    <br>
                                    {{\Illuminate\Support\Carbon::parse($event->date)->format('d')}}
                                </div>
                            </div>

                            <div class="ue_text">
                                <div class="ue_title">{{$event->title}}</div>

                                <p class="mb-0">{{$event->short_description ?? $event->title}}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            @endif

            <br>
            <div class="text-center">
                <a href="{{route('event.upcoming')}}" class="animated-button6 bt_back d-inline-block nav mt-2">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    View All
                </a>
            </div>


            @if(count($past_events))
            <div class="row mt-5">
                <div class="col-md-12 offset-min-1">
                    <h2>Past Events</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                @foreach($past_events as $past_event)
                    <div class="col-md-3">
                        <a href="{{route('event', $past_event->id)}}" class="ue_box d-block">
                            <div class="thumb">
                                <img src="{{ $past_event->img_paths['small'] }}" alt="{{$past_event->title}}" class="whp">

                                <div class="ue_date">
                                    {{\Illuminate\Support\Carbon::parse($past_event->date)->format('M')}}
                                    <br>
                                    {{\Illuminate\Support\Carbon::parse($past_event->date)->format('d')}}
                                </div>
                            </div>

                            <div class="ue_text">
                                <div class="ue_title">{{$past_event->title}}</div>

                                <p class="mb-0">{{$past_event->short_description ?? $past_event->title}}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

            <br>
            <div class="text-center">
                <a href="{{route('event.past')}}" class="animated-button6 bt_back d-inline-block nav mt-2">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    View All
                </a>
            </div>
            @endif
        </div>
    </div>
@endsection


{{-- @section('footer')
    <script src="{{asset('front/assets/js/owl.carousel.min.js')}}"></script>

    <script>
        $(".feature_events_items").owlCarousel({
            loop: true,
            margin: 30,
            autoplay: true,
            autoplayHoverPause: true,
            responsiveClass: true,
            nav: true,
            slideBy: 3,
            responsive: {
            0: {
                items: 1,
                nav: true
            },
            600: {
                items: 1,
                nav: true
            },
            1000: {
                items: 1,
                nav: true,
            }
            }
        });
    </script>
@endsection --}}
