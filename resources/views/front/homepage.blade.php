@extends('front.layouts.master')
@section('head')
    @include('meta::manager', [
        'title' => ($settings_g['title'] ?? env('APP_NAME')) . ' - ' . ($settings_g['slogan'] ?? '')
    ])

    <link rel="stylesheet" href="{{asset('front/css/owl.carousel.min.css')}}">

    <style>
        #container {
            position:relative;
        }

        #img2 {
            position: absolute;
            top: 5px;
        }
    </style>
@endsection

@section('master')
    <!-- Slider -->
    <section class="slider_and_navbar slider_section">
        <div class="slider_section">
            <div class="slideshow_container">
                @foreach ($sliders as $key => $slider)
                    <div class="mySlides">
                        @if($slider->slider_type==1)
                            <img src="{{$slider->img_paths['original']}}" alt="{{$slider->text_1}}">
                        @elseif($slider->slider_type==2)
                            <video class="img-fluid" autoplay loop muted>
                                <source src="{{ $slider->video_path }}" type="video/mp4" />
                            </video>

                            <!-- <iframe class="embed-responsive-item" autoplay width="100%" height="800px" src="https://www.youtube.com/embed/tgbNymZ7vqY"></iframe>-->
                            <!-- <iframe class="elementor-background-video-embed" frameborder="0" allowfullscreen="1" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" title="YouTube video player"
                            width="100%" height="800px" src="https://www.youtube.com/embed/BY5JR5YwD00?controls=0&amp;rel=0&amp;playsinline=1&amp;enablejsapi=1&amp;origin=https%3A%2F%2Fstylezworld.com&amp;widgetid=1" id="widget2"
                            style="width: 1903px; height: 1070.44px;"></iframe>-->
                        @endif

                        <div class="slider_content_wrap">
                            <div class="container {{($key % 2) ? 'text-right' : ''}}">
                                <div class="slider_content {{($key % 2) ? 'text-right d-inline-block' : ''}}">
                                    <h2>{{$slider->text_1}}</h2>
                                    {{-- <span class="sc_border"></span>
                                    <br> --}}
                                    <p class="text-dark d-none d-md-block">{!!$slider->description!!}</p>
                                    {{-- @if($slider->button_1_text && $slider->button_1_url) --}}
                                        <a href="{{$slider->button_1_url}}" class="btn btn-info btn_slider">{{$slider->button_1_text}}</a>
                                    {{-- @endif --}}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <!-- Carousel wrapper -->

                <div class="slider_dot_container">
                    @foreach ($sliders as $key => $slider)
                        <span class="dot" onclick="currentSlide('{{$key + 1}}')"></span>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- Slider End -->

    @if(count($home_sections))
        @foreach($home_sections as $key=>$sec)
            @if($sec->section_design_type_id==1 && $sec->text_align ==1)
                <section class="content_section_1 py-2 my-5"  style="background-image: url('{{ asset('img/bg2.png') }}');background-color:{{  $sec->background_color }};background-size: cover;background-repeat:no-repeat">
                    <div class="container-fluid">
                        <div class="container" >
                            <div class="content_sec1 pt-0 pb-0" >
                                <div class="row">

                                    <div class="col-md-6">
                                        <div>
                                            <div class="{{$sec->is_image_inner_border?'img_inner_border':''}} card-img-wrap">
                                                <img class="img-fluid " src="{{ $sec->img_paths['original'] }}" alt="">
                                                {{-- <img class="img-fluid " src="https://novahome.stylezworld.net/uploads/2023/01/1673112244.png" alt=""> --}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 position-relative">
                                        <div class="left-border"></div>
                                        <div class="content_sec1_content ml-4">
                                            <h3 class="sec_title text-uppercase">{{ $sec->title }}</h3>

                                            <h3 style="font-weight: 700">{{ $sec->sub_title }}</h3>

                                            <div class="section_content">
                                                <div class="sec1_left_border"></div>
                                                {!! \Illuminate\Support\Str::limit($sec->short_description,500, ' <a href="/">Read More</a>') !!}

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                @elseif($sec->section_design_type_id==1 && $sec->text_align ==2)
                <section class="content_section_1 py-4 mt-4">
                    <div class="container-fluid">
                        <div class="container" >
                            <div class="content_sec1 pt-0 pb-0 pt-md-5 pb-md-5" >
                                <div class="row"  style="{{ $sec->text_align ==2 ? 'background-image: url('.asset('img/bg1.png').');background-color:'.$sec->background_color.';padding: 30px;':''}}">
                                    <div class="col-md-6 position-relative">
                                        <div class="left-border"></div>
                                        <div class="content_sec1_content ml-4">
                                            <h3 class="sec_title text-uppercase">{{ $sec->title }}</h3>
                                            <div class="sec1_top_border"></div>
                                            <h3 style="font-weight: 700">{{ $sec->sub_title }}</h3>

                                            <div class="section_content">
                                                <div class="sec1_left_border"></div>
                                                {!! \Illuminate\Support\Str::limit($sec->short_description,500, ' <a href="/">Read More</a>') !!}

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card-img-wrap">
                                            <img class="img-fluid" src="{{ $sec->img_paths['original'] }}" alt="">
                                            {{-- <img class="img-fluid" src="https://novahome.stylezworld.net/uploads/2023/01/1673112093.png" alt=""> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                {{--text and card section end--}}

                {{--gallery section start --}}
            @elseif($sec->section_design_type_id == 9 && count($gallery_categories) >0)
                <section class="event-area mb-5 mt-5" style="background: {{$sec->background_color}}">
                    <div class="container">
                        <h4 class="text-center">Our <span class="color-blue">Gallery</span></h4>
                        {{-- <ul class="nav nav-pills mb-3 justify-content-center" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active tab_nav_text" id="pills-all-tab" data-toggle="pill" href="#pills-all" role="tab" aria-controls="pills-all" aria-selected="true">All</a>
                            </li>
                            @foreach ($gallery_categories as $key => $gallery_category)
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link tab_nav_text" id="pills-{{$gallery_category->id}}-tab" data-toggle="pill" href="#pills-{{$gallery_category->id}}" role="tab" aria-controls="pills-{{$gallery_category->id}}" aria-selected="true">{{$gallery_category->title}}</a>
                                </li>
                            @endforeach
                        </ul> --}}
                        {{-- <div class="tab-content " id="pills-tabContent"> --}}
                            {{-- <div class="tab-pane fade show active" id="pills-all" role="tabpanel" aria-labelledby="pills-all-tab"> --}}
                                <div class="row mb-4 position-relative">
                                    <div class="corner-borders corner-borders--left"></div>
                                     <div class="corner-borders corner-borders--right"></div>
                                    @foreach (\App\Models\GalleryItem::all() as $galleryImage)
                                        
                                        @php
                                            if(file_exists(public_path("storage/uploads/gallery/medium/$galleryImage->image"))){
                                                $img =  asset("storage/uploads/gallery/small/$galleryImage->image");
                                            }else{
                                                $img =  asset('/img/no-image.png');
                                            }
                                        @endphp
                                        @if($loop->first)
                                        <div class="col-sm-4 p-2 half-border-on-top half-border-on-left">
                                            @else
                                            <div class="col-sm-4 p-2">
                                            @endif
                                            <!-- Rotating card -->
                                            <div class="card-wrapper">
                                                <div id="card-2" class="card card-rotating text-center">
                                                    <!--Front Side-->
                                                    <div class="face front">
                                                        <!-- Image-->
                                                        <div class="view overlay card-img-wrap gallery">
                                                            <img class="card-img-top img-fluid" src="{{ $img }}" alt="Example photo">
                                                            <div class="mask rgba-white-slight gallery-mask">{{ $galleryImage->title??'' }}</div>
                                                            {{-- <a>
                                                            </a> --}}
                                                        </div>
                                                    </div>
                                                    <!--Front Side-->
                                                </div>
                                            </div>
                                            <!-- Rotating card -->
                                        </div>
                                    @endforeach
                                </div>
                                <div class="view-btn text-center mt-2 ">
                                    <div class="text-center">
                                        {{-- <a href="{{route('gallery.all')}}" class="btn btn-default loadMore">Load More</a> --}}
                                        <a href="/" class="btn btn-default loadMore">Load More</a>
                                    </div>
                                </div>
                            </div>
                        {{-- @foreach ($gallery_categories as $key => $gallery_category)
                                <div class="tab-pane fade show" id="pills-{{$gallery_category->id}}" role="tabpanel" aria-labelledby="pills-{{$gallery_category->id}}-tab">
                                    <div class="row mb-4">
                                        @foreach ($gallery_category->GalleryImages() as $galleryImage)
                                            @php
                                                if(file_exists(public_path("uploads/gallery/medium/$galleryImage->image"))){
                                                    $img = asset("uploads/gallery/small/$galleryImage->image");
                                                }else{
                                                    $img = asset('/img/no-image.png');
                                                }
                                            @endphp
                                            <div class="col-sm-4 mb-3">
                                                <!-- Rotating card -->
                                                <div class="card-wrapper">
                                                    <div id="card-2" class="card card-rotating text-center">
                                                        <!--Front Side-->
                                                        <div class="face front">
                                                            <!-- Image-->
                                                            <div class="view overlay card-img-wrap gallery">
                                                                <img class="card-img-top img-fluid" src="{{ $img }}" alt="Example photo">
                                                                <a>
                                                                    <div class="mask rgba-white-slight"></div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <!--Front Side-->
                                                    </div>
                                                </div>
                                                <!-- Rotating card -->
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="view-btn text-center mt-2 ">
                                        <div class="text-center">
                                            <a href="{{route('gallery.all')}}" class="button tn_load_more_btn button_view_all mt-0">View All</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach --}}
                        {{-- </div> --}}
                    {{-- </div> --}}
                </section>
            @endif
        @endforeach
    @endif
@endsection

@section('footer')
    {{-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js " integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB " crossorigin="anonymous "></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js " integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13 " crossorigin="anonymous "></script>
    <script src="//code.jquery.com/jquery-3.1.1.min.js"></script> --}}

    <script type="text/javascript" src="{{asset('back/js/app.js')}}"></script>
    <script src="{{asset('front/assets/js/owl.carousel.min.js')}}"></script>

    <script>
        // Slider
        var slideIndex = 1;
        var slider_timeout;
        function currentSlide(n) {
            slideIndex = n;
            showSlides();
        }
        showSlides();
        function showSlides() {
            clearTimeout(slider_timeout);
            var i;
            var slides = document.getElementsByClassName("mySlides");
            var dots = document.getElementsByClassName("dot");
            if (slideIndex > slides.length){
                slideIndex = 1;
            }
            if (slideIndex < 1) {
                slideIndex = slides.length;
            }
            for (i = 0; i < slides.length; i++) {
                slides[i].classList.remove("active");
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex-1].classList.add("active");
            dots[slideIndex-1].className += " active";
            slideIndex++;
            slider_timeout = setTimeout(showSlides, 5000);
        }


        $(".upcoming_events_items").owlCarousel({
            loop: true,
            margin: 30,
            autoplay: true,
            autoplayHoverPause: true,
            responsiveClass: true,
            nav: true,
            slideBy: 3,
            responsive: {
            0: {
                items: 1,
                nav: true
            },
            600: {
                items: 1,
                nav: true
            },
            1000: {
                items: 2,
                nav: true,
            }
            }
        });
    </script>
@endsection


