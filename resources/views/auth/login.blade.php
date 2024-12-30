<!DOCTYPE html>
<html lang="en" dir="ltr">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <!-- Meta data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta content="Dashtic - Bootstrap Webapp Responsive Dashboard Simple Admin Panel Premium HTML5 Template" name="description">
    <meta content="Spruko Technologies Private Limited" name="author">
    <meta name="keywords" content="Admin, Admin Template, Dashboard, Responsive, Admin Dashboard, Bootstrap, Bootstrap 4, Clean, Backend, Jquery, Modern, Web App, Admin Panel, Ui, Premium Admin Templates, Flat, Admin Theme, Ui Kit, Bootstrap Admin, Responsive Admin, Application, Template, Admin Themes, Dashboard Template"/>

    <!-- Title -->
    <title>Next Event Ghana</title>

    <!--Favicon -->
    <!-- <link rel="icon" href="https://codeigniter.spruko.com/Dashtic/DASHTIC-LTR/public/assets/images/brand/favicon.ico" type="image/x-icon"/>  -->
 
    <!-- Bootstrap css -->
    <link href="{{asset('theme/assets/plugins/bootstrap/css/bootstrap.css')}}" rel="stylesheet" />

    <!-- Style css -->
    <link href="{{asset('theme/assets/css/style.css')}}" rel="stylesheet" />

    <!-- Dark css -->
    <link href="{{asset('theme/assets/css/dark.css')}}" rel="stylesheet" />

    <!-- Skins css -->
    <link href="{{asset('theme/assets/css/skins.css')}}" rel="stylesheet" />

    <!-- Animate css -->
    <link href="{{asset('theme/assets/css/animated.css')}}" rel="stylesheet" />

    <!---Icons css-->
    <link href="{{asset('theme/assets/plugins/web-fonts/icons.css')}}" rel="stylesheet" />
    <link href="{{asset('theme/assets/plugins/web-fonts/font-awesome/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('theme/assets/plugins/web-fonts/plugin.css')}}" rel="stylesheet" />
    @livewireStyles	
</head>
<body class="h-100vh page-style1 light-mode default-sidebar">
    <div class="page">
        <div class="page-single">
            <div class="p-5">
                <div class="row">
                    <div class="col mx-auto">
                        <div class="row justify-content-center">
                            <div class="col-lg-25 col-xl-25">
                                <div class="card-group mb-0">
                                    <div class="card p-4 page-content" style="height: auto;"> <!-- Reduced padding -->
                                        <div class="card-body page-single-content">
                                            <div class="w-100">
                                                <div class="container mt-5">
                                                    <style>
                                                        body {
                                                            background-color: #f8f9fa; /* Light background for a clean look */
                                                        }
                                                        .card {
                                                            border-radius: 15px; /* Rounded corners for a modern look */
                                                            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
                                                        }
                                                        .card-header {
                                                            background-color: #007bff; /* Bootstrap primary color */
                                                            color: white; /* White text for contrast */
                                                            border-top-left-radius: 15px; /* Rounded corners */
                                                            border-top-right-radius: 15px; /* Rounded corners */
                                                        }
                                                        .inner-card {
                                                            border: 2px solid #007bff; /* Blue border */
                                                            border-radius: 10px; /* Rounded corners for inner card */
                                                            padding: 20px; /* Padding for inner card */
                                                            margin-top: 20px; /* Space between outer and inner card */
                                                        }
                                                        .card-body {
                                                            text-align: center; /* Centered text for a friendly feel */
                                                        }
                                                    </style>
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h1 class="mb-0">Next Event Ghana</h1>
                                                        </div>
                                                    </div>
                                                    <div class="inner-card"> <!-- Inner card with blue borders -->
                                                        <div class="card-body">
                                                            <p class="text-muted">Sign In to your account</p>


                                                            </div>

                                                <form method="POST" action="{{ route('login') }}">
                                                    @csrf
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-addon">
                                                            <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                                                                <path d="M0 0h24v24H0V0z" fill="none"/>
                                                                <path d="M12 16c-2.69 0-5.77 1.28-6 2h12c-.2-.71-3.3-2-6-2z" opacity=".3"/>
                                                                <circle cx="12" cy="8" opacity=".3" r="2"/>
                                                                <path d="M12 14c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4zm-6 4c.22-.72 3.31-2 6-2 2.7 0 5.8 1.29 6 2H6zm6-6c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0-6c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2z"/>
                                                            </svg>
                                                        </span>
                                                        <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter email">
                                                        @error('email')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="input-group mb-4">
                                                        <span class="input-group-addon">
                                                            <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                                                            <g fill="none">
                                                                    <path d="M0 0h24v24H0V0z"/>
                                                                    <path d="M0 0h24v24H0V0z" opacity=".87"/>
                                                                </g>
                                                                <path d="M6 20h12V10H6v10zm6-7c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2z" opacity=".3"/>
                                                                <path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zM9 6c0-1.66 1.34-3 3-3s3 1.34 3 3v2H9V6zm9 14H6V10h12v10zm-6-3c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2z"/>
                                                            </svg>
                                                        </span>
                                                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                                                        @error('password')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="d-flex flex-column align-items-center">
                                                        <div class="form-check mb-3">
                                                            <input type="checkbox" name="remember" class="form-check-input" id="remember">
                                                            <label class="form-check-label" for="remember">Remember Me</label>
                                                        </div>
                                                        <div class="row justify-content-center">
                                                            <div class="col-12">
                                                                <button type="submit" class="btn btn-lg btn-primary btn-block">
                                                                    <i class="fe fe-arrow-right"></i> Login
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Forgotten Password Link -->
                                                    <div class="row mt-3">
                                                        <div class="col text-center">
                                                            <a href="{{ route('password.request') }}" class="text-muted">Forgot Password?</a>
                                                            <p class="text-muted"><small>Check your spam for Password reset mails</small></p>
                                                        </div>
                                                    </div>
                                                </form>
                                                <div class="text-center mt-3">
                                                    <a href="{{ route('register') }}" class="btn btn-primary btn-lg">Register</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
                                                        </div>


                                                    </div>
                                                
</body>
<!-- Jquery js-->


<script src="{{asset('theme/assets/js/vendors/jquery-3.5.1.min.js')}}"></script>

<!-- Bootstrap4 js-->
<script src="{{asset('theme/assets/plugins/bootstrap/popper.min.js')}}"></script>
<script src="{{asset('theme/assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>

<!--Othercharts js-->
<script src="{{asset('theme/assets/plugins/othercharts/jquery.sparkline.min.js')}}"></script>

<!-- Circle-progress js-->
<script src="{{asset('theme/assets/js/vendors/circle-progress.min.js')}}"></script>

<!-- Jquery-rating js-->
<script src="{{asset('theme/assets/plugins/rating/jquery.rating-stars.js')}}"></script>
@livewireScripts
</body>

<!-- Mirrored from codeigniter.spruko.com/Dashtic/DASHTIC-LTR/pages/login-3 by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 08 Oct 2021 20:00:58 GMT -->
</html>
