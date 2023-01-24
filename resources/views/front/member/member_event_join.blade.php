@extends('front.layouts.master')
@section('head')
@include('meta::manager', [
    'title' => 'Event Join - ' . ($settings_g['slogan'] ?? '')
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
                            <h4 class="text-white">Event Join</h4>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Event Name</th>
                                        <th>Event Date</th>
                                        <th>Event Description</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($event_joins as $key=>$join)
                                        <tr>
                                            @php
                                                $event = $join->event;
                                            @endphp
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ isset($event->name)?$event->name:'' }}</td>
                                            <td>{{ isset($event->date)?\Illuminate\Support\Carbon::parse($event->date)->format('Y m d h:m a'):'' }}</td>
                                            <td>{{ isset($event->description)?\Illuminate\Support\Str::limit($event->description,100):'' }}</td>
                                            <td class="text-right">
                                                <a href="{{ route('event',$join->event_id) }}" class="btn btn-sm btn-success"><i class="fas fa-eye" aria-hidden="true"></i> View</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
