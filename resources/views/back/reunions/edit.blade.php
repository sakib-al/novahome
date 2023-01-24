@extends('back.layouts.master')
@section('title', 'Edit Reunion')

@section('head')
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

<style>
    .addOption:hover{cursor: pointer;}
</style>
@endsection

@section('master')
<div class="card">
    <div class="card-header">
        <a href="{{route('back.reunions.index')}}" class="btn btn-success btn-sm"><i class="fas fa-angle-double-left"></i> View All</a>
        <a href="{{route('back.reunions.create')}}" class="btn btn-info btn-sm"><i class="fas fa-plus"></i> Create</a>

        <form class="d-inline-block" action="{{route('back.reunions.destroy', $reunion->id)}}" method="POST">
            @method('DELETE')
            @csrf

            <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Are you sure to remove?')"><i class="fas fa-trash"></i> Delete</button>
        </form>
    </div>
</div>

<form action="{{route('back.reunions.update', $reunion->id)}}" method="POST" enctype="multipart/form-data">
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
                                <input type="text" class="form-control form-control-sm" name="title" value="{{old('title') ?? $reunion->title}}" required>
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

                                <textarea id="editor" class="form-control form-control-sm" name="description" cols="30" rows="3" required>{{old('description') ?? $reunion->title}}</textarea>
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
                            <img class="img-thumbnail uploaded_img" src="{{$reunion->img_paths['small']}}">

                            @if($reunion->media_id)
                            <a href="{{route('back.reunions.removeImage', $reunion->id)}}" onclick="return confirm('Are you sure to remove?');" class="btn btn-sm btn-danger remove_image" title="Remove image"><i class="fas fa-times"></i></a>
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
                <div class="card-footer">
                    <button class="btn btn-success btn-block">Update</button>
                    <small><b>NB: *</b> marked are required field.</small>
                </div>
            </div>
        </div>
    </div>
</form>

<div class="row">
    <div class="col-md-8">
        <div class="card border-light mt-3 shadow">
            <div class="card-header">
                <h5 class="d-inline-block">Form Inputs</h5>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered table-sm" id="dataTable">
                    <thead>
                      <tr>
                        <th scope="col">SL.</th>
                        <th scope="col">Nmae</th>
                        <th scope="col">Input Type</th>
                        <th scope="col" class="text-right">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($reunion->ReunionInputs as $key => $input)
                            <tr>
                                <th scope="row">{{$key + 1}}</th>
                                <td>{{$input->name}}</td>
                                <td>{{$input->type}}</td>
                                <td class="text-right">
                                    <button class="btn btn-sm btn-success edit_input" type="button" data-id="{{$input->id}}" data-toggle="modal" data-target="#editInputModal"><i class="fas fa-edit"></i></button>

                                    <a class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to delete?');" href="{{route('back.reunions.inputDelete', $input->id)}}"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-light mt-3 shadow">
            <div class="card-header">
                <h5 class="d-inline-block">Create Input Field</h5>
            </div>
            <form action="{{route('back.reunions.inputCreate', $reunion->id)}}" method="POST">
                @csrf

                <div class="card-body">
                    <div class="form-group">
                        <label><b>Input Name*</b></label>
                        <input class="form-control" type="text" name="name" value="{{old('name')}}" required>
                    </div>

                    <div class="form-group">
                        <label><b>Input Type*</b></label>
                        <select class="form-control input_type" name="type" required>
                            <option value="Input">Input</option>
                            <option value="Option">Option</option>
                            <option value="Radio">Radio</option>
                            <option value="Big Input">Big Input</option>
                        </select>
                    </div>

                    <div class="input_option" style="display: none">
                        <div class="form-group">
                            <label><b>Input Option*</b> <i class="fas fa-plus text-success addOption"></i></label>

                            <div class="input_option_list">
                                <div class="input-group mb-2">
                                    <input class="form-control" type="text" name="option[]" placeholder="Option Name*">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button class="btn btn-success btn-block">Create</button>
                    <small><b>NB: *</b> marked are required field.</small>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Input Modal -->
<div class="modal fade" id="editInputModal" tabindex="-1" role="dialog" aria-labelledby="editInputModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editInputModalLabel">Edit Input</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <form action="{{route('back.reunions.inputUpdate')}}" method="POST">
            @csrf

            <div class="modal-body edit_content">

            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-success">Update</button>
            </div>
        </form>
      </div>
    </div>
</div>
@endsection

@section('footer')
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>

    <!-- CK Editor -->
    <script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>

    <script>
        $('#event_date').datetimepicker({ footer: true, modal: true });

        // let date = new Date()
        // let date = "{{ Carbon\Carbon::now() }}" //new Date()
        let date = "{{ Carbon\Carbon::parse($reunion->date)->format('H:i m/d/Y') }}"
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

        $(document).on('click', '.addOption', function(){
            let html = '<div class="input-group mb-2">' +
                            '<input class="form-control" type="text" name="option[]" placeholder="Option Name*" required>' +

                            '<div class="input-group-append">' +
                                '<span class="input-group-btn">' +
                                    '<button class="btn btn-danger input_group_btn remove_option" type="button" title="Remove Ootion">' +
                                    '<i class="fas fa-times"></i></button>' +
                                '</span>' +
                            '</div>' +
                        '</div>';

            $(this).closest('form').find('.input_option_list').append(html);
        });

        $(document).on('click', '.remove_option', function(){
            $(this).closest('.input-group').remove();
        });

        $(document).on('change', '.input_type', function(){
            let input_type = $(this).val();

            if(input_type == 'Radio' || input_type == 'Option'){
                $(this).closest('form').find('.input_option').show();
                $(this).closest('form').find('.input_option input').attr('required', 'required');
            }else{
                $(this).closest('form').find('.input_option').hide();
                $(this).closest('form').find('.input_option input').removeAttr('required', 'required');
            }
        });

        $(document).on('click', '.edit_input', function(){
            let id = $(this).data('id');
            cLoader();

            $.ajax({
                url: '{{route("back.reunions.inputEdit")}}',
                method: 'POST',
                data: {id, _token: '{{csrf_token()}}'},
                success: function(result){
                    cLoader('hide');
                    $('.edit_content').html(result);
                },
                error: function(){
                    cLoader('hide');
                    cAlert('error', 'Something wrong!');
                }
            });
        });
    </script>
@endsection
