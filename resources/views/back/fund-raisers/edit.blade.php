@extends('back.layouts.master')
@section('title', 'Edit Fund Raiser')

@section('master')
<div class="card">
    <div class="card-header">
        <a href="{{route('back.fund-raisers.index')}}" class="btn btn-success btn-sm"><i class="fas fa-angle-double-left"></i> View All</a>
        <a href="{{route('back.fund-raisers.create')}}" class="btn btn-info btn-sm"><i class="fas fa-plus"></i> Create</a>

        <form class="d-inline-block" action="{{route('back.fund-raisers.destroy', $fundRaiser->id)}}" method="POST">
            @method('DELETE')
            @csrf

            <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Are you sure to remove?')"><i class="fas fa-trash"></i> Delete</button>
        </form>
    </div>
</div>

<form action="{{route('back.fund-raisers.update', $fundRaiser->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PATCH')

<div class="row">
    <div class="col-md-8">
        <div class="card border-light mt-3 shadow">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label><b>Title*</b></label>
                            <input type="text" class="form-control form-control-sm" name="title" value="{{old('title') ?? $fundRaiser->title}}" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label><b>Treated Fund*</b></label>
                            <input type="number" class="form-control form-control-sm" name="targeted_fund" value="{{old('targeted_fund') ?? $fundRaiser->targeted_fund}}" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label><b>Short Description</b></label>

                            <textarea class="form-control form-control-sm" name="short_description" cols="30" rows="3">{{old('short_description') ?? $fundRaiser->short_description}}</textarea>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label><b>Description*</b></label>

                            <textarea id="editor" class="form-control form-control-sm" name="description" cols="30" rows="3" required>{{old('description') ?? $fundRaiser->description}}</textarea>
                        </div>
                    </div>
                    <fund-raiser-donation :donation="{{ $fundRaiser }}"></fund-raiser-donation>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-light mt-3 shadow">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-center">
                            <div class="img_group">
                                <img class="img-thumbnail uploaded_img" src="{{$fundRaiser->img_paths['small']}}">

                                @if($fundRaiser->media_id)
                                <a href="{{route('back.fund-raisers.removeImage', $fundRaiser->id)}}" onclick="return confirm('Are you sure to remove?');" class="btn btn-sm btn-danger remove_image" title="Remove image"><i class="fas fa-times"></i></a>
                                @endif

                                <div class="form-group text-center">
                                    <label><b>Featured Image</b></label>
                                    <div class="custom-file text-left">
                                        <input type="file" class="custom-file-input image_upload" name="image" accept="image/*">
                                        <label class="custom-file-label">Choose file...</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label><b>Meta title</b></label>

                            <input type="text" class="form-control form-control-sm" name="meta_title" value="{{old('meta_title') ?? $fundRaiser->meta_title}}">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label><b>Meta description</b></label>

                            <input type="text" class="form-control form-control-sm" name="meta_description" value="{{old('meta_description') ?? $fundRaiser->meta_description}}">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label><b>Meta tags</b></label>

                            <input type="text" class="form-control form-control-sm" name="meta_tags" value="{{old('meta_tags') ?? $fundRaiser->meta_tags}}">
                        </div>
                    </div>
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
    <script type="text/javascript" src="{{asset('back/js/app.js')}}"></script>
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
