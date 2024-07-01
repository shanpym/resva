@extends('admin.layout')
@section('title', 'CCST | Resva')
@section('content')
    
<main id="main" class="main">

    <div class="pagetitle">
      <h1>All Pending Booking</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Pages</li>
          <li class="breadcrumb-item active">Pending</li>
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
        @foreach ($bookings as $booking)
          <div class="col-lg-6">
            <div class="card">
              <div class="card-body">
               @include('admin.confirm_booking.cards')
               
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </section>

</main><!-- End #main -->

<script>
  
  $('.checkbtn').on('click', function(){
        var container = $(this).closest('.card-body');
        checkRoomsAvailability(container);
        $('.rooms-title').show();
        // $('.approve-btn').show();
        // $('.checkbtn').hide();
        $('.room_options').show();
    });
   
  function checkRoomsAvailability(container) {
    var start_date = $('.start_date').val();
    var end_date = $('.end_date').val(); 
    var booking_id = $('.booking_id').val();
    
        
    $.ajax({
        url: '/check/room/'  + booking_id,
        type: 'GET',
        dataType: 'json',
        data: {
            start_date: start_date,
            end_date: end_date,
        },
        success: function(response){
          
          $('.room_options').empty();
            if (response.length > 0) {
                $.each(response, function(index, availableRooms) {
                    var radioBtn = $('<input type="radio"/>')
                    .attr("class", "form-check-input")
                    .attr("name", "room_name")
                    .attr("id", "chart_" + availableRooms.name)
                    .val(availableRooms.name)
                    .css({
                        'width': '25px',
                        'height': '25px'
                      });
                    var label = $('<label></label>').attr("for","availableRooms_" + availableRooms.name)
                    .attr("class", "form-check-label")
                    .text(availableRooms.name)
                    .css({
                        'font-size': '20px',
                        'margin-left': '15px'
                      });;
                    $('.room_options').append(radioBtn).append(label).append('<br>');
                });
            } else {
                $('.room_options').text("No available rooms for selected dates.");
            }
        },
        error: function(xhr, status, error) {
            console.error("Error:", error);
            $('.room_options').text("Error occurred while fetching available rooms.");
        }
    });
}
</script>
@endsection