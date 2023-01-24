<input type="hidden" name="input_id" value="{{$input->id}}">

<div class="form-group">
    <label><b>Input Name*</b></label>
    <input class="form-control" type="text" name="name" value="{{$input->name}}" required>
</div>
<div class="form-group">
    <label><b>Input Type*</b></label>
    <select class="form-control input_type" name="type" required>
        <option value="Input" {{$input->type == 'Input' ? 'selected' : ''}}>Input</option>
        <option value="Option" {{$input->type == 'Option' ? 'selected' : ''}}>Option</option>
        <option value="Radio" {{$input->type == 'Radio' ? 'selected' : ''}}>Radio</option>
        <option value="Big Input" {{$input->type == 'Big Input' ? 'selected' : ''}}>Big Input</option>
    </select>
</div>

<div class="input_option" style="display: {{($input->type == 'Input' || $input->type == 'Big Input') ? 'none' : ''}}">
    <div class="form-group">
        <label><b>Input Option*</b> <i class="fas fa-plus text-success addOption"></i></label>

        <div class="input_option_list">
            @foreach ($input->options_arr as $key => $option)
                <div class="input-group mb-2">
                    <input class="form-control" type="text" name="option[]" placeholder="Option Name*" value="{{$option}}">

                    @if($key > 0)
                    <div class="input-group-append">
                        <span class="input-group-btn">
                            <button class="btn btn-danger input_group_btn remove_option" type="button" title="Remove Ootion">
                            <i class="fas fa-times"></i></button>
                        </span>
                    </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</div>
