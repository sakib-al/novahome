<!doctype html>

<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@php
    $main_menu = App\Models\Menu::with('SingleMenuItems')->where('name', 'Main Menu')->active()->first();
    $footer_menu = App\Models\Menu::with('SingleMenuItems')->where('name', 'Footer')->active()->first();
    $socials = \App\Models\Settings::where(['group'=>'social'])->get();
@endphp
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Icons -->
    <link rel="shortcut icon" href="{{$settings_g['favicon'] ?? ''}}">

    <link rel="stylesheet" href="{{asset('front/css/normalize.css')}}">
    <link rel="stylesheet" href="{{asset('front/css/main.css')}}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.css">

    <link rel="stylesheet" href="https://demos.codexcoder.com/labartisan/html/GreenForest/assets/fonts/flaticon.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('front/assets/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('front/assets/css/custom-style.css')}}?c=2">
    <link rel="stylesheet" href="{{asset('front/css/responsive.css')}}?c=5">

    <!-- fontawesome -->
    <script src="https://kit.fontawesome.com/9c65216417.js" crossorigin="anonymous"></script>
    @yield('head')
</head>

<body>
    @auth
        <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
            @csrf
        </form>
    @endauth

    <div id="header">
        <!-- Top Bar -->
        <section class="top_bar">
            <div class="container-fluid">
                <div class="container">
                    <div class="d-none d-lg-block">
                        <div class="row">
                            <div class="col-md-6"></div>
                            <div class="col-md-6 text-right">
                                <ul class="list-group list-group-horizontal social_icon social_icon_header">
                                    @if(Info::Social($socials, 'facebook'))
                                        <li><a target="_blank" href="{{Info::Social($socials,  'facebook')}}"><i class="fab fa-facebook-f social_icon_color"></i></a></li>
                                    @endif
                                    @if(Info::Social($socials,  'twitter'))
                                        <li><a target="_blank" href="{{Info::Social($socials,  'twitter')}}"><i class="fab fa-twitter social_icon_color"></i></a></li>
                                    @endif
                                    @if(Info::Social($socials, 'youtube'))
                                        <li><a target="_blank" href="{{Info::Social($socials, 'youtube')}}"><i class="fab fa-youtube social_icon_color"></i></a></li>
                                    @endif
                                    @if(Info::Social($socials, 'instagram'))
                                        <li><a target="_blank" href="{{Info::Social($socials, 'instagram')}}"><i class="fab fa-instagram social_icon_color"></i></a></li>
                                    @endif
                                    @if(Info::Social($socials, 'linkedin'))
                                        <li><a target="_blank" href="{{Info::Social($socials, 'linkedin')}}"><i class="fab fa-linkedin social_icon_color"></i></a></li>
                                    @endif
                                </ul>
                            </div>
                            {{-- <div class="col-md-6 text-right pt-1">
                                @guest
                                    <a href="{{route('login')}}" class="top_bar_btn"> Login</a>
                                    <a href="{{route('register')}}" class="top_bar_btn">  Sign Up </a>
                                @else
                                    <a href="{{route('memberDashboard')}}" class="top_bar_btn"> {{auth()->user()->full_name}}</a>
                                    <div class="dropdown">
                                        <button class="dropdown-toggle top_dropdown_btn" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{auth()->user()->full_name}} <i class="fas fa-user"></i></button>

                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="{{route('memberDashboard')}}">Dashboard</a>
                                            <a class="dropdown-item" href="#">Edit Profile</a>
                                            <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                        </div>
                                    </div>
                                @endguest
                            </div> --}}
                        </div>
                    </div>

                    <div class="d-block d-lg-none mobile_header">
                        <div class="row">
                            <div class="col-6">
                                <a href="{{route('homepage')}}" class="mobile_logo"><img src="{{ $settings_g['logo'] ? $settings_g['logo']:'' }}" alt="{{$settings_g['title'] ?? ''}}"></a>
                            </div>

                            <div class="col-6 text-right">
                                <button class="mobile_menu_trigger collapsed" type="button" data-toggle="collapse" data-target="#collapseLeftMenu" aria-expanded="false" aria-controls="collapseLeftMenu">
                                    <i class="fas fa-bars"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Top Bar End-->
        <div id="main_section1" class="d-none d-lg-block">
            <div class="sticky-top">
            {{-- <div class="slider_and_navbar sticky-top"> --}}
                <nav class="navbar navbar-expand-lg navbar-dark nav_white mt-0 pt-0 {{Route::is('homepage') ? 'homepage' : 'other_page'}}" id="nav_id">
                    <div class="container">
                        <a href="{{route('homepage')}}"><img class="custom_logo" src="{{$settings_g['logo'] ?? ''}}" alt="{{$settings_g['title'] ?? ''}}"></a>

                        <div id="main_menu">
                            @if($main_menu)
                                <ul>
                                    <li>
                                        <a href="{{route('homepage')}}" class="animated_btn bt_back nav {{ url('/') == url()->current() ? 'active font_bold' : ''}}">
                                            <span class="ab_bg_left"></span>
                                            <span class="btn-text-wrap">
                                                <span class="btn-text">
                                                    <span class="visibility-hidden">.</span>
                                                    <span class="btn-text-up">Home</span>
                                                </span>
                                            </span>
                                            <span class="ab_bg_right"></span>
                                        </a>
                                    </li>

                                    @foreach ($main_menu->SingleMenuItems as $item)
                                        <li>
                                            <a href="{{$item->menu_info['url']}}" class="animated_btn bt_back nav {{$item->menu_info['url'] == url()->current() ? 'active font_bold' : ''}}">
                                                <span class="ab_bg_left"></span>
                                                <span class="btn-text-wrap">
                                                    <span class="btn-text">
                                                        <span class="visibility-hidden">.</span>
                                                        <span class="btn-text-up">{{$item->menu_info['text']}}</span>
                                                    </span>
                                                </span>
                                                <span class="ab_bg_right"></span>
                                            </a>
                                        </li>
                                    @endforeach

                                    {{-- <li class="animated-button6-wrap">
                                        <a href="{{route('donate.now')}}" class="animated-button6 bt_back nav">
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                            Donate Now
                                        </a>
                                    </li> --}}
                                </ul>
                            @else
                                <p class="text-danger text-right">Please create "Main Menu"</p>
                            @endif
                        </div>
                    </div>
                </nav>
            </div>
        </div>

        <!-- Left Menu -->
        <div id="collapseLeftMenu" class="collapse" aria-labelledby="headingLeftMenu" data-parent="#header">
            <ul class="npnls">
                <li><a href="{{route('homepage')}}">Home</a></li>
                @if($main_menu)
                    @foreach ($main_menu->SingleMenuItems as $item)
                    <li><a href="{{$item->menu_info['url']}}">{{$item->menu_info['text']}}</a></li>
                    @endforeach
                @endif

                {{-- <li><a href="{{route('donate.now')}}">Donate Now</a></li> --}}
            </ul>
        </div>
        <!-- End Left Menu -->
    </div>

    @yield('master')

    <!-- Footer Top -->
    <section class="top_footer bottom">
        <div class="container">
            <div class="row py-5">
                <div class="col-md-3">
                    <div class="footer_widget">
                        <div>
                            <a href="{{route('homepage')}}"><img class="custom_logo" src="{{$settings_g['logo'] ?? ''}}" alt="{{$settings_g['title'] ?? ''}}"></a>
                        </div>
                        <ul class="list-group list-group-horizontal social_icon social_icon_footer">
                            @if(Info::Social($socials, 'facebook'))
                                <li><a target="_blank" href="{{Info::Social($socials,  'facebook')}}"><i class="fab fa-facebook-f social_icon_footer_color"></i></a></li>
                            @endif
                            @if(Info::Social($socials,  'twitter'))
                                <li><a target="_blank" href="{{Info::Social($socials,  'twitter')}}"><i class="fab fa-twitter social_icon_footer_color"></i></a></li>
                            @endif
                            @if(Info::Social($socials, 'youtube'))
                                <li><a target="_blank" href="{{Info::Social($socials, 'youtube')}}"><i class="fab fa-youtube social_icon_footer_color"></i></a></li>
                            @endif
                            @if(Info::Social($socials, 'instagram'))
                                <li><a target="_blank" href="{{Info::Social($socials, 'instagram')}}"><i class="fab fa-instagram social_icon_footer_color"></i></a></li>
                            @endif
                            @if(Info::Social($socials, 'linkedin'))
                                <li><a target="_blank" href="{{Info::Social($socials, 'linkedin')}}"><i class="fab fa-linkedin social_icon_footer_color"></i></a></li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="footer_widget">
                        <div class="about_content">
                            <h6>Contacts</h6>
                            <span>{{$settings_g['street'] ?? ''}}</span><br>
                            <span>{{$settings_g['city'] ?? ''}}-{{$settings_g['zip'] ?? ''}}, {{$settings_g['state'] ?? ''}}, {{$settings_g['country'] ?? ''}}</span><br>
                            <span><b>Phone: {{$settings_g['mobile_number'] ?? ''}}</b></span><br>
                            <span><b>Email: {{$settings_g['email'] ?? ''}}</b></span><br>
                            <span><b>Website: nourishourearth.org</b></span><br>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="footer_widget">
                        <h6>Quick Link</h6>

                        <div class="navigaiton">
                            @if($footer_menu)
                                <ul class="nav_item npnls footer_widget_menu">
                                    @foreach ($main_menu->SingleMenuItems as $item)
                                        <li>
                                            <a href="{{$item->menu_info['url']}}"><i class="fas fa-caret-right"></i>&nbsp;&nbsp;{{$item->menu_info['text']}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-danger text-right">Please create "Footer" menu</p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="footer_widget">
                        <div class="subscribe">
                            <div class="subscribe_title">
                                <h6>Subscribe</h6>
                            </div>

                            <div class="card footer_cart">
                                <div class="subscribe_content">
                                    {{-- <p>Enter your email address to subscribe be this blog and notifications of new post by email.</p> --}}
                                    <input type="text" class="form-control" placeholder="Your Email Address">

                                    {{-- <button class="animated-button6 bt_back nav mt-2">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                        Subscribe
                                    </button> --}}
                                    {{-- <button type="button" class="btn btn-success btn-sm mt-4">Subscribe</button> --}}
                                    <div class="footer-image mt-2">
                                        <img src="{{ asset('/front/images/footer logo.png') }}" alt="">
                                        <img src="{{ asset('/front/images/footer logo 2.png') }}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>

                {{-- <div class="col-md-3">
                    <div class="footer_widget">
                        <div class="subscribe">
                            <h6>Download Now</h6>
                            <img src="{{ env('AWS_URL').'/front/images/apps.png'}}" class="whp">
                        </div>
                    </div>

                    <div class="footer_widget">
                        <h6>Payment Method</h6>
                        <img src="{{ env('AWS_URL').'/front/images/paypal.png' }}" class="whp">
                    </div>
                </div> --}}
            </div>
        </div>
    </section>
    <!-- Footer Top End -->

    <!-- Section Footer -->
    <section class="bottom_bar">
        <div class="container-fluid">
            <div class="container footer_text">
                <div class="row">
                    <div class="col-md-6">
                        <p class="text-center text-md-left text-custom">
                            &copy; {{date('Y')}} <b>NOVA HOME</b>
                        </p>
                    </div>
                    <div class="col-md-6 text-center text-md-right">
                        <p class="text-custom">
                            Website by <a class="text-custom" target="_blank" href="https://stylezworld.com"><b>styleZworld.com</b></a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer Top End -->
    <!-- Fixed Mobile Menu -->
    <div class="fixed_mobile_menu d-block d-md-none noPrint">
        <ul class="npnls row text-center">
            <li class="col"><a href="{{route('homepage')}}"><i class="fas fa-home"></i></a></li>
            <li class="col"><a href="{{route('donate.now')}}"><i class="fas fa-donate"></i></a></li>
            <li class="col"><a href="{{route('memberDashboard')}}"><i class="fas fa-user"></i></a></li>
        </ul>
    </div>
    <!-- End Fixed Mobile Menu -->
    <script src="{{asset('front/js/vendor/modernizr-3.11.2.min.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="{{asset('front/js/plugin/scrollup.js')}}"></script>
    <script src="{{asset('front/js/plugins.js')}}"></script>
    <script type="text/javascript" src="{{asset('front/js/jquery.easeScroll.js')}}"></script>

    <script>
        $("html").easeScroll({
            frameRate: 60,
            animationTime: 4000,
            stepSize: 120,
            pulseAlgorithm: !0,
            pulseScale: 8,
            pulseNormalize: 1,
            accelerationDelta: 20,
            accelerationMax: 1,
            keyboardSupport: !0,
            arrowScroll: 50
        });

        var myNav = document.getElementById('nav_id');
        window.onscroll = function () {
            if (document.body.scrollTop >= 100 || document.documentElement.scrollTop >=100) {
                myNav.classList.add("nav-colored");
                myNav.classList.remove("nav-transparent");
            }
            else {
                myNav.classList.add("nav-transparent");
                myNav.classList.remove("nav-colored");
            }
        };
    </script>

    <!-- Sweetalert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.3.0/dist/sweetalert2.all.min.js"></script>

    <script src="{{asset('front/js/main.js')}}"></script>

    @if(session('success-alert'))
        <script>
            cAlert('success', "{{session('success-alert')}}");
        </script>
    @endif

    @if(session('error-alert'))
        <script>
            cAlert('error', "{{session('error-alert')}}");
        </script>
    @endif

    @if(session('error-alert2'))
        <script>
            Swal.fire(
                'Failed!',
                '{{session("error-alert2")}}',
                'error'
            )
        </script>
    @endif

    @if(session('success-alert2'))
        <script>
            Swal.fire(
                'Success!',
                '{{session("success-alert2")}}',
                'success'
            )
        </script>
    @endif

    @yield('footer')
</body>

</html>
