@extends('admin.layout')
@section('title', 'CCST | Resva')
@section('content')
    
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Add Account</h1>
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
        <img src="{{asset('dashboard/assets/img/success-3.gif')}}"alt="" srcset="" width="25px" style="margin-right: 10px">{{session('success')}}. <a href="{{route('admin.list')}}" type="button"> View</a>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif
    </div>
    <section class="section">
      <div class="row">
        <div class="col-lg-6">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Personal Information</h5>
                  <!-- Profile Edit Form -->
                  <form action="{{route('admin_account.post')}}" method="POST">
                    @csrf
                    <input type="hidden" name="level" value="1">
                    <div class="row mb-3">
                      <label for="" class="col-md-4 col-lg-3 col-form-label"><span style="color: #d9534f">*</span> Firstname</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror"  value="{{old('firstname')}}">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="" class="col-md-4 col-lg-3 col-form-label"><span style="color: #d9534f">*</span> Surname</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="surname" type="text" class="form-control @error('surname') is-invalid @enderror"  value="{{old('surname')}}">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="about" class="col-md-4 col-lg-3 col-form-label">About</label>
                      <div class="col-md-8 col-lg-9">
                        <textarea name="about" class="form-control @error('about') is-invalid @enderror" id="about" style="height: 100px"></textarea>
                      </div>
                    </div>
  
                      <div class="row mb-3 mt-5">
                        <label for="Address" class="col-md-4 col-lg-3 col-form-label"><span style="color: #d9534f">*</span> Address</label>
                        <div class="col-md-5">
                          <select name="region" class="form-control form-control-md @error('region_text') is-invalid @enderror" id="region"></select>
                          <input type="hidden" class="form-control form-control-md" name="region_text" id="region-text" required>
                        </div>
                        <div class="col-md-4">
                          <select name="province" class="form-control form-control-md @error('province_text') is-invalid @enderror" id="province" disabled>
                            <option value="" selected disabled>Choose State/Province</option>
                          </select>
                        <input type="hidden" class="form-control form-control-md" name="province_text" id="province-text" required>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="Address" class="col-md-4 col-lg-3 col-form-label"></label>
                        <div class="col-md-5">
                          <select name="city" class="form-control form-control-md @error('city_text') is-invalid @enderror" id="city" disabled>
                            <option value="" selected disabled>Choose City/Municipality</option>
                          </select>
                          <input type="hidden" class="form-control form-control-md" name="city_text" id="city-text" required>
                        </div>
                        <div class="col-md-4">
                          <select name="barangay" class="form-control form-control-md @error('barangay_text') is-invalid @enderror" id="barangay" disabled>
                            <option value="" selected disabled>Choose Barangay</option>
                          </select>
                          <input type="hidden" class="form-control form-control-md" name="barangay_text" id="barangay-text" required>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="Address" class="col-md-4 col-lg-3 col-form-label"><span style="color: #d9534f">*</span> House No.</label>
                        <div class="col-md-8 col-lg-9">
                          <input type="text" class="form-control form-control-md @error('street_text') is-invalid @enderror" name="street_text" id="street-text">
                        </div>
                      </div>

                    <div class="row mb-3 mt-5">
                      <label for="Phone" class="col-md-4 col-lg-3 col-form-label"><span style="color: #d9534f">*</span> Phone</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="phone_no" type="number" class="form-control @error('phone_no') is-invalid @enderror" id="Phone"  pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==11) return false;" value="{{old('phone_no')}}">
                      </div>
                    </div>
  
                    <div class="row mb-3">
                      <label for="Email" class="col-md-4 col-lg-3 col-form-label" ><span style="color: #d9534f">*</span> Email</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="Email" value="{{old('email')}}">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="birthdate" class="col-md-4 col-lg-3 col-form-label" ><span style="color: #d9534f">*</span> Birthdate</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="birthdate" type="date" class="form-control @error('birthdate') is-invalid @enderror" id="birthdate" value="{{old('birthdate')}}">
                      </div>
                    </div>

                    <div class="row mb-3 pt-3 ">
                      <label for="gender" class="col-md-4 col-lg-3 col-form-label" ><span style="color: #d9534f">*</span> Gender</label>
                      <div class="col-md-8 col-lg-9">
                        
                      <input name="gender"  type="radio" class="form-control-radio  @error('gender') is-invalid @enderror" id="1" value="1" 
                        {{ old('gender') == 'male' ? '1' : '' }}><label for="1" style="margin-left: 14px" >Male</label>
                    
                
                      <input name="gender" type="radio" class="form-control-radio @error('gender') is-invalid @enderror"  id="2" value="2" 
                          {{ old('gender') == 'female' ? '2' : '' }} style="margin-left: 25px" ><label for="2" style="margin-left: 14px" >Female</label>
                    

                      @error('gender')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                      </div>
                    </div>

                    <div class="row mb-3 pt-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label"><span style="color: #d9534f">*</span> New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="currentPassword" value="{{old('password')}}">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label"><span style="color: #d9534f">*</span> Confirm Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password_confirmation" type="password" class="form-control  @error('password_confirmation') is-invalid @enderror" id="newPassword">
                      </div>
                    </div>

                    <div class="text-end">
                      <button type="submit" class="btn btn-primary">Add Account</button>
                    </div>
                  </form><!-- End Profile Edit Form -->
            </div>
          </div>

        </div>

        <div class="col-lg-6">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Notes</h5>
              <p> Kindly fill out all of the fields with asterisks (<span style="color: #d9534f">*</span>).</p>
            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  
