<section class="section profile">
    <div class="row">
      <div class="col-xl-12">

        <div class="card">
          <div class="card-body profile-card pt-4 d-flex flex-column">
            <h5 class="card-title"></h5>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <label for="" class="form-label text-muted"><span style="color: #d9534f">*</span> Name</label>
                        <input type="text" name="room_name" class="form-control @error('room_name') is-invalid @enderror" value="{{$room->name}}">
                      </div>
                      <div class="col-md-6">
                        <label for="inputState" class="form-label">Type</label>
                        <select name="room_type" class="form-select @error('room_type') is-invalid @enderror">
                        
                            <option value="{{$room->room_type}}" selected>{{$room->room_type}}</option>
                            <option  disabled>Select Room Type</option>
                            @foreach ($room_types as $room_type)
                            <option value="{{$room_type->name}}">{{$room_type->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>
</section>