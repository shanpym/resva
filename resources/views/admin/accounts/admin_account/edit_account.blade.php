@extends('admin.layout')
@section('title', 'CCST | Resva')
@section('content')
    
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Edit Account</h1>
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
        <img src="{{asset('dashboard/assets/img/success-3.gif')}}"alt="" srcset="" width="25px" style="margin-right: 10px">{{session('success')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif
    </div>
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
            @foreach ($users as $user)
                @include('admin.accounts.admin_account.profile')
            @endforeach
         

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