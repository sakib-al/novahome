@extends('back.layouts.master')
@section('title', 'Edit Member')

@section('master')
<div class="card">
    <div class="card-header">
        <a href="{{route('back.teams.index')}}" class="btn btn-success btn-sm"><i class="fas fa-angle-double-left"></i> View All</a>
        <a href="{{route('back.teams.create')}}" class="btn btn-info btn-sm"><i class="fas fa-plus"></i> Create</a>

        <form class="d-inline-block" action="{{route('back.teams.destroy', $our_team->id)}}" method="POST">
            @method('DELETE')
            @csrf

            <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Are you sure to remove?')"><i class="fas fa-trash"></i> Delete</button>
        </form>
    </div>
</div>

<form action="{{route('back.teams.update', $our_team->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PATCH')

    <div class="card border-light mt-3 shadow">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 col-lg-2">
                    <div class="">
                        <div class="img_group">
                            <img class="img-thumbnail uploaded_img" src="{{$our_team->img_paths['original']}}">

                            @if($our_team->profile)
                            <a href="{{route('back.teams.removeImage', $our_team->id)}}" onclick="return confirm('Are you sure to remove?');" class="btn btn-sm btn-danger remove_image" title="Remove image"><i class="fas fa-times"></i></a>
                            @endif

                            <div class="form-group text-center">
                                <label><b>Upload Profile</b></label>
                                <div class="custom-file text-left">
                                    <input type="file" class="custom-file-input image_upload" name="image" accept="image/*">
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
                        <label><b>Name *</b></label>

                        <input type="text" class="form-control" name="name" value="{{old('name') ?? $our_team->name}}" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label><b>Designation *</b></label>

                        <input type="text" class="form-control" name="designation" value="{{old('designation') ?? $our_team->designation}}" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label><b>Member Type *</b></label>
                        <select name="member_type" class="form-control" required>
                            <option value="1" {{$our_team->member_type == 1 ? 'selected' : ''}}>Board</option>
                            <option value="2" {{$our_team->member_type == 2 ? 'selected' : ''}}>Executive</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label><b>Position *</b></label>
                        <input type="number" class="form-control" name="position" placeholder="write position here" value="{{old('position')??$our_team->position}}" required>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label><b>Description </b></label>

                        <textarea id="editor" class="form-control form-control-sm" name="description" cols="30" rows="3">{{old('description')??$our_team->description}}</textarea>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-success btn-block">Update</button>
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
