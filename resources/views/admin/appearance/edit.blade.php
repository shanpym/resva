@extends('admin.layout')
@section('title', 'CCST | Resva')
@section('content')
    
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Appearance</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Pages</li>
          <li class="breadcrumb-item active">Appearance</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <div class="">
      @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <img src="{{asset('dashboard/assets/img/error.png')}}"alt="" srcset="" width="25px" style="margin-right: 10px">{{ $errors->all()[0] }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif
      </style>
      @if(session()->has('error'))
        <div id="alert-success" class="alert alert-danger alert-dismissible fade show">
          <img src="{{asset('dashboard/assets/img/error.png')}}"alt="" srcset="" width="25px" style="margin-right: 10px"><i class="fas fa-exclamation-circle"></i> {{session('error')}}</div>
      @endif
      @if(session()->has('error_payment'))
        <div id="alert-success" class="alert alert-danger alert-dismissible fade show">
          <img src="{{asset('dashboard/assets/img/error.png')}}"alt="" srcset="" width="25px" style="margin-right: 10px"><i class="fas fa-exclamation-circle"></i> {{session('error_payment')}}</div>
      @endif
      @if(session()->has('success'))
      @if(Auth::user()->level == '2')
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <img src="{{asset('dashboard/assets/img/success-3.gif')}}"alt="" srcset="" width="25px" style="margin-right: 10px">{{session('success')}}</a>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @else
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <img src="{{asset('dashboard/assets/img/success-3.gif')}}"alt="" srcset="" width="25px" style="margin-right: 10px">{{session('success')}}.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif
      
      @endif
    </div>
    <section class="section">
      <div class="row">
        <form action="{{route('appearance.post')}}" method="post" enctype="multipart/form-data" >
          <div class="col-lg-12">
              @csrf
              @include('admin.appearance.hero')
              @include('admin.appearance.service')
              @include('admin.appearance.about')
              @include('admin.appearance.roompage')
          </div>
          <div class="row mb-3 text-end">
            <div class="col-sm-12">
              <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
          </div>
        </form>
      </div>
    </section>

  </main><!-- End #main -->
  <script>
    $('#img-btn').on('click', function(){
      $('#image, #image-file').hide();
      $('#image-input').show();
    });

    $('#img-btn-about-bg').on('click', function(){
      $('#image-about-bg, #image-file-about-bg').hide();
      $('#image-input-about-bg').show();
    });

    $('#img-btn-about-char').on('click', function(){
      $('#image-about-char, #image-file-about-char').hide();
      $('#image-input-about-char').show();
    });

    $('#img-btn-icon-1').on('click', function(){
      $('#image-icon-1, #image-file-icon-1').hide();
      $('#image-input-icon-1').show();
    });

    $('#img-btn-icon-2').on('click', function(){
      $('#image-icon-2, #image-file-icon-2').hide();
      $('#image-input-icon-2').show();
    });

    $('#img-btn-icon-3').on('click', function(){
      $('#image-icon-3, #image-file-icon-3').hide();
      $('#image-input-icon-3').show();
    });

    $('#img-btn-icon-4').on('click', function(){
      $('#image-icon-4, #image-file-icon-4').hide();
      $('#image-input-icon-4').show();
    });

    $('#img-btn-service').on('click', function(){
      $('#image-service, #image-file-service').hide();
      $('#image-input-service').show();
    });

    //////////////////////////////////////////////////
  </script>
@endsection