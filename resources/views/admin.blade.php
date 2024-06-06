@extends('admin_layout')
@section('title', 'CCST | Resva')
@section('content')
<main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="card mb-3">

                <div class="card-body">
                  <style>
                    .home-title{
                      font-family: 'Poppins', sans-serif;
                      font-size: 42px;
                      font-weight: 700;
                      text-transform: uppercase;
                      color: #03a4ed;
                    }
                    .span-title{
                      font-family: 'Poppins', sans-serif !important;
                      color: #0275d8 !important;
                    }
                  </style>
                  <div class="pt-4 pb-2">
                    <a href="{{route('home')}}" class="logo">
                      <h4 class="home-title text-center">Res<span class="span-title">va</span></h4>
                    </a>
                    <p class="text-center small">Enter your email & password to login</p>
                  </div>
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
                  <form class="row g-3" action="{{route('admin_login.post')}}" method="post">
                    @csrf
                  
                    <div class="col-12 ">
                      <label for="" class="form-label">Email</label>
                      <div class="input-group has-validation">
                        <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="">
                      </div>
                    </div>

                    <div class="col-12">
                      <label class="form-label">Password</label>
                      <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror">
                    </div>

                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" value="true" id="show-password">
                        <label class="form-check-label" for="show-password">Show Password</label>
                      </div>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">Login</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Forgot Password? Contact your supervisor</p>
                    </div>
                  </form>

                </div>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <script>
  $(document).ready(function() {
    $('#show-password').on('change', function() {
      if ($('#show-password').is(':checked')) {
          $('#password').attr('type', 'text');
      } else {
          $('#password').attr('type', 'password');
      }
    });
    });

  </script>
@endsection