@extends('admin.layout')
@section('title', 'CCST | Resva')
@section('content')
    
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Add Room</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Pages</li>
          <li class="breadcrumb-item active">Add Room</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Room Details</h5>
              <form action="{{route('add_chart.post')}}" method="POST">
                @csrf 
                <div class="card-body">   
                  <div class="col-sm-2">
                    <select class="form-select mb-2 " id="room_value">
                      <option value="" selected disabled>Select Room Type</option>
                      @foreach ($room_types as $room_type)
                      <option value="{{$room_type->name}}">{{$room_type->name}}</option>
                      
                      @endforeach
                    </select> 
                  </div>
                  
                  <hr>
                <table class="table table table-bordered" id="table">
                  <tr>
                    <th>Name</th>
                    <th>Status</th>
                    {{-- <th>Adult</th>
                    <th>Children</th> --}}
                    {{-- <th>Floor No.</th> --}}
                    <th>Type</th>
                    <th>Action</th>
                  </tr>
                  <tr>
                    <td><input type="text" class="form-control" id="" name="inputs[0][name]" value="{{ old('name') }}">  </td>
                    <td> <select class="form-select" name="inputs[0][status]" id="">
                      <option value="">Select Status</option>
                      <option value="1" selected>Available</option>
                      <option value="2">Booked</option>
                      </select> </td>
                      {{-- <td><input type="text" class="form-control" id="" name="inputs[0][floor_no]" value="">  </td> --}}
                      <td><input type="text" class="form-control room_type" id="room_type[0]" name="inputs[0][room_type]" >  </td>
                    <td><button type="button" class="btn btn-success" name="add" id="add">Add Room</button></td>
                  </tr>
                </table>
                <!-- /.card-body -->
                <div class="modal-footer justify-content-right">
                  <button type="submit" class="btn btn-primary">Save</button>
                </div>
              </form>
            </div>
          </div>

        </div>
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
        <td> <select class="form-select" name="inputs[`+i+`][status]" id="">
                    <option value="">Select Status</option>
                    <option value="1" selected>Available</option>
                    <option value="2">Booked</option>
                    </select> </td>
         <td>
          <input type="text" class="form-control room_type" id="room_type[`+i+`]" name="inputs[`+i+`][room_type]" >
        </td>
                  
        <td><button type="button" class="btn btn-danger remove-table-row" name="remove" class="remove" id="remove">Remove</button></td>`
          

    )
    var roomname = $('#room_value').val();
    $('.room_type').val(roomname);
  });
  $(document).on('click', '.remove-table-row', function(){
    $(this).parents('tr').remove();
  })
  $('#room_value').change(function(){
            var roomname = $(this).val();
            $('.room_type').val(roomname);
        });

</script>
@endsection