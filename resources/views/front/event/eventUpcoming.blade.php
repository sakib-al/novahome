@extends('front.layouts.master')
@section('head')
    @include('meta::manager', [
        'title' => 'Upcoming Events - ' . ($settings_g['slogan'] ?? '')
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
                            <h2 class="text-center">Upcoming Event</h2>
                        </div>
                        <!-- .page-title -->
                        <div class="page-header-content text-center">
                            <ol class="breadcrumb">
                                <li><a href="{{route('homepage')}}">Home</a></li>

                                <li>Upcoming Event</li>
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
                @foreach($events as $event)
                    <div class="col-md-3">
                        <a href="{{route('event', $event->id)}}" class="ue_box d-block">
                            <div class="thumb">
                                <img src="{{ $event->img_paths['small'] }}" alt="{{$event->title}}" class="whp">

                                <div class="ue_date">
                                    {{Carbon\Carbon::parse($event->date)->format('M')}}
                                    <br>
                                    {{Carbon\Carbon::parse($event->date)->format('d')}}
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

            <br>
            {{$events->links()}}
        </div>
    </div>
@endsection
