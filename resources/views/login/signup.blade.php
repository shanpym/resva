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
          
          <form id="contact" action="{{route('signup.post')}}" method="post">
            @csrf
            <div class="">
              @if ($errors->any())
                  <div class="alert alert-danger">
                      {{ $errors->all()[0] }}
                  </div>
              @endif
    
              @if(session()->has('success'))
                <div class="alert alert-success"><i class="far fa-check-circle" ></i> {{session('success')}}</div>
              @endif
            </div>
            <div class="row">
              <div class="col-lg-6">
                <fieldset>
                  <input type="text" name="firstname" id="name" class="form-control @error('firstname') is-invalid @enderror" placeholder="Firstname">
                </fieldset>
              </div>
              <div class="col-lg-6">
                <fieldset>
                  <input type="text" name="surname" id="surname" class="form-control @error('surname') is-invalid @enderror" placeholder="Surname">
                </fieldset>
              </div>
              <div class="col-lg-6">
                <fieldset>
                  <input type="date" name="birthdate" id="name" class="form-control @error('birthdate') is-invalid @enderror" placeholder="">
                </fieldset>
              </div>
              <div class="col-lg-6">
                <fieldset>
                  <input type="number" name="phone_no" id="surname" class="form-control @error('phone_no') is-invalid @enderror" placeholder="09X XXXX XXXX" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==11) return false;">
                </fieldset>
              </div>
              <div class="col-lg-12">
                <fieldset>
                  <input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Your Email">
                  @foreach ($errors->get('email') as $error)
                          <span class="text-danger"> * {{$error}}</span>
                        @endforeach
                </fieldset>
              </div>
              <div class="col-lg-12">
                <fieldset>
                  <div class="row mb-3 mt-5">
                    <div class="col-lg-6">
                      <select name="region" class="form-control form-control-md @error('region_text') is-invalid @enderror" id="region"></select>
                      <input type="hidden" class="form-control form-control-md" name="region_text" id="region-text" required>
                    </div>
                    <div class="col-lg-6">
                      <select name="province" class="form-control form-control-md @error('province_text') is-invalid @enderror" id="province" disabled>
                        <option value="" selected disabled>Choose State/Province</option>
                      </select>
                    <input type="hidden" class="form-control form-control-md" name="province_text" id="province-text" required>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <div class="col-lg-6">
                      <select name="city" class="form-control form-control-md @error('city_text') is-invalid @enderror" id="city" disabled>
                        <option value="" selected disabled>Choose City/Municipality</option>
                      </select>
                      <input type="hidden" class="form-control form-control-md" name="city_text" id="city-text" required>
                    </div>
                    <div class="col-lg-6">
                      <select name="barangay" class="form-control form-control-md @error('barangay_text') is-invalid @enderror" id="barangay" disabled>
                        <option value="" selected disabled>Choose Barangay</option>
                      </select>
                      <input type="hidden" class="form-control form-control-md" name="barangay_text" id="barangay-text" required>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <div class="col-lg-12">
                      <input type="text" class="form-control form-control-md @error('street_text') is-invalid @enderror" name="street_text" id="street-text" placeholder="House no. / Street">
                    </div>
                  </div>

                </fieldset>
              </div>
              <div class="col-lg-12">
                <fieldset>
                  <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter your password">
                </fieldset>
                @foreach ($errors->get('password') as $error)
                          <span class="text-danger"> * {{$error}}</span>
                        @endforeach
              </div>
              <div class="col-lg-12">
                <fieldset>
                  <input type="password" name="password_confirmation" id="password_confirmation" class="form-control @error('password') is-invalid @enderror" placeholder="Confirm your password">
                </fieldset>
                @foreach ($errors->get('password') as $error)
                          <span class="text-danger"> * {{$error}}</span>
                        @endforeach
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
                  <button type="submit" id="form-submit" class="main-button">Sign Up</button>
                </fieldset>
              </div>
              <div class="col-lg-12 mt-2"  >
                <a href="{{route('login')}}"  style="float: right;"> Already have account? Log in</a>
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