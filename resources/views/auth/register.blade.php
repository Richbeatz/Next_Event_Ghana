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
    <form method="POST" action="{{ route('register') }}">
    @csrf
    <div class="row">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 mt-7">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ __('Register') }}</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="form-label">{{ __('First Name') }}<span class="text-red">*</span></label>
                            <input
                                type="text"
                                name="first_name"
                                class="form-control @error('first_name') is-invalid @enderror"
                                value="{{ old('first_name') }}"
                                required
                                autocomplete="first_name"
                                autofocus
                                placeholder="First Name"
                            >
                            @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label class="form-label">{{ __('Last Name') }}<span class="text-red">*</span></label>
                            <input
                                type="text"
                                name="last_name"
                                class="form-control @error('last_name') is-invalid @enderror"
                                value="{{ old('last_name') }}"
                                required
                                autocomplete="last_name"
                                placeholder="Last Name"
                            />
                            @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="form-group col-md-6">
                            <label class="form-label">{{ __('User  Name') }}<span class="text-red">*</span></label>
                            <input
                                type="text"
                                name="username"
                                class="form-control @error('username') is-invalid @enderror"
                                value="{{ old('username') }}"
                                required
                                autocomplete="username"
                                placeholder="Username"
                            />
                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="email" class="form-label">{{ __('Email Address') }}<span class="text-red">*</span></label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="form-group col-md-6">
                            <label class="form-label">{{ __('Phone') }}<span class="text-red">*</span></label>
                            <input
                                type="text"
                                name="phone"
                                class="form-control @error('phone') is-invalid @enderror"
                                value="{{ old('phone') }}"
                                required
                                autocomplete="phone"
                                placeholder="Phone"
                            />
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="password" class="form-label">{{ __('Password') }}<span class="text-red">*</span></label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="form-group col-md-6">
                            <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}<span class="text-red">*</span></label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
                           

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