@extends('admin.layout')
@section('title', 'CCST | Resva')
@section('content')
    
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Your Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Pages</li>
          <li class="breadcrumb-item active">Accounts</li>
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
        <div class="col-lg-12">
                @include('admin.profile.profile_view')
         

        </div>

      </div>
    </section>

  </main><!-- End #main -->

  <script>
    $('#edit-btn').on('click', function(){
      $('#text-address').css("display", "none");
      $('#edit-address').css("display", "block")
    })

    $('#edit-btn-2').on('click', function(){
      $('#text-address').css("display", "block");
      $('#edit-address').css("display", "none")
    })
  </script>
@endsection