@extends('back.layouts.master')
@section('title', 'Section Update')

@section('head')
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" />
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.4/summernote.css" rel="stylesheet">
    <style>
        .moveContent {
        }
        .moveContent li {
            border: 1px solid #ddd;
            background: #717384;
            color: #fff;
            padding: 5px 12px;
            margin: 7px 0;
            border-radius: 3px;
            transition: .1s;
        }
        .moveContent li img {
            height: 80px;
        }
        .moveContent li:hover {
            cursor: pointer
        }
        .editImageBox {
            position: relative;
        }
        .editImageBox .delete {
            position: absolute;
            top: 5px;
            right: 7px;
            font-size: 27px;
            color: #E02D1B;
            z-index: 99;
        }
        .editImageBox .edit {
            position: absolute;
            top: 50px;
            right: 7px;
            font-size: 27px;
            color: #258391;
            z-index: 99;
        }
        .editImageBox .delete:hover, .editImageBox .edit:hover {
            cursor: pointer;
            color: #161711;
        }
    </style>
@endsection
@php
    $optional_designs=[2,3,6];
@endphp
@section('master')
<div class="row">
        <div class="col-sm-9">
            <div class="card-header">
                <a href="{{route('back.frontend.section')}}" class="btn btn-success btn-sm"><i class="fas fa-angle-double-left"></i> Back</a>
            </div>

            <section-update-main-component :home_section="{{ $homeSection }}" image_path="{{ $homeSection->img_paths['original'] }}" app_url="{{env('APP_URL')}}"></section-update-main-component>
        </div>
    <div class="col-sm-3">
        <form action="javascript:void(0)" method="post">
            @csrf
            <div class="card border-light mt-3 shadow">
                <div class="card-body">
                    <ul class="moveContent npnls">
                        @foreach($sliders as $slider)
                            <li class="{{$slider->id}}">
                                <i class="fa fa-arrows-alt"></i>

                                @if($slider->image)
                                    <img src="{{ $slider->img_paths['original'] }}" alt="">
                                @endif
                                <input type="hidden" name="position[]" value="{{$slider->id}}">

                                <div class="float-right">
                                    <a class="btn btn-success btn-sm" href="{{route('back.frontend.section.edit', $slider->id)}}" style="color:#fff"><i class="fa fa-edit"></i></a>

                                    {{-- <form class="d-inline-block" action="{{route('back.sliders.destroy', $slider->id)}}" method="POST">
                                        @method('DELETE')
                                        @csrf

                                    </form> --}}
                                    <a href="{{route('back.frontend.section.remove', $slider->id)}}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to remove?')"><i class="fas fa-trash"></i></a>
                                </div>
                                @if(!$slider->image)
                                    <p class="ml-5">{{ $slider->section_name }}</p>
                                @endif
                                {{-- <a href="{{route('back.sliders.store', $slider->id)}}" onclick="return confirm('Are you sure to remove?')" style="color:red"><i class="fa fa-trash"></i></a> --}}
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="card-footer">
                    <button type="button" class="btn btn-success" onclick="positionUpdate()">Update position</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('footer')
    <script type="text/javascript" src="{{asset('back/js/app.js')}}"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="https://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <!-- include summernote css/js-->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.4/summernote.js"></script>
    <script src="{{asset('back/js/jquery-sortable.js')}}"></script>
    <script>
        $(function () {
            $(".moveContent").sortable();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.summernote').summernote({
                height: 200,
            });
        });
        function positionUpdate(){
            var ids = $("input[name='position[]']")
                .map(function(){return $(this).val();}).get();
            $.ajax({
                url: '{{route("back.frontend.section.position.update")}}',
                method: 'POST',
                data: {ids, _token: '{{csrf_token()}}'},
                success: function(result){
                    if(result.status ==='success') cAlert('success', result.message);
                    else {
                        cAlert('error', 'Invalid request try again');
                        window.location.reload();
                    }
                },
                error: function(){
                    cAlert('error', 'Invalid request try again');
                    window.location.reload();
                }
            });
        }
    </script>
@endsection
