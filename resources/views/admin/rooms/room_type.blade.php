@extends('admin.layout')
@section('title', 'CCST | Resva')
@section('content')
    
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Room Management</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Pages</li>
          <li class="breadcrumb-item active">Room Type</li>
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
        <div id="alert-success" class="alert alert-danger alert-dismissible fade show"><i class="fas fa-exclamation-circle"></i> {{session('error')}}</div>
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
        <div class="col-lg-12" id="room_type_list">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-6 go left">
                  <h5 class="card-title col-6">All Room Type</h5>
                </div>
                <div class="col-6 text-end mt-3">
                    <button type="button" class="btn btn-primary mb-3" id="room_type_btn">Add</button>
                </div>
              </div>
            <style>
              td{
                color: #8c939b !important;
                padding-top: 15px !important;
              }
            </style>

            <!-- Table with hoverable rows -->
            <table class="table datatable table-hover">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col" >Image</th>
                  <th scope="col" >Name</th>
                  <th scope="col">Total Room/s</th>
                  <th scope="col">Price</th>
                  <th scope="col" style="width: 10%; !important;">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($room_types as $room_type)
                <tr>
                  <th scope="row" style="color: #0d6efd !important;">{{$room_type->id}}</th>
                  <td>
                    @if($room_type->image)
                    <img src="{{ asset('storage/img/'.$room_type->image) }}" style="height: 150px;width:200px;">
                    @else 
                    <span>No image found!</span>
                    @endif
                  </td>
                  <td>{{$room_type->name}}</td>
                  
                  <?php 
                  $rooms = DB::table('rooms')->where('room_type', $room_type->name)->get();
                  ?>
                  
                  <td>
                    {{$rooms->count()}}
                  </td>
                  <td>PHP{{$room_type->price}}</td>
                  <td style="padding-top: 10px !important;">
                    <a href="{{url('/rooms/update/' . $room_type->id)}}" class="btn btn-sm btn-outline-info" type="button"><i class="bi bi-pencil-square"  style="font-size: 20px"></i></a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <!-- End Table with hoverable rows -->
            {{-- <div class="row">
              {{$room_types->links()}}
            </div> --}}
            </div>
          </div>

        </div>

        
        @include('admin.rooms.add_room_type')
        {{-- @include('admin.rooms.meals') --}}
      </div>
    </section>

  </main><!-- End #main -->
  
<script>
      
    var i = 0;
    $('#add').click(function(){
      
      ++i;
      $('#table').append(
        `<tr>
          <td>
            <input type="text" class="form-control" id="" name="inputs[`+i+`][name]">
          </td>
          <td>
            <input type="text" class="form-control price" id="price[`+i+`]" name="inputs[`+i+`][price]" >
          </td>
          <td>
            <input type="text" class="form-control room_type_id" id="room_type_id[`+i+`]" name="inputs[`+i+`][room_type_id]" >
          </td>       
          <td><button type="button" class="btn btn-danger remove-table-row" name="remove" class="remove" id="remove">Remove</button></td>`
            

      )
      var room_type_id = $('#room_value').val();
      $('.room_type_id').val(room_type_id);
    });
    $(document).on('click', '.remove-table-row', function(){
      $(this).parents('tr').remove();
    })
    $('#room_value').change(function(){
              var room_type_id = $(this).val();
              $('.room_type_id').val(room_type_id);
          });
          
          $('#add_meals_btn').on('click', function(){
              $('#meals_list').hide();
              $('#add_meals').show();
          })
          $('#cancel_btn').on('click', function(){
              $('#add_meals').hide();
              $('#meals_list').show();
          })
          
          $('#room_type_btn').on('click', function(){
            $('#room_type_list').hide();
            $('#room_type_add').show();
          })
</script>
@endsection