<script>

  var my_handlers = {
      // fill province
      fill_provinces: function() {
          //selected region
          var region_code = $(this).val();
  
          // set selected text to input
          var region_text = $(this).find("option:selected").text();
          let region_input = $('#region-text');
          region_input.val(region_text);
          //clear province & city & barangay input
          $('#province-text').val('');
          $('#city-text').val('');
          $('#barangay-text').val('');
          
          //province

          $('#province').prop("disabled", false);
          let dropdown = $('#province');
          dropdown.empty();
          dropdown.append('<option selected="true" disabled>Choose State/Province</option>');
          dropdown.prop('selectedIndex', 0);
  
          //city
          $('#city').prop("disabled", true);
          let city = $('#city');
          city.append('<option selected="true" disabled></option>');
          city.prop('selectedIndex', 0);
  
          //barangay
          $('#barangay').prop("disabled", true);
          let barangay = $('#barangay');
          barangay.append('<option selected="true" disabled></option>');
          barangay.prop('selectedIndex', 0);
  
          // filter & fill
          var url = '{{asset('dashboard/ph-json/province.json')}}';
          $.getJSON(url, function(data) {
              var result = data.filter(function(value) {
                  return value.region_code == region_code;
              });
  
              result.sort(function(a, b) {
                  return a.province_name.localeCompare(b.province_name);
              });
  
              $.each(result, function(key, entry) {
                  dropdown.append($('<option></option>').attr('value', entry.province_code).text(entry.province_name));
              })
  
          });
      },
      // fill city
      fill_cities: function() {
          //selected province
          var province_code = $(this).val();
  
          // set selected text to input
          var province_text = $(this).find("option:selected").text();
          let province_input = $('#province-text');
          province_input.val(province_text);
          //clear city & barangay input
          $('#city-text').val('');
          $('#barangay-text').val('');
  
          //city
          $('#city').prop("disabled", false);
          let dropdown = $('#city');
          dropdown.empty();
          dropdown.append('<option selected="true" disabled>Choose City/Municipality</option>');
          dropdown.prop('selectedIndex', 0);
  
          //barangay
          $('#barangay').prop("disabled", true);
          let barangay = $('#barangay');
          barangay.append('<option selected="true" disabled></option>');
          barangay.prop('selectedIndex', 0);
  
          // filter & fill
          var url = '{{asset('dashboard/ph-json/city.json')}}';
          $.getJSON(url, function(data) {
              var result = data.filter(function(value) {
                  return value.province_code == province_code;
              });
  
              result.sort(function(a, b) {
                  return a.city_name.localeCompare(b.city_name);
              });
  
              $.each(result, function(key, entry) {
                  dropdown.append($('<option></option>').attr('value', entry.city_code).text(entry.city_name));
              })
  
          });
      },
      // fill barangay
      fill_barangays: function() {
          // selected barangay
          var city_code = $(this).val();
  
          // set selected text to input
          var city_text = $(this).find("option:selected").text();
          let city_input = $('#city-text');
          city_input.val(city_text);
          //clear barangay input
          $('#barangay-text').val('');
  
          // barangay
          $('#barangay').prop("disabled", false);
          let dropdown = $('#barangay');
          dropdown.empty();
          dropdown.append('<option selected="true" disabled>Choose barangay</option>');
          dropdown.prop('selectedIndex', 0);
  
          // filter & Fill
          var url = '{{asset('dashboard/ph-json/barangay.json')}}';
          $.getJSON(url, function(data) {
              var result = data.filter(function(value) {
                  return value.city_code == city_code;
              });
  
              result.sort(function(a, b) {
                  return a.brgy_name.localeCompare(b.brgy_name);
              });
  
              $.each(result, function(key, entry) {
                  dropdown.append($('<option></option>').attr('value', entry.brgy_code).text(entry.brgy_name));
              })
  
          });
      },
  
      onchange_barangay: function() {
          // set selected text to input
          var barangay_text = $(this).find("option:selected").text();
          let barangay_input = $('#barangay-text');
          barangay_input.val(barangay_text);
      },
  
  };
  
  
  $(function() {
      // events
      $('#region').on('change', my_handlers.fill_provinces);
      $('#province').on('change', my_handlers.fill_cities);
      $('#city').on('change', my_handlers.fill_barangays);
      $('#barangay').on('change', my_handlers.onchange_barangay);
  
      // load region
      let dropdown = $('#region');
      dropdown.empty(); 
      dropdown.append('<option selected="true" disabled>Choose Region</option>');
      dropdown.prop('selectedIndex', 0);
      const url = '{{asset('dashboard/ph-json/region.json')}}';
      // Populate dropdown with list of regions
      $.getJSON(url, function(data) {
          $.each(data, function(key, entry) {
              dropdown.append($('<option></option>').attr('value', entry.region_code).text(entry.region_name));
          })
      });
  
  });
</script>
@endsection