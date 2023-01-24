@extends('back.layouts.master')
@section('title', 'Edit Member')

@section('master')
<div class="card">
    <div class="card-header">
        <a href="{{route('back.members.index')}}" class="btn btn-success btn-sm"><i class="fas fa-angle-double-left"></i> View All</a>
        <a href="{{route('back.members.create')}}" class="btn btn-info btn-sm"><i class="fas fa-plus"></i> Create</a>

        <form class="d-inline-block" action="{{route('back.members.destroy', $user->id)}}" method="POST">
            @method('DELETE')
            @csrf

            <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Are you sure to remove?')"><i class="fas fa-trash"></i> Delete</button>
        </form>
    </div>
</div>

<form action="{{route('back.members.update', $user->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PATCH')

    <div class="card border-light mt-3 shadow">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 col-lg-3">
                    <div class="text-center">
                        <div class="img_group">
                            <img class="img-thumbnail uploaded_img" src="{{$user->profile_path}}">

                            @if($user->profile_image)
                            <a href="{{route('back.members.removeImage', $user->id)}}" onclick="return confirm('Are you sure to remove?');" class="btn btn-sm btn-danger remove_image" title="Remove image"><i class="fas fa-times"></i></a>
                            @endif

                            <div class="form-group text-center">
                                <label><b>Upload Profile</b></label>
                                <div class="custom-file text-left">
                                    <input type="file" class="custom-file-input image_upload" name="profile_image" accept="image/*">
                                    <label class="custom-file-label">Choose file...</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label><b>Full Name*</b></label>
                        <input type="text" class="form-control" name="last_name" value="{{old('last_name') ?? $user->last_name}}" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label><b>Email*</b></label>

                        <input type="email" class="form-control" name="email" value="{{old('email') ?? $user->email}}" required>
                    </div>
                </div>
            </div>
            <member-form-create :member_types="{{ $member_types }}" :user="{{ $user }}"></member-form-create>
        </div>
    </div>

    <div class="card border-light mt-3 shadow">
        <div class="card-footer">
            <button class="btn btn-success btn-lg">Update</button>
            <br>
            <small><b>NB: *</b> marked are required field.</small>
        </div>
    </div>
</form>
@endsection
@section('footer')
    <script type="text/javascript" src="{{asset('back/js/app.js')}}"></script>
@endsection
