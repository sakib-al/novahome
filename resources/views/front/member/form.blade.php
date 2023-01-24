@extends('front.layouts.master')

@section('head')
    @include('meta::manager', [
        'title' => 'Membership Form - ' . ($settings_g['title'] ?? env('APP_NAME')),
    ])
@endsection

@section('master')
<div class="page_wrap mt-5 mb-5">
    <div class="container-md pt-5">
        @if(isset($errors))
            @include('extra.error-validation')
        @endif
        @if(session('success'))
            @include('extra.success')
        @endif
        @if(session('error'))
            @include('extra.error')
        @endif
        <form action="{{route('user.form')}}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="card border-light shadow">
                <div class="card-header">
                    <h6 class="d-inline-block mb-0">Personal Information</h6>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 col-lg-3">
                            <div class="img_groupp uploaded_member_img_group">
                                <div class="text-center">
                                    <img class="img-thumbnail uploaded_img uploaded_member_img" src="{{ env('AWS_URL').'/img/user-img.jpg' )}}">
                                </div>

                                <div class="form-group mt-2">
                                    <div class="custom-file text-left">
                                        <input type="file" class="custom-file-input image_upload" accept="image/*" name="profile_image" required>
                                        <label class="custom-file-label"><b>Upload Profile*</b></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><b>Name*</b></label>
                                <input type="text" class="form-control" name="last_name" value="{{auth()->user()->last_name}}" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><b>Email*</b></label>
                                <input type="email" class="form-control" name="email" value="{{auth()->user()->email}}" disabled>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-light mt-3 shadow" id="app">
                <div class="card-header">
                    <h6 class="d-inline-block mb-0">Additional Information</h6>
                </div>

                <div class="card-body">
                    <member-form-frontend :member_types="{{ $member_types }}"></member-form-frontend>
                </div>
            </div>
            <button class="button button_md mt-3">Submit</button>
        </form>
    </div>
</div>
@endsection

@section('footer')
    <script type="text/javascript" src="{{asset('back/js/app.js')}}"></script>
    <script>
        // Uploaded image get url
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('.uploaded_img').attr('src', e.target.result);
                    $('.uploaded_img').show();
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $(document).on('change', ".image_upload", function(){
            readURL(this);
        });
    </script>
@endsection
