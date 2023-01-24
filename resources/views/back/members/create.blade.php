@extends('back.layouts.master')
@section('title', 'Create Member')

@section('master')
<form action="{{route('back.members.store')}}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="card border-light mt-3 shadow">
        <div class="card-header">
            <a href="{{route('back.members.index')}}" class="btn btn-success btn-sm"><i class="fas fa-angle-double-left"></i> View All</a>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-4 col-lg-3">
                    <div class="img_groupp uploaded_member_img_group">
                        <div class="text-center">
                            <img class="img-thumbnail uploaded_img uploaded_member_img" src="{{ env('AWS_URL').'/img/user-img.jpg'}}">
                        </div>

                        <div class="form-group mt-2">
                            <div class="custom-file text-left">
                                <input type="file" class="custom-file-input image_upload" accept="image/*" name="profile_image">
                                <label class="custom-file-label"><b>Upload Profile</b></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label><b>Full Name*</b></label>

                        <input type="text" class="form-control" name="last_name" placeholder="full name" value="{{old('last_name')}}" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label><b>Email*</b></label>
                        <input type="email" class="form-control" name="email" placeholder="email" value="{{old('email')}}" required>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-light mt-3 shadow">
        <div class="card-header">
            <h5 class="d-inline-block">Basic Information</h5>
        </div>

        <div class="card-body">
            <member-form-create :member_types="{{ $member_types }}"></member-form-create>
        </div>
    </div>

    <div class="card border-light mt-3 shadow">
        <div class="card-header">
            <h5 class="d-inline-block">Additional Information</h5>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label><b>Password*</b></label>

                        <input type="password" class="form-control" name="password"  required>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label><b>Confirn Password*</b></label>

                        <input type="password" class="form-control" name="password_confirmation" required>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <button class="btn btn-success btn-lg">Create</button>
            <br>
            <small><b>NB: *</b> marked are required field.</small>
        </div>
    </div>
</form>
@endsection
@section('footer')
    <script type="text/javascript" src="{{asset('back/js/app.js')}}"></script>
@endsection
