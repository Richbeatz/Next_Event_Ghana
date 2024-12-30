<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
      <meta name="description" content="bootstrap material admin template">
      <meta name="author" content="">
      <title>Next Event Ghana</title>
      <meta name="csrf-token" class="csrf_token" content="{{ csrf_token() }}">
      @include('assets.ACSS')
      @stack('page_css')
      {!! Toastr::message() !!}
      @livewireStyles
     
   </head>

   <body class="app sidebar-mini light-mode default-sidebar">
  

         <div class="page-main">
            <!--aside open-->
            @include('inc.side-bar')
            <div class="app-content main-content">















               <div class="side-app">
                  <!--app header-->
                  @include('inc.top-header')
                  <!--/app header-->
                  @yield('content')
               </div>
            </div>
            <!-- end app-content-->
         </div>
     
         <!--Footer-->
         <footer class="footer" >
            <div class="container">
               <div class="row align-items-center flex-row-reverse">

<div class="container" >
<div class="row">
    <div class="col-md-12 text-center">
        <a href="https://www.facebook.com/profile.php?id=61552256550838" target="_blank" rel="noopener noreferrer">
            <i class="fab fa-facebook-f" style="font-size:36px; color: #6228d7;"></i>
        </a>

        <a href="https://instagram.com/next_event_ghana?igshid=MzNlNGNkZWQ4Mg==" target="_blank" rel="noopener noreferrer">
            <i class="fab fa-instagram" style="font-size:36px; color: #6228d7;"></i>
        </a>

        <a href="https://www.tiktok.com/@next_event_ghana" target="_blank" rel="noopener noreferrer">
        <img src="{{asset('theme/assets/images/brand/tiktok.png')}}" alt="TikTok" style="width: 32px; height: 32px; margin-top: -15px;">
    </a>
    </div>
</div>
         
        
      </div>
      </div>
      </div>
     

                  <div class="col-md-12 col-sm-12 mt-3 mt-lg-0 text-center">
                     © {{ date('Y') }} 
                  </div>
                  </div>
                  </div>
                  <hr>
         </footer>
         <!-- End Footer-->
      </div>
      @include('assets.AJS')
      @stack('page_js')
      {!! Toastr::message() !!}
       @livewireScripts
   </body>
</html>
