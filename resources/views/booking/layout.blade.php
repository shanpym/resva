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


   <!-- Bootstrap core CSS -->
   <link href="{{asset('home/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

   <!-- Additional CSS Files -->
   <link rel="stylesheet" href="{{asset('home/assets/css/fontawesome.css')}}">
   <link rel="stylesheet" href="{{asset('home/assets/css/templatemo-space-dynamic.css')}}">
   <link rel="stylesheet" href="{{asset('home/assets/css/animated.css')}}">
   <link rel="stylesheet" href="{{asset('home/assets/css/owl.css')}}">
   <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
   <script src="{{asset('home/assets/js/animation.js')}}"></script>
   <script src="{{asset('home/assets/js/imagesloaded.js')}}"></script>
   <script src="{{asset('home/assets/js/templatemo-custom.js')}}"></script>
 
</head>

<body>

    @include('login.include.header')
    @yield('content')
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
</body>

</html>