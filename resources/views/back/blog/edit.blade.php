@extends('back.layouts.master')
@section('title', 'Edit Blog')

@section('master')
<div class="card">
    <div class="card-header">
        <a href="{{route('back.blogs.index')}}" class="btn btn-success btn-sm"><i class="fas fa-angle-double-left"></i> View All</a>
        <a href="{{route('back.blogs.create')}}" class="btn btn-info btn-sm"><i class="fas fa-plus"></i> Create</a>

        <form class="d-inline-block" action="{{route('back.blogs.destroy', $blog->id)}}" method="POST">
            @method('DELETE')
            @csrf

            <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Are you sure to remove?')"><i class="fas fa-trash"></i> Delete</button>
        </form>
    </div>
</div>

<form action="{{route('back.blogs.update', $blog->id)}}" method="POST" enctype="multipart/form-data">
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
                                <input type="text" class="form-control" name="title" value="{{old('title') ?? $blog->title}}" required>
                            </div>
                        </div>
                         <div class="col-md-12">
                            <div class="form-group">
                                <label><b>Short Description</b></label>

                                <textarea class="form-control" name="short_description" cols="30" rows="3">{{old('short_description') ?? $blog->short_description}}</textarea>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label><b>Description*</b></label>

                                <textarea id="editor" class="form-control" name="description" cols="30" rows="3">{{old('description') ?? $blog->description}}</textarea>
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
                            <img class="img-thumbnail uploaded_img" src="{{$blog->img_paths['small']}}">

                            @if($blog->media_id)
                            <a href="{{route('back.blogs.removeImage', $blog->id)}}" onclick="return confirm('Are you sure to remove?');" class="btn btn-sm btn-danger remove_image" title="Remove image"><i class="fas fa-times"></i></a>
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

                    <div class="form-group">
                        <label>Product category*</label>
                        <select name="category" class="form-control form-control-sm" required>
                            <option value="">Select category</option>

                            @foreach ($categories as $category)
                                <option value="{{$category->id}}" {{$category->id == $blog->category_id ? 'selected' : ''}}>{{$category->title}}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- {{dd($blog->video_type)}} --}}

                    <div class="form-group">
                        <label class="d-block"><b>Video</b></label>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input video_radio" type="radio" name="video_type" id="video_type_1" value="File" {{$blog->video_type == 'File' ? 'checked' : ''}}>

                            <label class="form-check-label" for="video_type_1">File</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input video_radio" type="radio" name="video_type" id="video_type_2" value="Embade Code" {{$blog->video_type == 'Embade Code' ? 'checked' : ''}}>

                            <label class="form-check-label" for="video_type_2">Embade Code</label>
                        </div>

                        <input type="file" name="video" accept="video/*" class="video_input mt-2" style="{{$blog->video_type == 'Embade Code' ? 'display: none' : ''}}">

                        <textarea name="video_embade_code" class="form-control mt-2 video_embade_code" cols="30" rows="5" placeholder="Video embade code" style="{{$blog->video_type == 'File' ? 'display: none' : ''}}">{{old('video_embade_code') ?? $blog->video_embade_code}}</textarea>

                        @if($blog->video_type == 'File')
                        <video style="width: 100%;height:auto;" class="mt-2" controls controlsList="nodownload">
                            <source src="{{$blog->video_path}}" type="video/mp4">
                        </video>
                        @endif
                    </div>

                    <div class="row">
                        {{-- <div class="col-md-12">
                            <div class="form-group">
                                <label><b>Image</b></label>
                                <input type="file" class="form-control" name="image" accept="image/*">

                                <br>
                                <img src="{{$blog->img_paths['small']}}" style="width: 120px">
                            </div>

                            <hr>
                        </div> --}}

                        <div class="col-md-12">
                            <div class="form-group">
                                <label><b>Meta title</b></label>

                                <input type="text" class="form-control" name="meta_title" value="{{old('meta_title') ?? $blog->meta_title}}">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label><b>Meta description</b></label>

                                <input type="text" class="form-control" name="meta_description" value="{{old('meta_description') ?? $blog->meta_description}}">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label><b>Meta tags</b></label>

                                <input type="text" class="form-control" name="meta_tags" value="{{old('meta_tags') ?? $blog->meta_tags}}">
                            </div>
                        </div>
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

