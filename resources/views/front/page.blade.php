@extends('front.layouts.master')

@section('head')
    @include('meta::manager', [
        'title' => $page->title . ' - ' . ($settings_g['title'] ?? env('APP_NAME')),
        'image' => $page->media_id ? $page->img_paths['medium'] : null,
        'description' => $page->meta_description
    ])
@endsection

@section('master')
<!-- Start Page Header Section -->
<section class="bg-page-header-common">
    <div class="page-header-overlay py-4">
        <div class="container">
            <div >
                <div class="page-header">
                    <div class="page-title text-center">
                        <h2 class="text-center">{{$page->title}}</h2>
                    </div>
                    <!-- .page-title -->
                    <div class="page-header-content text-center">
                        <ol class="breadcrumb">
                            <li><a href="/">Home</a></li>
                            <li>{{$page->title}}</li>
                        </ol>
                    </div>
                    <!-- .page-header-content -->
                </div>
                <!-- .page-header -->
            </div>
            <!-- .row -->
        </div>
        <!-- .container -->
    </div>
    <!-- .page-header-overlay -->
</section>
<!-- End Page Header Section -->
<div class="page_wrap">
    <div class="container-md">
        <div class="card shadow mb-4">
            {{-- <div class="card-header">
                <h5 class="page_title mb-0">{{$page->title}}</h5>
            </div> --}}

            <div class="card-body">
                @if($page->media_id)
                <div class="d-block">
                    <img src="{{$page->img_paths['large']}}" class="page_img" alt="{{$page->title}}">
                </div>
                @endif

                <div class="text-justify mt-3 page_description_wrap">
                    {!! $page->description !!}
                </div>
            </div>
        </div>
    </div>
</div>




