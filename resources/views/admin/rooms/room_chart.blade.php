@extends('admin.layout')
@section('title', 'CCST | Resva')
@section('content')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>Room Chart</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Pages</li>
          <li class="breadcrumb-item active">Room Chart</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    
    <div class="col-md-12 d-flex justify-content-end">
     
      <div class="col-sm-2" style="font-size: 16px; margin-right:20px !important" >
        <input type="text" name="" id="search_date" class="form-control" placeholder="Filter by date">
      </div>
      @if(Auth::user()->level == '2')
      @else
      <div class="col-sm-0">
        <a href="{{route('rooms.add_room')}}" class="btn btn-primary" type="button">Add Room</a>
      </div>
      <div class="col-sm-0">
        <a href="{{route('view.rooms')}}" class="btn btn-outline-info" type="button" style="margin-left:15px !important" >Edit</a>
      </div>
      @endif
     
    </div>
    <div class="mt-2">
      @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <img src="{{asset('dashboard/assets/img/error.png')}}"alt="" srcset="" width="25px" style="margin-right: 10px">{{ $errors->all()[0] }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif
      </style>
      @if(session()->has('error'))
        <div id="alert-success" class="alert alert-danger alert-dismissible fade show"><i class="fas fa-exclamation-circle"></i> {{session('error')}}</div>
      @endif
      @if(session()->has('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <img src="{{asset('dashboard/assets/img/success-3.gif')}}"alt="" srcset="" width="25px" style="margin-right: 10px">{{session('success')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif
    </div>
    <div class="alert alert-warning mt-3">
      <h5><i class="bi bi-info-circle-fill" style="font-size: 34px"></i><p>Indication for the room availability: </p></h5>
      <button class="btn btn-primary" type="button">Booked</button> 
      <button class="btn btn-outline-secondary" type="button">Available</button> 
    </div>
    <section class="section mt-3">
      <div class="row">
        <div class="col-lg-9">

          <div class="card">
            {{-- <div class="card-body">
              @foreach ($room_types as $room_type)
                  <div class="row">
                      <h5 class="card-title p-3   mt-3">{{$room_type->name}}</h5>
                  </div>    
                  <div class="row">  
                  @forelse ($rooms as $room)
                  @if ($room->room_type == $room_type->name)
                  
                  <div class="col-md-1">
                    <form action="{{url('/rooms/list/' . $room->id)}}" method="POST">
                      @csrf
                      @method('PUT')
                      <input type="hidden" class="fetch_date " name="fetch_date" value="">
                        <button type="submit" class="btn btn-outline-secondary p-5" type="button">
                             {{$room->name}}
                        </button>
                        <input type="hidden" class="roomname" value="{{$room->name}}">
                      </form>
                  </div>
                  
                    @endif
                @endforeach
              </div>
                  <hr>
                   @endforeach
            </div> --}}
            <div class="card-body">
              <div class="col-6 go left">
                <h5 class="card-title col-12">All Rooms <span class="text-muted"> Check In: after 3:00PM | Check Out: before 3:00PM</span></h5> 
              </div>
              <div class="row g-1">
                @foreach ($room_types as $room_type)
                      @forelse ($rooms as $room)
                        @if ($room->room_type == $room_type->name)
                          <div class="col-md-2 text-center">
                            <form action="{{url('/rooms/list/' . $room->id)}}" method="POST">
                              @csrf
                              @method('PUT')
                              <input type="hidden" class="fetch_date " name="fetch_date" value="">
                                <button type="submit" class="btn btn-outline-secondary rounded-0 m-1 " type="button" style="width: 170px; height:170px ">
                                    {{$room->name}} <br> <small>({{$room->room_type}})</small>
                                </button>
                                <input type="hidden" class="roomname" value="{{$room->name}}">
                            </form>
                          </div>
                        @endif
                      @endforeach
                @endforeach
              </div>
          
            </div>
          </div>

        </div>
    </section>


  </main><!-- End #main -->

  

  <script>
    $(function() {
     var csrfToken = $('meta[name="csrf-token"]').attr('content');
     
     $("#search_date").datepicker({
         dateFormat: 'yy-mm-dd',
         onSelect: function(selectedDate) {
             var searchDate = $('#search_date').val();
             $.ajax({
                 url: '/search/date',
                 type: 'GET',
                 data: { 
                     search_date: selectedDate ,
                     _token: csrfToken 
                 },
                 dataType: 'json',
                 success: function(response) {
                   $('.fetch_date').val(searchDate); // Update all fetch_date inputs
                     $('.roomname').each(function() {
                         var roomname = $(this).val();
                         console.log("roomname:", roomname);
                         console.log("response:", response);
                        
                         if (response && response.length > 0) {
                             if (response.includes(roomname)) {
                                 $(this).prev('.btn').removeClass('btn btn-outline-secondary').addClass('btn btn-primary');
                             } else {
                                 $(this).prev('.btn').removeClass('btn btn-primary').addClass('btn btn-outline-secondary');
                             }
                         } else {
                             $(this).prev('.btn').removeClass('btn btn-primary').addClass('btn btn-outline-secondary');
                         }
                     });
                 },
                 error: function(xhr, status, error) {
                     console.error(xhr.responseText);
                 }
             });
         }
     });
 
   
 
 
 });
 
 
   </script>
@endsection