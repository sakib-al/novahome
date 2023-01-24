@extends('front.layouts.master')
@php
    $page_title=$event->title;
@endphp
@section('head')
    @include('meta::manager', [
        'title' => $event->title.' - ' . ($settings_g['slogan'] ?? '')
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
                <div class="col-md-6">
                    <div class="Sponsorship_description_r">
                        @if($event->img_paths['original'])
                            <img src="{{ $event->img_paths['original'] }}" class="img-fluid" width="100%" alt="{{$event->title}}">
                        @endif

                        <h4 class="page_title mb-1 mt-2">{{$event->title}}</h4>
                        <div>{!! $event->description !!}</div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div id="amount_div">
                        <form action="{{route('event.join')}}" type="GET">
                            @csrf
                            <h4 class="mb-3">Event Joining Form</h4>
                            <p class=""><i>Event Date :</i><span class="text-success"> {{ \Carbon\Carbon::parse($event->date)->format('j F, Y') }}</span> </p>
                            <p class=""><i>Time :</i> <span class="text-success"> {{ \Carbon\Carbon::parse($event->date)->format('h:m a') }}</span> </p>
                            <input type="hidden" name="event_id" value="{{ $event->id }}">
                            @if(\Carbon\Carbon::parse($event->date)->format('Ymd') >= \Carbon\Carbon::today()->format('Ymd'))
                                <event-form :join_types="{{ $event->joinType()->orderBy('position','ASC')->get() }}" auth_id="{{ auth()->id() }}"></event-form>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <button class="btn btn-success btn-block" type="submit">Sign Up</button>
                                    </div>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    <script type="text/javascript" src="{{asset('back/js/app.js')}}"></script>
@endsection
