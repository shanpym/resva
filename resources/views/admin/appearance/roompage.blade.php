<div class="card">
    <div class="card-body">
      <h5 class="card-title">Room Section</h5>
      <?php
      $findRoom = DB::table('appearance')->where('id', '7')->first();
      $room1 = DB::table('room_type')->where('id', $findRoom->room_id)->first();

      $findRoom2 = DB::table('appearance')->where('id', '8')->first();
      $room2 = DB::table('room_type')->where('id', $findRoom2->room_id)->first();

      $findRoom3 = DB::table('appearance')->where('id', '9')->first();
      $room3 = DB::table('room_type')->where('id', $findRoom3->room_id)->first();

      $findRoom4 = DB::table('appearance')->where('id', '10')->first();
      $room4 = DB::table('room_type')->where('id', $findRoom4->room_id)->first();



      ?>
      <div class="row">
        <div class=" col-xl-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">1</h5>
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Select</label>
                <div class="col-sm-10">
                  <select class="form-select" aria-label="Default select example" name="room_id_1">
                    <option value="{{$room1->id}}" selected>{{$room1->name}}</option>
                    <option  disabled>Select a Room to display</option>
                    @foreach ($rooms as $room)
                    <option value="{{$room->id}}">{{$room->name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class=" col-xl-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">2</h5>
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Select</label>
                <div class="col-sm-10">
                  <select class="form-select" aria-label="Default select example" name="room_id_1">
                    <option value="{{$room2->id}}" selected>{{$room2->name}}</option>
                    <option  disabled>Select a Room to display</option>
                    @foreach ($rooms as $room)
                    <option value="{{$room->id}}">{{$room->name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>
     </div>
     <div class="row">
      <div class=" col-xl-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">3</h5>
            <div class="row mb-3">
              <label class="col-sm-2 col-form-label">Select</label>
              <div class="col-sm-10">
                <select class="form-select" aria-label="Default select example" name="room_id_1">
                  <option value="{{$room3->id}}" selected>{{$room3->name}}</option>
                  <option  disabled>Select a Room to display</option>
                  @foreach ($rooms as $room)
                  <option value="{{$room->id}}">{{$room->name}}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class=" col-xl-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">4</h5>
            <div class="row mb-3">
              <label class="col-sm-2 col-form-label">Select</label>
              <div class="col-sm-10">
                <select class="form-select" aria-label="Default select example" name="room_id_1">
                  <option value="{{$room4->id}}" selected>{{$room4->name}}</option>
                  <option  disabled>Select a Room to display</option>
                  @foreach ($rooms as $room)
                  <option value="{{$room->id}}">{{$room->name}}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>
   </div>

    </div>
  </div>
