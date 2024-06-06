@extends('login.layout')
@section('title', 'CCST | Resva')
@section('content')
<div id="contact" class="contact-us section">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 align-self-center wow fadeInLeft" data-wow-duration="0.5s" data-wow-delay="0.25s">
          <div class="section-heading">
            <h2>Feel Free To Send Us a Message About Your Reservation Needs</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed doer ket eismod tempor incididunt ut labore et dolores</p>
            <div class="phone-info">
              <h4>For any inquiry, Call Us: <span><i class="fa fa-phone"></i> <a href="#">010-020-0340</a></span></h4>
            </div>
          </div>
        </div>
        <div class="col-lg-6 wow fadeInRight" data-wow-duration="0.5s" data-wow-delay="0.25s">
         
          <form id="contact" action="{{route('login.post')}}" method="post">
            @csrf
            <div class="">
              @if ($errors->any())
                  <div class="alert alert-danger">
                      {{ $errors->all()[0] }}
                  </div>
              @endif
              @if(session()->has('error'))
              <div class="alert alert-danger">{{session('error')}}</div>
              @endif
  
              @if(session()->has('success'))
                <div class="alert alert-success">{{session('success')}}</div>
              @endif
            </div>
            <div class="row">
              <div class="col-lg-12">
                <fieldset>
                  <input type="text" name="email" id="name" class="form-control @error('email') is-invalid @enderror" placeholder="Enter your email">
                </fieldset>
              </div>
              <div class="col-lg-12">
                <fieldset>
                  <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter your password">
                </fieldset>
                     
              </div>
              <div class="form-check">
                <style>
                  #show-password {
                      /* Adjust the size as needed */
                      width: 16px !important;
                      height: 16px !important;
                      /* Other styles */
                  }
                </style>
                
                <input class="" type="checkbox" id="show-password">
                <label class="form-check-label" for="show-password">Show Password</label>
              </div>
              <div class="col-lg-12"  >
                <fieldset style="float: right;">
                  <button type="submit" id="form-submit" class="main-button">Log In</button>
                </fieldset>
              </div>
              <div class="col-lg-12 mt-2"  >
                <a href="{{route('signup')}}"  style="float: right;"> Don't have an account? Sign Up</a>
              </div>
            </div>
            <div class="contact-dec">
              <img src="home/assets/images/contact-decoration.png" alt="">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

@endsection