{{-- <section class="our-webcoderskull padding-lg">
    <div class="container">
      <div class="row heading heading-icon">
          <h2>Our Executive Member</h2>
      </div>
      <ul class="row">
        <li class="col-12 col-md-6 col-lg-3">
            <div class="cnt-block equal-hight" style="height: 349px;">
              <figure><img src="http://www.webcoderskull.com/img/team4.png" class="img-responsive" alt=""></figure>
              <h3 style="height: 50px;">
                <a href="http://www.webcoderskull.com/">Omin Goshu</a>
              </h3>
              <p>Hofstra University</p>
              <ul class="follow-us clearfix">
                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
              </ul>
            </div>
        </li>
        <li class="col-12 col-md-6 col-lg-3">
            <div class="cnt-block equal-hight" style="height: 349px;">
              <figure><img src="http://www.webcoderskull.com/img/team1.png" class="img-responsive" alt=""></figure>
              <h3 style="height: 50px;">
                <a href="http://www.webcoderskull.com/">Omin Goshu</a>
              </h3>
              <p>Hofstra University</p>
              <ul class="follow-us clearfix">
                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
              </ul>
            </div>
        </li>
        <li class="col-12 col-md-6 col-lg-3">
            <div class="cnt-block equal-hight" style="height: 349px;">
              <figure><img src="http://www.webcoderskull.com/img/team4.png" class="img-responsive" alt=""></figure>
              <h3 style="height: 50px;">
                <a href="http://www.webcoderskull.com/">Omin Goshu</a>
              </h3>
              <p>Hofstra University</p>
              <ul class="follow-us clearfix">
                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
              </ul>
            </div>
         </li>
        <li class="col-12 col-md-6 col-lg-3">
            <div class="cnt-block equal-hight" style="height: 349px;">
              <figure><img src="http://www.webcoderskull.com/img/team2.png" class="img-responsive" alt=""></figure>
              <h3 style="height: 50px;">
                <a href="http://www.webcoderskull.com/">Omin Goshu</a>
              </h3>
              <p>Hofstra University</p>
              <ul class="follow-us clearfix">
                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
              </ul>
            </div>
        </li>
      </ul>
    </div>
  </section>
  <section class="our-webcoderskull padding-lg">
    <div class="container">
      <div class="row heading heading-icon">
          <h2>Our General Member</h2>
      </div>
      <ul class="row">
        <li class="col-12 col-md-6 col-lg-2">
            <div class="cnt-block equal-hight" style="height: 349px;">
              <figure><img src="http://www.webcoderskull.com/img/team4.png" class="img-responsive" alt=""></figure>
              <h3 style="height: 50px;">
                <a href="http://www.webcoderskull.com/">Omin Goshu</a>
              </h3>
              <p>Hofstra University</p>
              <ul class="follow-us clearfix">
                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
              </ul>
            </div>
        </li>
        <li class="col-12 col-md-6 col-lg-2">
            <div class="cnt-block equal-hight" style="height: 349px;">
              <figure><img src="http://www.webcoderskull.com/img/team1.png" class="img-responsive" alt=""></figure>
              <h3 style="height: 50px;">
                <a href="http://www.webcoderskull.com/">Omin Goshu</a>
              </h3>
              <p>Hofstra University</p>
              <ul class="follow-us clearfix">
                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
              </ul>
            </div>
        </li>
        <li class="col-12 col-md-6 col-lg-2">
            <div class="cnt-block equal-hight" style="height: 349px;">
                <figure>
                  <img src="http://www.webcoderskull.com/img/team4.png" class="img-responsive" alt="">
                </figure>
                <h3 style="height: 50px;">
                  <a href="http://www.webcoderskull.com/">Omin Goshu</a>
                </h3>
              <p>Hofstra University</p>
              <ul class="follow-us clearfix">
                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
              </ul>
            </div>
         </li>
        <li class="col-12 col-md-6 col-lg-2">
            <div class="cnt-block equal-hight" style="height: 349px;">
              <figure>
                  <img src="http://www.webcoderskull.com/img/team2.png" class="img-responsive" alt="">
                </figure>
                <h3 style="height: 50px;">
                  <a href="http://www.webcoderskull.com/">NArman Bandhu</a>
                </h3>
              <p>Hofstra University</p>
              <ul class="follow-us clearfix">
                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
              </ul>
            </div>
        </li>
        <li class="col-12 col-md-6 col-lg-2">
            <div class="cnt-block equal-hight" style="height: 349px;">
              <figure>
                  <img src="http://www.webcoderskull.com/img/team2.png" class="img-responsive" alt="">
                </figure>
                <h3 style="height: 50px;">
                  <a href="http://www.webcoderskull.com/">NArman Bandhu</a>
                </h3>
              <p>Hofstra University</p>
              <ul class="follow-us clearfix">
                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
              </ul>
            </div>
        </li>
      </ul>
    </div>
  </section> --}}
@endsection

@section('footer')
<script type="application/ld+json">
    {
    "@context":"https://schema.org",
    "@type":"BreadcrumbList",
    "itemListElement":[
        {
            "item":{
                "name":"Home",
                "@id":"{{url('/')}}"
            },
            "@type":"ListItem",
            "position":"1"
        },
        {
            "item":{
                "name":"{{$page->title}}",
                "@id":"{{$page->route}}"
            },
            "@type":"ListItem",
            "position":"2"
        }
    ]
    }
</script>

@if($page->media_id && $page->description)
<script type="application/ld+json">
    {
    "@context": "http://schema.org/",
    "@type": "Article",
    "author": "EOMSBD",
    "publisher": {
        "name":"{{$settings_g['title']}}",
        "@type": "Organization",
        "url": "{{route('homepage')}}",
        "sameAs": [
            "https://www.facebook.com"
        ],
        "logo": {
        "@type": "ImageObject",
        "url": "{{$settings_g['logo']}}"
        },
        "contactPoint": [{
            "@type": "ContactPoint",
            "telephone": "{{$settings_g['mobile_number']}}",
            "contactType": "customer service"
        }]
    },
    "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "{{route('homepage')}}"
    },
    "headline": "{{$page->title}}",
    "name": "{{$page->title}}",
    "image": "{{$page->img_paths['medium']}}",
    "description": "{!!preg_replace("/\r|\n/", " ", $page->description)!!}",
    "datePublished": "{{$page->created_at}}",
    "dateModified": "{{$page->updated_at}}"
    }
    </script>
@endif

@endsection
