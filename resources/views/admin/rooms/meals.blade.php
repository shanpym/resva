<div class="col-lg-4">
    <div class="card">
        <div class="card-body" id="meals_list">
            <div class="row">
                <div class="col-6 go left">
                    <h5 class="card-title">Manage Meals</h5>
                </div>
                <div class="col-6 text-end mt-3">
                    <button class="btn btn-primary mb-3" type="button" id="add_meals_btn">Add</button>
                </div>
            </div>
            <style>
            td{
                color: #8c939b !important;
                padding-top: 15px !important;
            }
            </style>
            @foreach($room_types as $room_type)
                <h5 class="card-title">{{ $room_type->name }}</h5>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col" style="width: 20%;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($meals as $meal)
                            @if($room_type->name == $meal->room_type_id)
                                <tr>
                                    <td>{{ $meal->name }}</td>
                                    <td>{{ $meal->price }}</td>
                                    <td style="padding-top: 10px;">
                                        <a href="{{ url('/meals/delete/' . $meal->id) }}" class="btn btn-sm btn-outline-danger" type="button"><i class="bi bi-trash"></i></a>
                                    </td>
                                </tr> 
                            @endif
                        @empty
                            <tr>
                                <td colspan="3">No meals found for {{ $room_type->name }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{-- <div class="row">
                    {{$meals->links()}}
                </div> --}}
        @endforeach
        
            <!-- Table with hoverable rows -->
           
            <!-- End Table with hoverable rows -->

            
        </div>
        <div class="card-body" id="add_meals"  style="display: none">
            <h5 class="card-title">Manage Meals</h5>
            <form action="{{route('add_meals.post')}}" method="POST">
                @csrf 
                <div class="card-body">   
                <select class="custom-select mb-2" id="room_value" >
                    <option value="" selected disabled>Select Room Type</option>
                    @foreach ($room_types as $room_type)
                    <option value="{{$room_type->name}}">{{$room_type->name}}</option>
                    @endforeach
                </select> 
                
                <hr>
                <table class="table table table-bordered" id="table">
                  <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Action</th>
                  </tr>
                  <tr>
                    <td><input type="text" class="form-control" id="" name="inputs[0][name]" value=""></td>
                    <td><input type="text" class="form-control price" id="" name="inputs[0][price]" ></td>
                    <td><input type="text" class="form-control room_type_id" id="room_type_id[0]" name="inputs[0][room_type_id]" value=""></td>
                    <td><button type="button" class="btn btn-success" name="add" id="add">Add</button></td>
                  </tr>
                </table>
                <!-- /.card-body -->
                <div class="card-footer d-flex justify-content-end">
                  <button type="button" class="btn btn-light" style="margin-right: 15px" id="cancel_btn">Cancel</button>
                  <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
       
      </div>
    </div>
  </div>
