@extends('back.layouts.master')
@section('title', 'Create Reunion')

@section('head')
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('master')
<form action="{{route('back.reunions.store')}}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="row">
        <div class="col-md-8">
            <div class="card border-light mt-3 shadow">
                <div class="card-header">
                    <a href="{{route('back.reunions.index')}}" class="btn btn-success btn-sm"><i class="fas fa-angle-double-left"></i> View All</a>
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
                                <label><b>Date*</b></label>
                                <input id="event_date" name="date" required>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label><b>Description*</b></label>

                                <textarea id="editor" class="form-control form-control-sm" name="description" cols="30" rows="3" required>{{old('description')}}</textarea>
                            </div>
                        </div>
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
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>

    <!-- CK Editor -->
    <script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>

    <script>
        $('#event_date').datetimepicker({ footer: true, modal: true });

        // let date = new Date()
        // let date = "{{ Carbon\Carbon::now() }}" //new Date()
        let date = "{{ Carbon\Carbon::parse(now())->format('H:i m/d/Y') }}"
        // let event_data = date.getFullYear()+"-"+"0"+date.getMonth()+"-"+"0"+date.getDay()
        $('#event_date').val(date)
    </script>

    <script>
        // CKEditor
        $(function () {
            CKEDITOR.replace('editor', {
                height: 400
            });
        });
    </script>
@endsection
