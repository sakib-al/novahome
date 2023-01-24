@extends('back.layouts.master')
@section('title', 'Create Team')
@section('head')
    <style>
        .uploaded_member_img{
            width: 70%;
        }
    </style>
@endsection
@section('master')
<form action="{{route('back.teams.store')}}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="card border-light mt-3 shadow">
        <div class="card-header">
            <a href="{{route('back.teams.index')}}" class="btn btn-success btn-sm"><i class="fas fa-angle-double-left"></i> View All</a>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-4 col-lg-2">
                    <div class="img_groupp uploaded_member_img_group">
                        <div class="">
                            <img class="img-thumbnail uploaded_img uploaded_member_img" src="{{ env('AWS_URL').'/img/user-img.jpg'}}">
                        </div>

                        <div class="form-group mt-2">
                            <div class="custom-file text-left">
                                <input type="file" class="custom-file-input image_upload" accept="image/*" name="image">
                                <label class="custom-file-label"><b>Upload Profile</b></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label><b>Name *</b></label>

                        <input type="text" class="form-control" name="name" placeholder="write your name" value="{{old('name')}}" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label><b>Designation *</b></label>
                        <input type="text" class="form-control" name="designation" placeholder="write your designation" value="{{old('designation')}}" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label><b>Member Type *</b></label>
                        <select name="member_type" class="form-control" required>
                            <option value="1">Board</option>
                            <option value="2">Executive</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label><b>Position *</b></label>
                        <input type="number" class="form-control" name="position" placeholder="write position here" value="{{old('position')}}" required>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label><b>Description</b></label>

                        <textarea id="editor" class="form-control form-control-sm" name="description" cols="30" rows="3">{{old('description')}}</textarea>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-success btn-block">Create</button>
                    <small><b>NB: *</b> marked are required field.</small>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
@section('footer')
    <!-- CK Editor -->
    <script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
    <script>
        // CKEditor
        $(function () {
            CKEDITOR.replace('editor', {
                height: 400
            });
        });
    </script>
@endsection
