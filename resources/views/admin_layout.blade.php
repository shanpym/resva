<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
    <title>@yield('title')</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('home/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{asset('home/assets/css/fontawesome.css')}}">
    <link rel="stylesheet" href="{{asset('home/assets/css/templatemo-space-dynamic.css')}}">
    <link rel="stylesheet" href="{{asset('home/assets/css/animated.css')}}">
    <link rel="stylesheet" href="{{asset('home/assets/css/owl.css')}}">
<!--

-->
  </head>

<body>
  <!-- ***** Preloader End ***** -->
  @yield('content')
  <!-- Scripts -->
  <script src="{{asset('home/vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('home/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('home/assets/js/owl-carousel.js')}}"></script>
  <script src="{{asset('home/assets/js/animation.js')}}"></script>
  <script src="{{asset('home/assets/js/imagesloaded.js')}}"></script>
  <script src="{{asset('home/assets/js/templatemo-custom.js')}}"></script>

</body>
</html>