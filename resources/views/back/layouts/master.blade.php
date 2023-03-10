<!doctype html>
<html class="no-js" lang="en">

<head>
  <meta charset="utf-8">
  <title>@yield('title') - {{$settings_g['title'] ?? env('APP_NAME')}}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

  <!-- Icons -->
  <link rel="shortcut icon" href="{{$settings_g['favicon'] ?? ''}}">

  <link rel="stylesheet" href="{{asset('back/css/normalize.css')}}">
  <link rel="stylesheet" href="{{asset('back/css/main.css')}}">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <link rel="stylesheet" href="{{asset('back/css/style.css')}}">
  <link rel="stylesheet" href="{{asset('back/css/responsive.css')}}">


  <link rel="preconnect" href="https://fonts.googleapis.com')}}">
  <link rel="preconnect" href="https://fonts.gstatic.com')}}" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@200;300;400;700&display=swap" rel="stylesheet">

  <script src="https://kit.fontawesome.com/9c65216417.js" crossorigin="anonymous"></script>

  <meta name="theme-color" content="#fafafa">
    <!--data table-->
<!--<link rel="stylesheet" href="{{ asset('plugins/datatables/css/jquery.dataTables.min.css') }}">-->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-select/css/select.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!--data table-->
  @yield('head')

  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

  @include('switcher::code')

  <script>
    window.application_root = '{{url("/")}}';
    window.application_root_api = '{{url("/api")}}';
  </script>

  <link href="{{asset('back/css/print.css')}}" media="print" rel="stylesheet">
</head>

