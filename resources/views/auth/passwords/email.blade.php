<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta content="Dashtic - Bootstrap Webapp Responsive Dashboard Simple Admin Panel Premium HTML5 Template" name="description">
    <meta content="Spruko Technologies Private Limited" name="author">
    <meta name="keywords" content="Admin, Admin Template, Dashboard, Responsive, Admin Dashboard, Bootstrap, Bootstrap 4, Clean, Backend, Jquery, Modern, Web App, Admin Panel, Ui, Premium Admin Templates, Flat, Admin Theme, Ui Kit, Bootstrap Admin, Responsive Admin, Application, Template, Admin Themes, Dashboard Template"/>

    <title>Next Event Ghana</title>

    <!-- Bootstrap css -->
    <link href="{{ asset('theme/assets/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet" />
    <!-- Style css -->
    <link href="{{ asset('theme/assets/css/style.css') }}" rel="stylesheet" />
    <!-- Dark css -->
    <link href="{{ asset('theme/assets/css/dark.css') }}" rel="stylesheet" />
    <!-- Skins css -->
    <link href="{{ asset('theme/assets/css/skins.css') }}" rel="stylesheet" />
    <!-- Animate css -->
    <link href="{{ asset('theme/assets/css/animated.css') }}" rel="stylesheet" />
    <!-- Icons css -->
    <link href="{{ asset('theme/assets/plugins/web-fonts/icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('theme/assets/plugins/web-fonts/font-awesome/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/assets/plugins/web-fonts/plugin.css') }}" rel="stylesheet" />
    
    @livewireStyles	
</head>
<body class="h-100vh page-style1 light-mode default-sidebar">
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="row mb-3">
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

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Jquery js -->
    <script src="{{ asset('theme/assets/js/vendors/jquery-3.5.1.min.js') }}"></script>
    <!-- Bootstrap4 js -->
    <script src="{{ asset('theme/assets/plugins/bootstrap/popper.min.js') }}"></script>
    <script src="{{ asset('theme/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- Other charts js -->
    <script src="{{ asset('theme/assets/plugins/othercharts/jquery.sparkline.min.js') }}"></script>
    <!-- Circle-progress js -->
    <script src="{{ asset('theme/assets/js/vendors/circle-progress.min.js') }}"></script>
    <!-- Jquery-rating js -->
    <script src="{{ asset('theme/assets/plugins/rating/jquery.rating-stars.js') }}"></script>
    
    @livewireScripts
</body>
</html>
@endsection
