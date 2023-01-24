@extends('front.layouts.master')
@section('head')
    @include('meta::manager', [
        'title' => 'Feature Events - ' . ($settings_g['slogan'] ?? '')
    ])
@endsection

@section('master')
    <!-- Start Page Header Section -->
    <section class="bg-page-header-common">
        <div class="page-header-overlay py-4">
            <div class="container">
                <div>
                    <div class="page-header">
                        <div class="page-title text-center">
                            <h2 class="text-center">Feature Event</h2>
                        </div>
                        <!-- .page-title -->
                        <div class="page-header-content text-center">
                            <ol class="breadcrumb">
                                <li><a href="{{route('homepage')}}">Home</a></li>

                                <li>Feature Event</li>
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
            <div class="row">
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
            {{$featured_events->links()}}
        </div>
    </div>
@endsection
