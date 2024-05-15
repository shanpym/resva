@extends('admin.layout')
@section('title', 'CCST | Resva')
@section('content')
    
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Contact Us</h1>
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
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <img src="{{asset('dashboard/assets/img/success-3.gif')}}"alt="" srcset="" width="25px" style="margin-right: 10px">{{session('success')}}. <a href="{{route('admin_account.list')}}" type="button"> View</a>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif
    </div>
    <section class="section">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"></h5>
                        <div class="card-body">
                            <div class="col-lg-12 align-self-center">
                                <div class="card-body">
                                  <style>
                                    .home-title{
                                      font-family: 'Poppins', sans-serif;
                                      font-size: 24px;
                                      font-weight: 700;
                                      text-transform: uppercase;
                                      color: #03a4ed;
                                    }
                                    .span-title{
                                      font-family: 'Poppins', sans-serif !important;
                                      color: #0275d8 !important;
                                    }
                                  </style>
                                   CCST<h4 class="home-title">Res<span class="span-title">va</span></h4>
                             
                                  
                                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed doer ket eismod tempor incididunt ut labore et dolores</p>
                                  <div class="phone-info">
                                    <h4>For any inquiry, Call Us: <span><i class="fa fa-phone"></i> <a href="#">010-020-0340</a></span></h4>
                                  </div>
                                </div>
                              </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Write your Message</h5>
                        <div class="card-body">
                            <div id="contact" class="contact-us section">
                                <div class="container">
                                  <div class="row">
                                   
                                    <div class="row g-3">
                                      <div class="col-md-6">
                                        <label for="" class="form-label text-muted"><span style="color: #d9534f">*</span> Firstname</label>
                                        <input type="text" name="firstname" class="form-control @error('firstname') is-invalid @enderror" id="firstname" value="{{old('firstname')}}">
                                      </div>
                                      <div class="col-md-6">
                                        <label for="" class="form-label text-muted"><span style="color: #d9534f">*</span> Surname</label>
                                        <input type="text" name="surname" class="form-control @error('surname') is-invalid @enderror" id="surname" value="{{old('surname')}}">
                                      </div>
                                      <div class="col-md-6">
                                        <label for="" class="form-label text-muted"><span style="color: #d9534f">*</span> Email</label>
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{old('email')}}">
                                      </div>
                                      <div class="col-md-6">
                                        <label for="" class="form-label text-muted"><span style="color: #d9534f">*</span> Phone No.</label>
                                        <input type="number" name="phone_no" class="form-control @error('phone_no') is-invalid @enderror" id="phone_no" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==11) return false;" value="{{old('phone_no')}}">
                                      </div>
                                      <div class="col-12">
                                        <label for="inputAddress5" class="form-label text-muted"><span style="color: #d9534f">*</span> Concern</label>
                                        <textarea name="concern" class="form-control @error('concern') is-invalid @enderror" id="concern" placeholder="1234 Main St" value="{{old('concern')}}"></textarea>
                                      </div>
                                      <div class="col-12">
                                        <div class="form-check">
                                          <input class="form-check-input" type="checkbox" id="gridCheck">
                                          <label class="form-check-label" for="gridCheck">
                                            I agree to the Terms & Conditions
                                          </label>
                                        </div>
                                      </div>
                                    </div>
                                  
                                  </div>
                                </div>
                              </div>
                            
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                      <button type="button" class="btn btn-primary">Send Message</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
  </main><!-- End #main -->
@endsection