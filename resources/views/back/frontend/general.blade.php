@extends('back.layouts.master')
@section('title', 'General settings')

@section('master')
<form action="{{route('back.frontend.general')}}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="card border-light mt-3 shadow mb-5">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                <div class="nav flex-column nav-pills left_tab_nav" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active" id="v-pills-WebInfo-tab" data-toggle="pill" href="#v-pills-WebInfo" role="tab" aria-controls="v-pills-WebInfo" aria-selected="true">Web Info</a>
                    <a class="nav-link" id="v-pills-LogoFavicon-tab" data-toggle="pill" href="#v-pills-LogoFavicon" role="tab" aria-controls="v-pills-LogoFavicon" aria-selected="false">Lofo & Favicons</a>

                    <a class="nav-link" id="v-pills-SEO-tab" data-toggle="pill" href="#v-pills-SEO" role="tab" aria-controls="v-pills-SEO" aria-selected="false">SEO</a>
                    <a class="nav-link" id="v-pills-SocialLinks-tab" data-toggle="pill" href="#v-pills-SocialLinks" role="tab" aria-controls="v-pills-SocialLinks" aria-selected="false">Social Links</a>
                </div>
                </div>

                <div class="col-md-8">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-WebInfo" role="tabpanel" aria-labelledby="v-pills-WebInfo-tab">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label col-form-label-sm"><b>Website Title*: </b></label>
                            <div class="col-sm-8">
                            <input type="text" class="form-control form-control-sm"name="title" value="{{$settings_g['title'] ?? env('APP_NAME')}}" placeholder="Website Title" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label col-form-label-sm"><b>Slogan*: </b></label>
                            <div class="col-sm-8">
                            <input type="text" class="form-control form-control-sm" name="slogan" value="{{$settings_g['slogan'] ?? ''}}" placeholder="Website Slogan" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label col-form-label-sm"><b>Number*: </b></label>
                            <div class="col-sm-8">
                            <input type="number" class="form-control form-control-sm" placeholder="Mobile Number" name="mobile_number" value="{{$settings_g['mobile_number'] ?? ''}}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label col-form-label-sm"><b>Email Address*: </b></label>
                            <div class="col-sm-8">
                            <input type="email" class="form-control form-control-sm" placeholder="Email Address" name="email" value="{{$settings_g['email'] ?? ''}}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label col-form-label-sm"><b>Tel: </b></label>
                            <div class="col-sm-8">
                            <input type="number" class="form-control form-control-sm" placeholder="Tel" name="tel" value="{{$settings_g['tel'] ?? ''}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label col-form-label-sm"><b>Copyright*: </b></label>
                            <div class="col-sm-8">
                            <input type="text" class="form-control form-control-sm" placeholder="Copyright" name="copyright" value="{{$settings_g['copyright'] ?? ''}}" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><b>City*</b></label>
                                            <input type="text" class="form-control form-control-sm" name="city" value="{{$settings_g['city'] ?? ''}}" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><b>State*</b></label>
                                            <input type="text" class="form-control form-control-sm" name="state" value="{{$settings_g['state'] ?? ''}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><b>Country*</b></label>
                                            <input type="text" class="form-control form-control-sm" name="country" value="{{$settings_g['country'] ?? ''}}" required="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><b>Zip*</b></label>
                                            <input type="text" class="form-control form-control-sm" name="zip" value="{{$settings_g['zip'] ?? ''}}">
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label><b>Street*</b></label>
                                            <input type="text" class="form-control form-control-sm" name="street" value="{{$settings_g['street'] ?? ''}}" required="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="v-pills-LogoFavicon" role="tabpanel" aria-labelledby="v-pills-LogoFavicon-tab">
                        <div class="row">
                            <div class="col-md-10">
                                <div class="row">
                                    <div class="col-md-4 text-center">
                                        <div class="img_group">
                                            <img class="img-thumbnail uploaded_img" style="width: 70%;" src="{{$settings_g['logo'] ?? env('AWS_URL').'/img/default-img.png'}}">

                                            <div class="form-group">
                                                <label><b>Logo</b></label>
                                                <div class="custom-file text-left">
                                                    <input type="file" class="custom-file-input image_upload" accept="image/*" name="logo">
                                                    <label class="custom-file-label">Choose file...</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 text-center">
                                        <div class="img_group">
                                            <img class="img-thumbnail uploaded_img_favicon" style="width: 70%;" src="{{$settings_g['favicon'] ??  asset('/img/default-img.png')}}">

                                            <div class="form-group">
                                                <label><b>Favicon</b></label>
                                                <div class="custom-file text-left">
                                                    <input type="file" class="custom-file-input image_upload_favicon" accept="image/*" name="favicon">
                                                    <label class="custom-file-label">Choose file...</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 text-center">
                                        <div class="img_group">
                                            <img class="img-thumbnail uploaded_img_og" style="width: 70%;" src="{{$settings_g['og_image'] ?? env('AWS_URL').'/img/default-img.png'}}">

                                            <div class="form-group">
                                                <label><b>OG Image</b></label>
                                                <div class="custom-file text-left">
                                                    <input type="file" class="custom-file-input image_upload_og" name="og_image">
                                                    <label class="custom-file-label">Choose file...</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="v-pills-Shop" role="tabpanel" aria-labelledby="v-pills-Shop-tab">
                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label col-form-label-sm"><b>Tax: </b></label>
                                    <div class="col-sm-4">
                                    <input type="number" class="form-control form-control-sm" placeholder="Tax" name="tax" value="{{$settings_g['tax'] ?? ''}}">
                                    </div>

                                    <div class="col-sm-4">
                                        <select name="tax_type" class="form-control form-control-sm">
                                            <option value="Fixed" {{($settings_g['tax_type'] ?? '') == 'Fixed' ? 'selected' : ''}}>Fixed</option>
                                            <option value="Percent" {{($settings_g['tax_type'] ?? '') == 'Percent' ? 'selected' : ''}}>Percent</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label col-form-label-sm"><b>Currency: </b></label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control form-control-sm" placeholder="Currency name" name="currency_name" value="{{$settings_g['currency_name'] ?? ''}}">
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control form-control-sm" placeholder="Currency symbol" name="currency_symbol" value="{{$settings_g['currency_symbol'] ?? ''}}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label col-form-label-sm"><b>Shipping Charge: </b></label>
                                    <div class="col-sm-8">
                                    <input type="number" class="form-control form-control-sm" placeholder="Shipping Charge" name="shipping_charge" value="{{$settings_g['shipping_charge'] ?? ''}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="v-pills-SEO" role="tabpanel" aria-labelledby="v-pills-SEO-tab">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label col-form-label-sm"><b>Meta Description: </b></label>
                            <div class="col-sm-8">
                            <input type="text" class="form-control form-control-sm" placeholder="Meta Description" name="meta_description" value="{{$settings_g['meta_description'] ?? ''}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label col-form-label-sm"><b>Keywords: </b></label>
                            <div class="col-sm-8">
                            <input type="text" class="form-control form-control-sm" placeholder="Keywords" name="keywords" value="{{$settings_g['keywords'] ?? ''}}">
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-SocialLinks" role="tabpanel" aria-labelledby="v-pills-SocialLinks-tab">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label col-form-label-sm"><b>Facebook: </b></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" placeholder="Facebook" name="facebook" value="{{Info::Settings('social', 'facebook') ?? ''}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label col-form-label-sm"><b>Twitter: </b></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" placeholder="Twitter" name="twitter" value="{{Info::Settings('social', 'twitter') ?? ''}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label col-form-label-sm"><b>Youtube: </b></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" placeholder="Youtube" name="youtube" value="{{Info::Settings('social', 'youtube') ?? ''}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label col-form-label-sm"><b>Instagram: </b></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" placeholder="Instagram" name="instagram" value="{{Info::Settings('social', 'instagram') ?? ''}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label col-form-label-sm"><b>LinkedIn: </b></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" placeholder="LinkedIn" name="linkedin" value="{{Info::Settings('social', 'linkedin') ?? ''}}">
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <button class="btn btn-success create_btn">Update</button>
            <br>
            <small><b>NB: *</b> marked are required field.</small>
        </div>
    </div>
</form>
@endsection

@section('footer')
<script>
    // Uploaded image get url
    function readURLFavicon(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.uploaded_img_favicon').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $(".image_upload_favicon").change(function(){
        readURLFavicon(this);
    });

    // // Uploaded image get url
    // function readURLFavicon(input) {
    //     if (input.files && input.files[0]) {
    //         var reader = new FileReader();
    //         reader.onload = function (e) {
    //             $('.uploaded_img_hb_image').attr('src', e.target.result);
    //         }
    //         reader.readAsDataURL(input.files[0]);
    //     }
    // }
    // $(".image_upload_hb_image").change(function(){
    //     readURLFavicon(this);
    // });

    function readURLog(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.uploaded_img_og').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $(".image_upload_og").change(function(){
        readURLog(this);
    });
</script>
@endsection
