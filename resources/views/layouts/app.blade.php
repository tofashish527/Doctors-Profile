<!DOCTYPE html>
<html dir="ltr" lang="en-US">
  <head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="author" content="Ayman Fikry"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <meta name="description" content="Medisch Responsive Bootstrap 4 Medical HTML5 Template"/>
    <title>@yield('title', 'Home Pharmacy - Medisch Responsive Bootstrap 4 Medical HTML5 Template')</title>
    <link href="{{ asset('assets/images/favicon/favicon.png') }}" rel="icon"/>
    <!--  Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com"/>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&amp;family=Roboto:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&amp;family=Rubik:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&amp;display=swap" rel="stylesheet"/>
    <!--  Stylesheets -->
    <link href="{{ asset('assets/css/vendor.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet"/>
    
    @stack('styles')
  </head>
  <body>
    <div class="preloader">
      <div class="spinner">
        <div class="dot1"></div>
        <div class="dot2"></div>
      </div>
    </div>
    <div class="cursor">
      <div class="cursor__inner cursor__inner--circle"></div>
      <div class="cursor__inner cursor__inner--dot"></div>
    </div>
    <!-- End .cursor-->
    
    <!-- Document Wrapper-->
    <div class="wrapper clearfix" id="wrapperParallax">
      <!--
      ============================
      Module Fullscreen
      ============================
      -->
      <div class="module-content module-fullscreen module-search-box">
        <div class="pos-vertical-center">
          <div class="container">
            <div class="row">
              <div class="col-sm-12 col-md-12 col-lg-8 offset-lg-2">
                <form class="form-search">
                  <input class="form-control" type="text" placeholder="type words then enter"/>
                  <button></button>
                </form>
                <!-- End .form-search -->
              </div>
              <!-- End .col-lg-8 -->
            </div>
            <!--  End .row-->
          </div>
          <!--  End .container-->
        </div><a class="module-cancel" href="#"><i class="fas fa-times"></i></a>
        <!-- End .module-cancel-->
      </div>
      <!--End pos-vertical-center-->
      
      <!--
      ============================
      Header #09
      ============================
      -->
      @include('partials.header')
      
      <!--
      ============================
      Main Content Area
      ============================
      -->
      <main>
        @yield('content')
      </main>
      
      <!--
      ============================
      Footer #01
      ============================
      -->
      @include('partials.footer')
      
      <div class="backtop" id="back-to-top" data-hover="">
        <svg class="bi bi-chevron-up" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"></path>
        </svg>
      </div>
    </div>
    
    <!--  Footer Scripts -->
    <script src="{{ asset('assets/js/vendor/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor.min.js') }}"></script>
    <script src="{{ asset('assets/js/functions.js') }}"></script>
    
    @stack('scripts')
  </body>
</html>