<body>
    <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
        @csrf
    </form>

    <!-- Custom Loader -->
    <div class="loader noPrint" style="display: none">
        <i class="fas fa-spinner fa-spin"></i>
    </div>

  <div class="main" id="app">
    <header class="noPrint">
      <div class="container-fluid">
        <div class="header_wrap">
          <div class="row">
            <div class="col-md-6">
              <ul class="npnls left_menu d-none d-md-block">
                <li>
                    <a href="{{route('homepage')}}" target="_blank" class="app_name">
                        @if(isset($settings_g['logo']) && $settings_g['logo'])
                        <img src="{{$settings_g['logo'] ?? env('APP_NAME')}}" alt="{{$settings_g['title'] ?? env('APP_NAME')}}" class="whp" style="padding: 5px;margin-top: -24px;height: 80px;object-fit: contain;">
                        @else
                        {{$settings_g['title'] ?? ''}}
                        @endif
                    </a>
                </li>
              </ul>
            </div>

            <div class="col-md-6">
              <div class="row">
                <div class="col-6 d-block d-md-none">
                  <ul class="npnls header_right_items hli">
                    <li><a href="#" onclick="menuTrigger()"><i class="fas fa-bars"></i></a></li>
                  </ul>
                </div>
                <div class="col-6 col-md-12">
                  <ul class="npnls text-right header_right_items d-none d-md-block">
                    <li>
                      <a href="#"><i class="fa fa-user"></i></a>

                      <ul class="npnls header_right_dropdown">
                        <li><a href="{{route('admin.update-profile')}}"><i class="fas fa-user mr-2"></i>Profile</a></li>
                        <li><a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-lock mr-2"></i>Logout</a></li>
                      </ul>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>

    <aside class="main-sidebar noPrint" id="sidebar_accordion">
      <ul class="npnls">
        <li class="{{Route::is('dashboard') ? 'active' : ''}}"><a href="{{route('dashboard')}}"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>

        {{-- <li>
            <a href="{{route('back.blogs.index')}}" class="{{(Route::is('back.blogs.index') || Route::is('back.blogs.create') || Route::is('back.blogs.edit') || Route::is('back.blogs.categories') || Route::is('back.blogs.categories.create') || Route::is('back.categories.edit')) ? 'active' : 'collapsed'}}" type="button" data-toggle="collapse" data-target="#collapse_blog" aria-expanded="false"><i class="fas fa-list"></i> Blog <i class="fas fa-chevron-right float-right text-right sub_menu_arrow"></i></a>

            <ul class="sub_ms collapse {{(Route::is('back.blogs.index') || Route::is('back.blogs.create') || Route::is('back.blogs.edit') || Route::is('back.blogs.categories') || Route::is('back.blogs.categories.create') || Route::is('back.categories.edit')) ? 'show' : ''}}" id="collapse_blog" data-parent="#sidebar_accordion">
              <li class="{{(Route::is('back.blogs.index') || Route::is('back.blogs.create') || Route::is('back.blogs.edit')) ? 'active_sub_menu' : ''}}"><a href="{{route('back.blogs.index')}}">List</a></li>
              <li class="{{(Route::is('back.blogs.categories') || Route::is('back.blogs.categories.create') || Route::is('back.categories.edit')) ? 'active_sub_menu' : ''}}"><a href="{{route('back.blogs.categories')}}">Categories</a></li>
            </ul>
        </li> --}}

        {{-- <li class="{{(Route::is('back.events.index') || Route::is('back.events.create') || Route::is('back.events.edit')) ? 'active' : ''}}"><a href="{{route('back.events.index')}}"><i class="fas fa-calendar-week"></i> Events</a></li> --}}

        {{-- <li class="{{(Route::is('back.reunions.index') || Route::is('back.reunions.create') || Route::is('back.reunions.edit')) ? 'active' : ''}}"><a href="{{route('back.reunions.index')}}"><i class="fas fa-users"></i> Reunions</a></li> --}}

        {{-- <li class="{{(Route::is('back.votes.index') || Route::is('back.votes.create') || Route::is('back.votes.edit') || Route::is('back.votes.show')) ? 'active' : ''}}"><a href="{{route('back.votes.index')}}"><i class="fas fa-check"></i> Votes</a></li> --}}
      <li>
          <a href="" class="{{(Route::is('back.galleries.index') || Route::is('back.galleries.edit') || Route::is('back.galleries.categoryCreate') || Route::is('back.galleries.category')) ? 'active' : 'collapsed'}}" type="button" data-toggle="collapse" data-target="#collapse_gallery" aria-expanded="false"><i class="fas fa-images"></i> Gallery <i class="fas fa-chevron-right float-right text-right sub_menu_arrow"></i></a>

          <ul class="sub_ms collapse {{(Route::is('back.galleries.index') || Route::is('back.galleries.edit') || Route::is('back.galleries.categoryCreate') || Route::is('back.galleries.category')) ? 'show' : ''}}" id="collapse_gallery" data-parent="#sidebar_accordion">
              <li class="{{(Route::is('back.galleries.index') || Route::is('back.galleries.edit')) ? 'active_sub_menu' : ''}}"><a href="{{route('back.galleries.index')}}">Gallery</a></li>
              <li class="{{(Route::is('back.galleries.category') || Route::is('back.galleries.categoryCreate')) ? 'active_sub_menu' : ''}}"><a href="{{route('back.galleries.category')}}">Category</a></li>
          </ul>
      </li>
        {{-- <li class="{{(Route::is('back.fund-raisers.index') || Route::is('back.fund-raisers.create') || Route::is('back.fund-raisers.edit')) ? 'active' : ''}}"><a href="{{route('back.fund-raisers.index')}}"><i class="fas fa-heart"></i> Contributions </a></li> --}}
        {{-- <li class="{{ Route::is('back.donation.index')? 'active' : ''}}"><a href="{{route('back.donation.index')}}"><i class="fas fa-heart"></i> Donations</a></li> --}}
          {{-- <li>
              <a href="" class="{{(Route::is('back.members.index') || Route::is('back.members.create')
                || Route::is('back.members.edit') || Route::is('back.member.type.index') || Route::is('back.member.type.create')
                 || Route::is('back.member.type.edit') || Route::is('back.members.profile')) ? 'active' : 'collapsed'}}" type="button" data-toggle="collapse" data-target="#collapse_member" aria-expanded="false"><i class="fas fa-user"></i> Members <i class="fas fa-chevron-right float-right text-right sub_menu_arrow"></i></a>
              <ul class="sub_ms collapse {{ (Route::is('back.members.index') || Route::is('back.members.create')
                || Route::is('back.members.edit') || Route::is('back.member.type.index') || Route::is('back.member.type.create')
                 || Route::is('back.member.type.edit') || Route::is('back.members.profile') ) ? 'show' : ''}}" id="collapse_member" data-parent="#sidebar_accordion">
                  <li class="{{ (Route::is('back.member.type.index') || Route::is('back.member.type.create') || Route::is('back.member.type.edit') ) ? 'active_sub_menu' : ''}}"><a href="{{route('back.member.type.index')}}">Member Types</a></li>
                  <li class="{{ (Route::is('back.members.index') || Route::is('back.members.create') || Route::is('back.members.edit') || Route::is('back.members.profile')) ? 'active_sub_menu' : ''}}"><a href="{{route('back.members.index')}}">Members</a></li>
               </ul>
          </li> --}}
          {{-- <li>
            <a href="" class="{{(Route::is('back.members.index') || Route::is('back.report.donation') ) ? 'active' : 'collapsed'}}" type="button" data-toggle="collapse" data-target="#collapse_reports" aria-expanded="false">
                <i class="fas fa-user"></i> Reports <i class="fas fa-chevron-right float-right text-right sub_menu_arrow"></i>
            </a>
            <ul class="sub_ms collapse {{ (Route::is('back.report.member')  || Route::is('back.report.donation') ) ? 'show' : ''}}" id="collapse_reports" data-parent="#sidebar_accordion">
                <li class="{{ (Route::is('back.report.member') ) ? 'active_sub_menu' : ''}}">
                    <a href="{{route('back.report.member')}}">Member Reports</a>
                </li>
                <li class="{{ (Route::is('back.report.donation') ) ? 'active_sub_menu' : ''}}">
                    <a href="{{route('back.report.donation')}}">Donation Reports</a>
                </li>
             </ul>
        </li> --}}
        {{-- <li class="{{(Route::is('back.teams.index') || Route::is('back.teams.create') || Route::is('back.teams.edit')) ? 'active' : ''}}"><a href="{{route('back.teams.index')}}"><i class="fas fa-user"></i> Our Team</a></li> --}}

        @php
            $frontend_routs = Route::is('back.frontend.general') || Route::is('back.pages.index') || Route::is('back.pages.create') || Route::is('back.pages.edit') || Route::is('back.menus.index') || Route::is('back.sliders.index') || Route::is('back.sliders.edit') || Route::is('back.media.settings') || Route::is('back.feature-ads.index') || Route::is('back.footerwidgets.index') || Route::is('back.footer-widgets.create');
        @endphp
        <li>
          <a href="" class="{{$frontend_routs ? 'active' : 'collapsed'}}" type="button" data-toggle="collapse" data-target="#collapse_frontend" aria-expanded="false"><i class="fas fa-eye"></i> Front End <i class="fas fa-chevron-right float-right text-right sub_menu_arrow"></i></a>

          <ul class="sub_ms collapse {{$frontend_routs ? 'show' : ''}}" id="collapse_frontend" data-parent="#sidebar_accordion">
            <li class="{{(request()->route()->getName() == 'back.frontend.general') ? 'active_sub_menu' : ''}}"><a href="{{route('back.frontend.general')}}">General Settings</a></li>
            <li class="{{(Route::is('back.pages.index') || Route::is('back.pages.create') || Route::is('back.pages.edit')) ? 'active_sub_menu' : ''}}"><a href="{{route('back.pages.index')}}">Pages</a></li>
            <li class="{{(request()->route()->getName() == 'back.menus.index') ? 'active_sub_menu' : ''}}"><a href="{{route('back.menus.index')}}">Menus</a></li>
            <li class="{{(request()->route()->getName() == 'back.sliders.index' || Route::is('back.sliders.edit')) ? 'active_sub_menu' : ''}}"><a href="{{route('back.sliders.index')}}">Slider</a></li>
            <li class="{{(request()->route()->getName() == 'back.media.settings') ? 'active_sub_menu' : ''}}"><a href="{{route('back.media.settings')}}">Media</a></li>
            <li class="{{(request()->route()->getName() == 'back.frontend.section') ? 'active_sub_menu' : ''}}"><a href="{{route('back.frontend.section')}}">Section</a></li>
          </ul>
        </li>

        <li>
            <a href="" class="{{(Route::is('back.notification.email') || Route::is('back.notification.emailSend') || Route::is('back.notification.emailShow') || Route::is('back.notification.push')) ? 'active' : 'collapsed'}}" type="button" data-toggle="collapse" data-target="#collapse_notification" aria-expanded="false"><i class="fas fa-bell"></i> Notification <i class="fas fa-chevron-right float-right text-right sub_menu_arrow"></i></a>

            <ul class="sub_ms collapse {{(Route::is('back.notification.email') || Route::is('back.notification.emailSend') || Route::is('back.notification.emailShow') || Route::is('back.notification.push')) ? 'show' : ''}}" id="collapse_notification" data-parent="#sidebar_accordion">
              <li class="{{(Route::is('back.notification.email') || Route::is('back.notification.emailSend') || Route::is('back.notification.emailShow')) ? 'active_sub_menu' : ''}}"><a href="{{route('back.notification.email')}}">Email</a></li>
              {{-- <li class="{{Route::is('back.notification.push') ? 'active_sub_menu' : ''}}"><a href="{{route('back.notification.push')}}">Push</a></li> --}}
            </ul>
        </li>

        <li class="{{(Route::is('back.admins.index') || Route::is('back.admins.create') || Route::is('back.admins.edit')) ? 'active' : ''}}"><a href="{{route('back.admins.index')}}"><i class="fas fa-user"></i> Admins</a></li>
      </ul>
    </aside>

    <div class="content-wrapper">
      <div class="content">
        <section class="content-header noPrint">
          <div class="row">
            <div class="col-md-6">
              <h1>
                @yield('title')
                <small>{{env('APP_NAME')}}</small>
              </h1>
            </div>

            <div class="col-md-6">
              <ul class="npnls text-left text-md-right ch_breadcrumb">
                <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard > </a></li>
                <li class="active">@yield('title')</li>
              </ul>
            </div>
          </div>
        </section>

        <div class="content_body">
            @if(isset($errors))
                @include('extra.error-validation')
            @endif
            @if(session('success'))
                @include('extra.success')
            @endif
            @if(session('error'))
                @include('extra.error')
            @endif

            @yield('master')
        </div>
      </div>

      <footer class="p-3 noPrint">
        <p class="mb-0">Copyright &copy; {{date('Y')}}. All right reserved | Developed by <a class="text-success" href="https://stylezworld.com" target="_blank">styleZworld.com</a></p>
      </footer>
    </div>
  </div>

  <script src="{{asset('back/js/vendor/modernizr-3.11.2.min.js')}}"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  <script src="{{asset('back/js/plugins.js')}}"></script>

    <!--data table-->
    <script src="{{ asset('plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-select/js/dataTables.select.min.js') }}"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js "></script>
    <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.print.min.js"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- Select2 -->
    <!--data table-->

  <!-- Sweetalert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.3.0/dist/sweetalert2.all.min.js"></script>

  <script src="{{asset('back/js/main.js')}}"></script>

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

    @if(session('error-transaction'))
        <script>
            Swal.fire(
                'Transaction Failed!',
                '{{session("error-transaction")}}',
                'error'
            )
        </script>
    @endif

    @yield('footer')
</body>
</html>
