<div class="card">
    <div class="card-body">
      <?php
        $service = DB::table('appearance')->where('id', '6')->first();
      ?>
      <h5 class="card-title">About Section</h5>
        <div class="row mb-3">
          <label for="inputNumber" class="col-sm-2 col-form-label">File Upload</label>
          <div class="col-sm-10">
            <div class="col-md-1" id="image-service">
              <button class="btn btn-sm btn-outline-info" type="button" id="img-btn-service"><i class="bi bi-pencil-square"  style="font-size: 20px"></i></button>
            </div>
            <div class="col-md-3" id="image-file-service">
                @if($service->service_image)
                <img src="{{ asset('storage/img/'.$service->service_image) }}" style="height: 150px;width:200px;">
                @else 
                <span>No image found!</span>
                @endif
            </div>
            <div id="image-input-service" style="display: none">
              <input class="form-control" type="file" name="service_image" value="{{$service->service_image}}">
            </div>
          </div>
        </div>
        <div class="row mb-3">
          <label for="inputText" class="col-sm-2 col-form-label">Title</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="service_name" value="{{$service->service_name}}" maxlength="50">
          </div>
        </div>
        <div class="row mb-3">
          <label for="inputText" class="col-sm-2 col-form-label" style=" color: #03a4ed; font-weight: 700;
                text-transform: uppercase;">Highlight Word</label> 
          <div class="col-sm-10">
            <input type="text" class="form-control" name="service_description_highlight_1" value="{{$service->service_description_highlight_1}}">
          </div>
        </div>
        <div class="row mb-3">
          <label for="inputText" class="col-sm-2 col-form-label" style=" color: #0275d8; font-weight: 700;
                text-transform: uppercase;">Highlight Word</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="service_description_highlight_2" value="{{$service->service_description_highlight_2}}">
          </div>
        </div>
        <div class="row mb-3">
          <label for="inputPassword" class="col-sm-2 col-form-label">Description</label>
          <div class="col-sm-10">
            <textarea class="form-control" style="height: 100px" name="service_description" maxlength="100">{{$service->service_description}}</textarea>
          </div>
        </div>
       

    </div>
  </div>
