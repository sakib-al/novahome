@extends('back.layouts.master')
@section('title', 'Edit Slider')

@section('master')
<form action="{{route('back.sliders.update', $slider->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PATCH')

    <div class="card border-light mt-3 shadow">
        <div class="card-header">
            <a href="{{route('back.sliders.index')}}" class="btn btn-success btn-sm"><i class="fas fa-angle-double-left"></i> Back</a>
        </div>
        <slider-update :slider="{{$slider}}" img_path="{{$slider->img_paths['medium']}}" video_path="{{ $slider->video_path }}" app_url="{{env('APP_URL')}}"></slider-update>
        <div class="card-footer">
            <button class="btn btn-success">Update</button>
            <br>
            <small><b>NB: *</b> marked are required field.</small>
        </div>
    </div>
</form>

@endsection
@section('footer')
    <script type="text/javascript" src="{{asset('back/js/app.js')}}"></script>
@endsection
