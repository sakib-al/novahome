@extends('front.layouts.master')
@php
    $page_title='Gallery';
@endphp
@section('head')
    @include('meta::manager', [
        'title' => 'Gallery - ' . ($settings_g['slogan'] ?? '')
    ])
@endsection

@push('custom_css')
    <!-- Product Box View -->
    <link rel="stylesheet" href="{{ asset('front/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('front/css/product-zoom-box.css') }}" />
@endpush

@section('master')

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 mb-5">
                <div class="position-relative">
                    <div class="corner-borders corner-borders--left"></div>
                    <div class="corner-borders corner-borders--right"></div>
                    {{-- <div class="xzoom-container">

                        <img class="xzoom img-fluid" id="xzoom-default"
                        src="https://www.bigbasket.com/media/uploads/p/l/40200665_2-aabad-desi-ghee.jpg"
                        xoriginal="https://www.bigbasket.com/media/uploads/p/l/40200665_2-aabad-desi-ghee.jpg" />

                        <div class="xzoom-thumbs pt-10">
                          <div class="product-thumb">
                              <a href="https://www.bigbasket.com/media/uploads/p/l/40200665_2-aabad-desi-ghee.jpg">
                                  <img class="xzoom-gallery" width="50"
                                  src="https://www.bigbasket.com/media/uploads/p/l/40200665_2-aabad-desi-ghee.jpg"
                                  xpreview="https://www.bigbasket.com/media/uploads/p/l/40200665_2-aabad-desi-ghee.jpg">
                              </a>

                              <a href="https://www.bigbasket.com/media/uploads/p/l/40200665-2_2-aabad-desi-ghee.jpg">
                                  <img class="xzoom-gallery" width="50" src="https://www.bigbasket.com/media/uploads/p/l/40200665-2_2-aabad-desi-ghee.jpg">
                              </a>

                              <a href="https://www.bigbasket.com/media/uploads/p/l/40200665-3_2-aabad-desi-ghee.jpg">
                                  <img class="xzoom-gallery" width="50" src="https://www.bigbasket.com/media/uploads/p/l/40200665-3_2-aabad-desi-ghee.jpg">
                              </a>

                              <a href="https://www.bigbasket.com/media/uploads/p/l/40200665-4_2-aabad-desi-ghee.jpg">
                                  <img class="xzoom-gallery" width="50" src="https://www.bigbasket.com/media/uploads/p/l/40200665-4_2-aabad-desi-ghee.jpg" title="The description goes here">
                              </a>

                          </div>
                        </div>
                    </div> --}}
                    <div class="img-box p-1">
                        <div class="preview-img">
                            <img class="img-fluid" src="https://novahome.stylezworld.net/uploads/2023/01/1673112244.png" alt="">
                        </div>
                    </div>
                    <div class="img-row mt-3">
                        <div class="img-item">
                            <img class="img-fluid" src="https://novahome.stylezworld.net/uploads/2023/01/1673112244.png" alt="">
                        </div>
                        <div class="img-item">
                            <img class="img-fluid" src="https://novahome.stylezworld.net/uploads/2023/01/1673112244.png" alt="">
                        </div>
                        <div class="img-item">
                            <img class="img-fluid" src="https://novahome.stylezworld.net/uploads/2023/01/1673112244.png" alt="">
                        </div>
                        <div class="img-item">
                            <img class="img-fluid" src="https://novahome.stylezworld.net/uploads/2023/01/1673112244.png" alt="">
                        </div>
                        <div class="img-item">
                            <img class="img-fluid" src="https://novahome.stylezworld.net/uploads/2023/01/1673112244.png" alt="">
                        </div>
                        <div class="img-item">
                            <img class="img-fluid" src="https://novahome.stylezworld.net/uploads/2023/01/1673112244.png" alt="">
                        </div>
                        
                    </div>
                </div>

            </div>
            <div class="col-md-5 mb-5">
                <div class="gallery-detail">
                    <h3>We go beyond the expected Results</h3>
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Soluta quo, temporibus ipsa facere inventore expedita impedit doloribus reiciendis harum deserunt, eum, consequatur tempore aliquid! Odio beatae quibusdam soluta dicta quas!</p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor labore quaerat cum facere provident facilis perspiciatis veniam ullam distinctio sapiente ipsa nisi exercitationem quia, magnam velit blanditiis aliquam harum! Ea.</p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor labore quaerat cum facere provident facilis perspiciatis veniam ullam distinctio sapiente ipsa nisi exercitationem quia, magnam velit blanditiis aliquam harum! Ea.</p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor labore quaerat cum facere provident facilis perspiciatis veniam ullam distinctio sapiente ipsa nisi exercitationem quia, magnam velit blanditiis aliquam harum! Ea.</p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor labore quaerat cum facere provident facilis perspiciatis veniam ullam distinctio sapiente ipsa nisi exercitationem quia, magnam velit blanditiis aliquam harum! Ea.</p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor labore quaerat cum facere provident facilis perspiciatis veniam ullam distinctio sapiente ipsa nisi exercitationem quia, magnam velit blanditiis aliquam harum! Ea.</p>

                </div>
            </div>
        </div>
    </div>

@endsection

@push('custom_js')

    <script src="{{ asset('front/js/product-zoom-box.js') }}"></script>
    <script src="{{ asset('front/js/owl.carousel.min.js') }}"></script>
    <script src='https://unpkg.com/xzoom/dist/xzoom.min.js'></script>
    <script src='https://hammerjs.github.io/dist/hammer.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/foundation/6.3.1/js/foundation.min.js'></script>

    {{-- <script>
        $(".product-thumb").owlCarousel({
            nav: false,
            dots: false,
            margin: 10,
            autoplay: false,
            loop: false,
            responsive:{
                0:{
                    items:4
                },
                600:{
                    items:4
                },
                1000:{
                    items:5
                }
            }
        });
    </script> --}}

@endpush
