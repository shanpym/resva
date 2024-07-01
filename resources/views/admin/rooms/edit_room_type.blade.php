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
        <div class="col-lg-8" id="room_type_edit">
            <div class="card">
                <div class="card-body">
                    
                  @foreach ($room_types as $room_type)
                    <h5 class="card-title">Edit <b>{{$room_type->name}}</b></h5>
                  <!-- Multi Columns Form -->
                  <form action="{{url('/rooms/update/' . $room_type->id)}}" method="POST" enctype="multipart/form-data" class="row g-3">
                    @csrf
                    @method('PUT')
                    <div class="col-md-12">
                      <label for="inputName5" class="form-label">Image</label>
                        <div class="row d-flex">
                            <div class="col-md-1" id="image">
                                <button class="btn btn-sm btn-outline-info" type="button" id="img-btn"><i class="bi bi-pencil-square"  style="font-size: 20px"></i></button>
                            </div>
                            <div class="col-md-3" id="image-file">
                                @if($room_type->image)
                                <img src="{{ asset('storage/img/'.$room_type->image) }}" style="height: 150px;width:200px;">
                                @else 
                                <span>No image found!</span>
                                @endif
                            </div>
                            
                        </div>
                        <div id="image-input" style="display: none">
                            <input class="form-control @error('image') is-invalid @enderror" type="file" name="image" value="{{$room_type->image}}">
                        </div>
                      
                    </div>
                    <div class="col-md-6">
                      <label for="" class="form-label">Name</label>
                      <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$room_type->name}}">
                    </div>
                    <div class="col-md-6">
                      <label for="" class="form-label">Price</label>
                      <input type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{$room_type->price}}">
                    </div>
                    <div class="col-12">
                      <label for="" class="form-label">Description</label>
                      <input type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{$room_type->description}}">
                    </div>
                    <div class="col-md-4">
                      <label for="" class="form-label">Total Sleep/s</label>
                      <input type="text" class="form-control @error('total_sleeps') is-invalid @enderror" name="total_sleeps" value="{{$room_type->total_sleeps}}">
                    </div>
                    <div class="col-md-2">
                      <label for="inputState" class="form-label">Bed</label>
                      <input type="text" class="form-control @error('bed') is-invalid @enderror" name="bed" value="{{$room_type->bed}}">
                    </div>
                    <div class="col-md-2">
                        <label for="inputState" class="form-label">Restroom</label>
                        <input type="text" class="form-control @error('restroom') is-invalid @enderror" name="restroom" value="{{$room_type->restroom}}">
                    </div>
                    <div class="col-md-2">
                        <label for="inputState" class="form-label">Wifi</label>
                        <select name="wifi" class="form-select @error('wifi') is-invalid @enderror">
                            <option value="{{$room_type->wifi}}" selected>
                                @if($room_type->wifi == '1')
                                    Yes
                                @else
                                    No
                                @endif
                            </option>
                            <option disabled>Choose...</option>
                            <option value="1">Yes</option>
                            <option value="2">No</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="inputState" class="form-label">AC</label>
                        <select name="ac" class="form-select" @error('ac') is-invalid @enderror>
                            <option value="{{$room_type->ac}}" selected>
                                @if($room_type->ac == '1')
                                    Yes
                                @else
                                    No
                                @endif
                            </option>
                          <option  disabled>Choose...</option>
                          <option value="1">Yes</option>
                          <option value="2">No</option>
                        </select>
                    </div>
                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="gridCheck">
                        <label class="form-check-label" for="gridCheck">
                          Check me out
                        </label>
                      </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <a href="{{route('rooms.room_type')}}" class="btn btn-light" type="button" id="backButton"  style="margin-right: 8px;">Cancel</a>
                        <button class="btn btn-primary" type="submit" id="nextButton" >Save Changes</button>
                    </div>
                </form><!-- End Multi Columns Form -->
                @endforeach
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
          });
          
          $('#room_type_btn').on('click', function(){
            $('#room_type_list').hide();
            $('#room_type_add').show();
          });

          $('#img-btn').on('click', function(){
            $('#image, #image-file').hide();
            $('#image-input').show();
          });
</script>
@endsection