@extends('front.layouts.master')

@section('head')
    @include('meta::manager', [
        'title' => 'Login - ' . ($settings_g['title'] ?? env('APP_NAME')),
    ])
    <style>
        .nav_transparent {
            top: 0!important;
            background: #617e7985;
        }
        ul.npnls.top_nav {
            color: black;
        }
        ul.npnls.top_nav li {
            list-style: none;
            display: inline-block;
        }
    </style>
@endsection

@section('master')
<!-- End Breadcrumb -->
<div class="page_wrap">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8  mt-5">
                <div class="card mb-5 mt-5">
                    <!-- Breadcrumb -->
                    <div class="c_breadcrumb card-header">
                        <div class="container">
                            <div class="c_breadcrumb_list">
                                <ul class="npnls top_nav">
                                    <li><a href="{{route('homepage')}}"><i class="fas fa-home"></i></a></li>
                                    <li><span> / Login</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-info">
                                        {{ __('Login') }}
                                    </button>

                                    <p class="mt-3">
                                        Forgot password?
                                        <a href="{{ route('password.request') }}">Reset now.</a>
                                    </p>

                                    {{-- @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif --}}

                                    {{-- <p class="mt-3">
                                        Do not habe any account?
                                        <a href="{{ route('register') }}">Register now.</a>
                                    </p> --}}
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
