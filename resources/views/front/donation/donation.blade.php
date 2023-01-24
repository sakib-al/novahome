@extends('front.layouts.master')
@php
    $page_title='Contributions';
@endphp
@section('head')
    @include('meta::manager', [
        'title' => 'Contributions - ' . ($settings_g['slogan'] ?? '')
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
            <div class="row">
                <div class="col-md-6">
                    <div class="Sponsorship_description_r">
                        <img src="{{$fundRaiser->img_paths['small']}}" class="img-fluid" alt="{{ $fundRaiser->title }}" width="100%">
                        <h5 class="page_title mb-1 mt-2">{{ $fundRaiser->title }}</h5>
                        <div>{!! $fundRaiser->description !!}</div>
                    </div>
                </div>
                <div class="col-md-6">
                        <h3><strong>Donate</strong></h3>
                        <div id="amount_div">
                            <form action="{{route('donation.payment')}}" type="POST">
                                @csrf
                                @method('GET')
                                <h5>Choose Payment Method</h5>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <button type="button" id="payment_one" onclick="payment_method(1)" class="btn btn-success btn-lg btn-block">Give Monthly</button>
                                    </div>
                                    <div class="col-sm-6">
                                        <button type="button" id="payment_two" onclick="payment_method(2)" class="btn btn-outline-primary btn-lg btn-block">Give One Time</button>
                                    </div>
                                </div>
                                <div id="payment_div">
                                    <div class="form-group row">
                                        <label for="staticEmail" class="col-sm-6 col-form-label">Frequency Of Payment</label>
                                        <div class="col-sm-6">
                                            <select class="form-control" name="f_payment" id="f_payment">
                                                <option value="null" selected disabled>Select Payment</option>
                                                @php
                                                    $f_payments=[];
                                                    try{
                                                       $f_payments= json_decode($fundRaiser->f_of_payments);
                                                     }catch (Exception $e){
                                                        $f_payments=[];
                                                     }
                                                @endphp
                                                @if(isset($f_payments))
                                                    @foreach($f_payments as $pay)
                                                        <option value="{{$pay}}">{{$pay}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    @php
                                        $d_amounts=[];
                                        try{
                                           $d_amounts= json_decode($fundRaiser->default_amounts);
                                         }catch (Exception $e){
                                            $d_amounts=[];
                                         }
                                    @endphp
                                    @if(isset($d_amounts))
                                        @foreach($d_amounts as $aa)
                                            <div class="col-sm-3">
                                                <button type="button" onclick="amountChange({{$aa}})" class="btn btn-success btn-lg btn-block">
                                                    ${{$aa}} </button>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <input type="hidden" name="fund_raiser_id" class="form-control" id="fund_raiser_id" value="{{ $fundRaiser->id }}" required>
                                <input type="hidden" name="payment_type" class="form-control" id="payment_type" value="2" required>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-4 col-form-label">Amount (USD)</label>
                                    <div class="col-sm-8">
                                        <input type="number" step="any" name="amount" class="form-control" placeholder="amount here" id="show_amount" required>
                                    </div>
                                </div>
                                @if(!auth()->check())
                                    <div class="form-group row">
                                        <label for="staticEmail" class="col-sm-4 col-form-label">Email</label>
                                        <div class="col-sm-8">
                                            <input type="email" name="email" class="form-control" placeholder="example@email.com" id="show_amount" required>
                                        </div>
                                    </div>
                                @endif

                                @php
                                    $fields=[];
                                    try{
                                       $fields= json_decode($fundRaiser->fields);
                                     }catch (Exception $e){
                                        $fields=[];
                                     }
                                @endphp
                                @if(isset($fields))
                                    @foreach($fields as $fl)
                                        @if($fl->input_type==='text' || $fl->input_type==='email' || $fl->input_type==='date')
                                            <div class="form-group row">
                                                <label for="staticEmail" class="col-sm-4 col-form-label">{{ $fl->label }}</label>
                                                <div class="col-sm-8">
                                                    <input class="form-control" name="{{ $fl->input_name }}" type="{{$fl->input_type}}"  placeholder="write {{ $fl->label }}" required="{{!!$fl->is_required}}">
                                                </div>
                                            </div>
                                        @elseif($fl->input_type==='dropdown')
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label">{{ $fl->label }}</label>
                                                <div class="col-sm-8">
                                                    <select class="form-control" name="{{$fl->input_name}}" required="{{!!$fl->is_required}}">
                                                        <option value="null">Select One</option>
                                                        @foreach($fl->options as $op)
                                                            <option  value="{{$op}}">{{ $op }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        @elseif($fl->input_type==='radio')
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label">{{ $fl->label }}</label>
                                                <div class="col-sm-8">
                                                    @foreach($fl->options as $op)
                                                        <input type="radio" name="{{$fl->input_name}}" value="{{$op}}" required="{{!!$fl->is_required}}">{{$op}}
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <button class="btn btn-success btn-block" type="submit">Donate Now</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    <script>
        function payment_method(val){
            if(val==1){
                $('#payment_div').show();
                $('#amount_div').show();
                $('#payment_type').val(2);
                $('#payment_one').addClass('btn-success');
                $('#payment_one').removeClass('btn-outline-primary');

                $('#payment_two').addClass('btn-outline-primary');
                $('#payment_two').removeClass('btn-success');
            }else if(val==2){
                $('#amount_div').show();
                $('#payment_div').hide();
                $('#payment_type').val(1);

                $('#f_payment').val('');
                $('#payment_two').addClass('btn-success');
                $('#payment_two').removeClass('btn-outline-primary');

                $('#payment_one').addClass('btn-outline-primary');
                $('#payment_one').removeClass('btn-success');
            }
        }
        function amountChange(amount){
            $('#show_amount').val(amount);
        }

    </script>
@endsection
