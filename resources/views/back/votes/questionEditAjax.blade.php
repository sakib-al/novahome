<input type="hidden" name="question_id" value="{{$question->id}}"><div class="form-group">
    <label><b>Question Type*</b></label>
    <div class="form-check form-check">
        <input class="form-check-input" type="radio" name="type" id="edit_nlineRadio1" value="Yes/No" {{($question->type == "Yes/No" ? "checked" : "")}}>
        <label class="form-check-label" for="edit_nlineRadio1">Yes/No</label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="type" id="edit_nlineRadio2" value="Input" {{($question->type == "Input" ? "checked" : "")}}>
        <label class="form-check-label" for="edit_nlineRadio2">Input</label>
    </div>
    <br />
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="type" id="edit_nlineRadio3" value="Option" {{($question->type == "Option" ? "checked" : "")}}>
        <label class="form-check-label" for="edit_nlineRadio3">Option</label>
    </div>
</div>

<div class="form-group option_value_group" style="display: {{$question->type != "Option" ? 'none' : 'block'}}">
    <label><b>Option Values</b></label>
    <button class="btn btn-sm btn-success float-right add_option_value_btn" type="button"><i class="fas fa-plus"></i></button>

    <div class="option_value_items">
        @foreach ($question->options_arr as $option)
            <div class="input-group mt-1">
                <div class="input-group-prepend">
                <button type="button" class="btn btn-danger remove_option_value" type="button"><i class="fas fa-trash" aria-hidden="true"></i></button>
                </div>

                <input type="text" name="option_value[]" class="form-control fix-rounded-right" value="{{$option}}" placeholder="Name of Kid">
            </div>
        @endforeach
    </div>
</div>

<div class="form-group">
    <label><b>Question Title*</b></label>

    <input type="text" class="form-control" name="question" value="{{$question->question}}" required>
</div>
