@extends('back.layouts.master')
@section('title', 'Edit Event')

@section('head')
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('master')

<div class="card">
    <div class="card-header">
        <a href="{{route('back.events.index')}}" class="btn btn-success btn-sm"><i class="fas fa-angle-double-left"></i> View All</a>
        <a href="{{route('back.events.create')}}" class="btn btn-info btn-sm"><i class="fas fa-plus"></i> Create</a>

        <form class="d-inline-block" action="{{route('back.events.destroy', $event->id)}}" method="POST">
            @method('DELETE')
            @csrf

            <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Are you sure to remove?')"><i class="fas fa-trash"></i> Delete</button>
        </form>
    </div>
</div>

<form action="{{route('back.events.update', $event->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PATCH')

    <div class="row">
        <div class="col-md-12">
            <div class="card border-light mt-3 shadow">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-body">
                                <div class="">
                                    <div class="img_group">
                                        <img class="img-thumbnail uploaded_img" src="{{$event->img_paths['small']}}">

                                        @if($event->media_id)
                                            <a href="{{route('back.events.removeImage', $event->id)}}" onclick="return confirm('Are you sure to remove?');" class="btn btn-sm btn-danger remove_image" title="Remove image"><i class="fas fa-times"></i></a>
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
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><b>Title*</b></label>
                                <input type="text" class="form-control form-control-sm" name="title" value="{{old('title') ?? $event->title}}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><b>Event Date*</b></label>
                                <input id="event_date" name="date" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><b>Short Description*</b></label>
                                <input type="text" class="form-control form-control-sm" name="short_description" value="{{old('short_description') ?? $event->short_description}}" required>
                            </div>

                            <div class="form-group">
                                <label><b>Description*</b></label>

                                <textarea id="editor" class="form-control form-control-sm" name="description" cols="30" rows="3" required>{{old('description') ?? $event->description }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <join-type-update :join_type="{{ $event->joinType }}"></join-type-update>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-light mt-3 shadow">
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
    <script type="text/javascript" src="{{asset('back/js/app.js')}}"></script>
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>

    <!-- CK Editor -->
    <script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>

    <script>
        $('#event_date').datetimepicker({ footer: true, modal: true });

        // let date = new Date()
        // let date = "{{ Carbon\Carbon::now() }}" //new Date()
        let date = "{{ Carbon\Carbon::parse($event->date)->format('H:i m/d/Y') }}"
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
