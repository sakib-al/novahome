@extends('front.layouts.master')

@section('head')
@include('meta::manager', [
    'title' => 'Contribution - ' . ($settings_g['slogan'] ?? '')
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
                            <h4 class="text-white">Contribution</h4>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Date</th>
                                        <th>Program</th>
                                        <th>Amount</th>
                                        <th>Payment Type</th>
                                        <th>Frequency of Payment</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($donations as $key=>$donation)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{\Illuminate\Support\Carbon::parse($donation->created_at)->format('Y-m-d')}}</td>
                                        <td>
                                            @if($donation->fundRaiser)
                                                <a class="a_custom" href="{{route('donate',$donation->fundRaiser->id)}}" target="_blank">{{ $donation->fundRaiser->title }}</a>
                                            @endif
                                        </td>
                                        <td>{{ $donation->amount }}</td>
                                        <td>{{ $donation->payment_type==1?'One time':'others' }}</td>
                                        <td>{{ $donation->f_payment }}</td>
                                        <td>{{ $donation->payment_status }}</td>
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
