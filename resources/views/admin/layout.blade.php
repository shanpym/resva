<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>@yield('title')</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Bootstrap JS -->
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

  <!-- Favicons -->
  <link href="{{asset('dashboard/assets/img/favicon.png')}}" rel="icon">
  <link href="{{asset('dashboard/assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('dashboard/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('dashboard/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset('dashboard/assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{asset('dashboard/assets/vendor/quill/quill.snow.css')}}" rel="stylesheet">
  <link href="{{asset('dashboard/assets/vendor/quill/quill.bubble.css')}}" rel="stylesheet">
  <link href="{{asset('dashboard/assets/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
  <link href="{{asset('dashboard/assets/vendor/simple-datatables/style.css')}}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{asset('dashboard/assets/css/style.css')}}" rel="stylesheet">
</head>

<body>

  @if(Auth::user()->level == '3')
    @include('user.include.header')
    @include('user.include.sidebar')
    @yield('content')
    @include('user.include.footer')
  
  @else
    @include('admin.include.header')
    @include('admin.include.sidebar')
    @yield('content')
    @include('admin.include.footer')
  @endif
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{asset('dashboard/assets/vendor/apexcharts/apexcharts.min.js')}}"></script>
  <script src="{{asset('dashboard/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('dashboard/assets/vendor/chart.js/chart.umd.js')}}"></script>
  <script src="{{asset('dashboard/assets/vendor/echarts/echarts.min.js')}}"></script>
  <script src="{{asset('dashboard/assets/vendor/quill/quill.js')}}"></script>
  <script src="{{asset('dashboard/assets/vendor/simple-datatables/simple-datatables.js')}}"></script>
  <script src="{{asset('dashboard/assets/vendor/tinymce/tinymce.min.js')}}"></script>
  <script src="{{asset('dashboard/assets/vendor/php-email-form/validate.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{asset('dashboard/assets/js/main.js')}}"></script>
  {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> --}}
  {{-- <script src="{{asset('dashboard/ph-address-selector.js')}}"></script> --}}
  
</body>

</html>