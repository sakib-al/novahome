@extends('front.layouts.master')
@section('head')
@include('meta::manager', [
    'title' => 'Edit Information - ' . ($settings_g['slogan'] ?? '')
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
                        <form action="{{route('member.profile.update')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-header bg-success">
                                <h5 class="mb-0 text-white">Edit Information</h5>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="text-center">
                                                @if($user->profile_image)
                                                    <img class="img-thumbnail uploaded_img" src="{{$user->profile_path}}">
                                                @else
                                                    <img class="img-thumbnail uploaded_img" src="{{  env('AWS_URL').'/img/default-img.png' }}">
                                                @endif
                                            </div>

                                            <div class="form-group text-center">
                                                <label><b>Profile Picture</b></label>
                                                <div class="custom-file text-left">
                                                    <input type="file" class="custom-file-input image_upload" name="profile" accept="image/*">
                                                    <label class="custom-file-label">Choose file...</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Last Name*</label>
                                            <input type="text" name="last_name" value="{{$user->last_name }}" class="form-control form-control-sm" placeholder="First Name" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>First Name*</label>
                                            <input type="text" name="first_name" value="{{$user->first_name }}" class="form-control form-control-sm" placeholder="First Name" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Email Address*</label>
                                            <input type="email" name="email" value="{{ $user->email }}" class="form-control form-control-sm" placeholder="Email Address" required="">
                                        </div>
                                    </div>
                                    @php
                                        $type = $user->memberType;
                                        $attributes=[];
                                        if(isset($type->id)){
                                            try {
                                                $attributes = json_decode($type->attributes);
                                             }catch (Exception $e){
                                                $attributes=[];
                                             }
                                        }
                                        $info=null;
                                        if(isset($user->id)){
                                            try {
                                                $info = json_decode($user->info);
                                             }catch (Exception $e){
                                                $info=null;
                                             }
                                        }
                                        //print_r($info->gender);
                                    @endphp

                                    @foreach($attributes as $key=>$at)
                                        @if($at->input_type==='text' || $at->input_type==='email' || $at->input_type==='date')
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label><b>{{ $at->label }}</b></label>
                                                    <input class="form-control" name="{{$at->input_name}}"   type="{{$at->input_type}}" placeholder="write {{$at->input_name}}"  required="{{!!$at->is_required}}">
                                                </div>
                                            </div>
                                        @elseif($at->input_type==='image')
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label><b>{{ $at->label }}</b></label>
                                                    <input class="form-control" name="{{$at->input_name}}" type="file" accept="image/jpeg;image/jpg;image/png" placeholder="select {{$at->input_name}}" >
                                                    @php
                                                        $aa=$at->input_name;
                                                    @endphp
                                                    @if($info && isset($info->$aa))
                                                        <label><a href="{{ asset($info->$aa) }}" target="_blank">View Previous</a></label>
                                                    @endif
                                                </div>
                                            </div>
                                        @elseif($at->input_type==='file')
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label><b>{{ $at->label }}</b></label>
                                                    <input class="form-control" name="{{$at->input_name}}" type="file" placeholder="select {{$at->input_name}}">
                                                    @php
                                                        $aa=$at->input_name;
                                                    @endphp
                                                    @if($info && isset($info->$aa))
                                                        <label><a href="{{ asset($info->$aa) }}" target="_blank">View Previous</a></label>
                                                    @endif
                                                </div>
                                            </div>
                                        @elseif($at->input_type==='dropdown')
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label><b>{{ $at->label }}</b></label>
                                                    <select class="form-control" name="{{$at->input_name}}" required="{{!!$at->is_required}}">
                                                        @foreach($at->options as $op)
                                                            @if($info)
                                                            <option
                                                                @php
                                                                    $aa=$at->input_name;
                                                                @endphp
                                                                {{ isset($info->$aa)?$info->$aa == $op?'selected':'':'' }}
                                                                value="{{$op}}">{{ $op }}</option>
                                                            @else
                                                                <option  value="{{$op}}">{{ $op }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        @elseif($at->input_type==='radio')
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label><b>{{ $at->label }}</b></label>
                                                    @foreach($at->options as $op)
                                                        @if($info)
                                                            <div class="form-check">
                                                                <label class="form-check-label">
                                                                    <input
                                                                        @php
                                                                            $aa=$at->input_name;
                                                                        @endphp
                                                                        {{ isset($info->$aa)?$info->$aa == $op?'checked':'':'' }}
                                                                        type="radio" class="form-check-input" name="{{$at->input_name}}" value="{{$op}}" required="{{!!$at->is_required}}">{{ $op }}
                                                                </label>
                                                            </div>
                                                        @else
                                                            <div class="form-check">
                                                                <label class="form-check-label">
                                                                    <input type="radio" class="form-check-input" name="{{$at->input_name}}" value="{{$op}}" required="{{!!$at->is_required}}">{{ $op }}
                                                                </label>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif

                                    @endforeach
                                </div>
                                <button class="btn btn-success" type="submit">Update Information</button>
                            </div>
                        </form>
                    </div>

                    <div class="card shadow mb-4">
                        <form action="{{ route('member.password.update') }}" method="POST">
                            @csrf
                            <div class="card-header primary_header">
                                <h5 class="mb-0">Change Password</h5>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Old Password*</label>
                                            <input type="password" name="old_password" class="form-control form-control-sm" placeholder="Old Password" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>New Password*</label>
                                            <input type="password" name="password" class="form-control form-control-sm" placeholder="New Password" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Confirm Password*</label>
                                            <input type="password" name="password_confirmation" class="form-control form-control-sm" placeholder="Confirm Password" required="">
                                        </div>
                                    </div>
                                </div>

                                <button class="btn btn-success" type="submit">Change Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
