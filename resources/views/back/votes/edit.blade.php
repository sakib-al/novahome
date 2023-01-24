@extends('back.layouts.master')
@section('title', 'Edit Vote')

@section('master')
<div class="card">
    <div class="card-header">
        <a href="{{route('back.votes.index')}}" class="btn btn-success btn-sm"><i class="fas fa-angle-double-left"></i> View All</a>
        <a href="{{route('back.votes.create')}}" class="btn btn-info btn-sm"><i class="fas fa-plus"></i> Create</a>
        <a href="{{route('back.votes.show', $vote->id)}}" class="btn btn-warning btn-sm"><i class="fas fa-eye"></i> View Result</a>

        <form class="d-inline-block" action="{{route('back.votes.destroy', $vote->id)}}" method="POST">
            @method('DELETE')
            @csrf

            <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Are you sure to remove?')"><i class="fas fa-trash"></i> Delete</button>
        </form>
    </div>
</div>

<form action="{{route('back.votes.update', $vote->id)}}" method="POST" enctype="multipart/form-data">
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
                                <input type="text" class="form-control" name="title" value="{{old('title') ?? $vote->title}}" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><b>Short Description</b></label>

                                <textarea class="form-control" name="short_description" cols="30" rows="5">{{old('short_description') ?? $vote->short_description}}</textarea>
                            </div>
                        </div>

                        {{-- <div class="col-md-12">
                            <div class="form-group">
                                <label><b>Description</b></label>

                                <textarea id="editor" class="form-control" name="description" cols="30" rows="3">{{old('description') ?? $vote->description}}</textarea>
                            </div>
                        </div> --}}
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
                                    <img class="img-thumbnail uploaded_img" src="{{$vote->img_paths['small']}}">

                                    @if($vote->media_id)
                                    <a href="{{route('back.votes.removeImage', $vote->id)}}" onclick="return confirm('Are you sure to remove?');" class="btn btn-sm btn-danger remove_image" title="Remove image"><i class="fas fa-times"></i></a>
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

                        {{-- <div class="col-md-12">
                            <div class="form-group">
                                <label><b>Meta title</b></label>

                                <input type="text" class="form-control" name="meta_title" value="{{old('meta_title') ?? $vote->meta_title}}">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label><b>Meta description</b></label>

                                <input type="text" class="form-control" name="meta_description" value="{{old('meta_description') ?? $vote->meta_description}}">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label><b>Meta tags</b></label>

                                <input type="text" class="form-control" name="meta_tags" value="{{old('meta_tags') ?? $vote->meta_tags}}">
                            </div>
                        </div> --}}
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


<div class="row mt-4">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header">
                <h5>Questions</h5>
            </div>

            <div class="card-body table-responsive">
                <table class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            <th>SL.</th>
                            <th>Question</th>
                            <th>Type</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($vote->Questions as $key => $question)
                            <tr>
                                <th>{{$key + 1}}</th>
                                <td>{{$question->question}}</td>
                                <td>{{$question->type}}</td>
                                <td class="text-right">
                                    <button class="btn btn-success btn-sm edit_question_btn" data-toggle="modal" data-id="{{$question->id}}" data-target="#editModal"><i class="fas fa-edit"></i></button>

                                    <a href="{{route('back.votes.questionDelete', $question->id)}}" onclick="return confirm('Are you sure to delete?');" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow">
            <div class="card-header">
                <h5>Create Question</h5>
            </div>

            <form action="{{route('back.votes.questionCreate')}}" method="POST">
                @csrf
                <input type="hidden" name="vote" value="{{$vote->id}}">

                <div class="card-body">
                    <div class="form-group mb-0">
                        <label><b>Question Type*</b></label>
                        <div class="form-check form-check">
                            <input class="form-check-input option_type" type="radio" name="type" id="inlineRadio1" value="Yes/No" checked>
                            <label class="form-check-label" for="inlineRadio1">Yes/No</label>
                        </div>
                    </div>
                    <div class="form-group mb-0">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input option_type" type="radio" name="type" id="inlineRadio2" value="Input">
                            <label class="form-check-label" for="inlineRadio2">Input</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input option_type" type="radio" name="type" id="inlineRadio3" value="Option">
                            <label class="form-check-label" for="inlineRadio3">Option</label>
                        </div>
                    </div>

                    <div class="form-group option_value_group" style="display: none">
                        <label><b>Option Values</b></label>
                        <button class="btn btn-sm btn-success float-right add_option_value_btn" type="button"><i class="fas fa-plus"></i></button>

                        <div class="option_value_items">
                            <div class="input-group mt-1">
                                <div class="input-group-prepend">
                                  <button type="button" class="btn btn-danger remove_option_value" type="button"><i class="fas fa-trash" aria-hidden="true"></i></button>
                                </div>

                                <input type="text" name="option_value[]" class="form-control fix-rounded-right" placeholder="Name of Kid">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label><b>Question Title*</b></label>

                        <input type="text" class="form-control" name="question" value="{{old('question')}}" required>
                    </div>
                </div>

                <div class="card-footer">
                    <button class="btn btn-success">Create</button>
                    <br>
                    <small><b>NB: *</b> marked are required field.</small>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit Question</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <form action="{{route('back.votes.questionUpdate')}}" method="POST">
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
    <!-- CK Editor -->
    <script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>

    <script>
        // CKEditor
        $(function () {
            CKEDITOR.replace('editor', {
                height: 200,
                filebrowserUploadUrl: "{{route('imageUpload')}}?",
                disableNativeSpellChecker : false,
            });
        });

        $(document).on('click', '.edit_question_btn', function(){
            let id = $(this).data('id');

            cLoader();
            $.ajax({
                url: '{{route("back.votes.questionEditAjax")}}',
                method: 'POST',
                data: {id, _token: '{{csrf_token()}}'},
                success: function(result){
                    cLoader('hide');

                    $('.edit_content').html(result);
                },
                error: function(){
                    cLoader('hide');
                },
            });
        });

        // Add input
        $(document).on('click', '.add_option_value_btn', function(){
            let html = '<div class="input-group mt-1">'+
                            '<div class="input-group-prepend">'+
                                '<button type="button" class="btn btn-danger remove_option_value" type="button"><i class="fas fa-trash" aria-hidden="true"></i></button>'+
                            '</div>'+

                            '<input type="text" name="option_value[]" class="form-control fix-rounded-right" placeholder="Name of Kid">'+
                        '</div>';
            $(this).closest('.form-group').find('.option_value_items').append(html);
        });

        $(document).on('click', '.remove_option_value', function(){
            $(this).closest('.input-group').remove();
        });

        $(document).on('click', '.option_type', function(){
            let option_type = $(this).val();

            if(option_type == 'Option'){
                $('.option_value_group').show();
            }else{
                $('.option_value_group').hide();
            }
        });
    </script>
@endsection
