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
    <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
  </head>

<body>

  <!-- ***** Preloader Start ***** -->
  <div id="js-preloader" class="js-preloader">
    <div class="preloader-inner">
      <span class="dot"></span>
      <div class="dots">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </div>
  <!-- ***** Preloader End ***** -->
  @include('login.include.header')
  @yield('content')
  @include('login.include.footer')
  <!-- Scripts -->
  <script src="{{asset('home/vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('home/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('home/assets/js/owl-carousel.js')}}"></script>
  <script src="{{asset('home/assets/js/animation.js')}}"></script>
  <script src="{{asset('home/assets/js/imagesloaded.js')}}"></script>
  <script src="{{asset('home/assets/js/templatemo-custom.js')}}"></script>
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
        $(document).ready(function() {
          $('#show-password').on('change', function() {
            if ($('#show-password').is(':checked')) {
                $('#password, #password_confirmation').attr('type', 'text');
            } else {
                $('#password, #password_confirmation').attr('type', 'password');
            }
          });
          });
      
    </script>
</body>
</html>