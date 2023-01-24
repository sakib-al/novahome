@extends('back.layouts.master')
@section('title', 'Create blog')

@section('master')
<form action="{{route('back.blogs.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
<div class="row">
    <div class="col-md-8">
        <div class="card border-light mt-3 shadow">
            <div class="card-header">
                <a href="{{route('back.blogs.index')}}" class="btn btn-success btn-sm"><i class="fas fa-angle-double-left"></i> View All</a>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label><b>Title*</b></label>
                            <input type="text" class="form-control form-control-sm" name="title" value="{{old('title')}}" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label><b>Short Description</b></label>

                            <textarea class="form-control form-control-sm" name="short_description" cols="30" rows="3">{{old('short_description')}}</textarea>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label><b>Description*</b></label>

                            <textarea id="editor" class="form-control form-control-sm" name="description" cols="30" rows="3">{{old('description')}}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-light mt-3 shadow">
            <div class="card-body">
                <div class="text-center">
                    <div class="img_group">
                        <img class="img-thumbnail uploaded_img" src="{{env('AWS_URL').'/img/default-img.png'}}">

                        <div class="form-group text-center">
                            <label><b>Featured Image</b></label>
                            <div class="custom-file text-left">
                                <input type="file" class="custom-file-input image_upload" name="image" accept="image/*">
                                <label class="custom-file-label">Choose file...</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label><b>Blog category*</b></label>
                    <select name="category" class="form-control form-control-sm" required>
                        <option value="" disabled selected>Select category</option>

                        @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->title}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="d-block"><b>Video</b></label>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input video_radio" type="radio" name="video_type" id="video_type_1" value="File" checked>

                        <label class="form-check-label" for="video_type_1">File</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input video_radio" type="radio" name="video_type" id="video_type_2" value="Embade Code">

                        <label class="form-check-label" for="video_type_2">Embade Code</label>
                    </div>

                    <input type="file" name="video" accept="video/*" class="video_input mt-2">

                    <textarea name="video_embade_code" class="form-control mt-2 video_embade_code" style="display: none" cols="30" rows="5" placeholder="Video embade code">{{old('video_embade_code')}}</textarea>
                </div>

                <div class="row">
                    {{-- <div class="col-md-12">
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <img class="img-thumbnail uploaded_img" src="{{asset('img/default-img.png')}}">

                                <div class="form-group text-center">
                                    <label><b>Featured image</b></label>
                                    <div class="custom-file text-left">
                                        <input type="file" class="custom-file-input image_upload" accept="image/*" name="image">
                                        <label class="custom-file-label">Choose file...</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                    <div class="col-md-12">
                        <div class="form-group">
                            <label><b>Meta title</b></label>

                            <input type="text" class="form-control form-control-sm" name="meta_title" value="{{old('meta_title')}}">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label><b>Meta description</b></label>

                            <input type="text" class="form-control form-control-sm" name="meta_description" value="{{old('meta_description')}}">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label><b>Meta tags</b></label>

                            <input type="text" class="form-control form-control-sm" name="meta_tags" value="{{old('meta_tags')}}">
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
    <!-- CK Editor -->
    <script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>

    {{-- <!-- Select 2 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script> --}}

    <script>
        // CKEditor
        $(function () {
            CKEDITOR.replace('editor', {
                height: 400
            });
        });

        $(document).on('click', '.video_radio', function(){
            let video_type = $(this).val();

            if(video_type == 'File'){
                $('.video_input').show();
                $('.video_embade_code').hide();
            }else{
                $('.video_input').hide();
                $('.video_embade_code').show();
            }
        });
    </script>
@endsection
