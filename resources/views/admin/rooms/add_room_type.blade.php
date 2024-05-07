<div class="col-lg-12" id="room_type_add" style="display: none">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">New Room Type</h5>
          <!-- Multi Columns Form -->
          <form action="{{route('room_type.post')}}" method="POST" enctype="multipart/form-data" class="row g-3">
            @csrf
            <div class="col-md-12">
              <label for="inputName5" class="form-label">Image</label>
              <input class="form-control @error('image') is-invalid @enderror" type="file" name="image" value="">
            </div>
            <div class="col-md-6">
              <label for="" class="form-label">Name</label>
              <input type="text" class="form-control @error('name') is-invalid @enderror" name="name">
            </div>
            <div class="col-md-6">
              <label for="" class="form-label">Price</label>
              <input type="text" class="form-control @error('price') is-invalid @enderror" name="price">
            </div>
            <div class="col-12">
              <label for="" class="form-label">Description</label>
              <input type="text" class="form-control @error('description') is-invalid @enderror" name="description" placeholder="1234 Main St">
            </div>
            <div class="col-md-4">
              <label for="" class="form-label">Total Sleep/s</label>
              <input type="text" class="form-control @error('total_sleeps') is-invalid @enderror" name="total_sleeps" value="2">
            </div>
            <div class="col-md-2">
              <label for="inputState" class="form-label">Bed</label>
              <input type="text" class="form-control @error('bed') is-invalid @enderror" name="bed" value="1">
            </div>
            <div class="col-md-2">
                <label for="inputState" class="form-label">Restroom</label>
                <input type="text" class="form-control @error('restroom') is-invalid @enderror" name="restroom" value="1">
            </div>
            <div class="col-md-2">
                <label for="inputState" class="form-label">Wifi</label>
                <select name="wifi" class="form-select @error('wifi') is-invalid @enderror">
                  <option selected disabled>Choose...</option>
                  <option value="1">Yes</option>
                  <option value="2">No</option>
                </select>
            </div>
            <div class="col-md-2">
                <label for="inputState" class="form-label">AC</label>
                <select name="ac" class="form-select" @error('ac') is-invalid @enderror>
                  <option selected disabled>Choose...</option>
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
                <button class="btn btn-primary" type="submit" id="nextButton" >Submit</button>
            </div>
          </form><!-- End Multi Columns Form -->

        </div>

    </div>
</div>

