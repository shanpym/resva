<div class="card">
    <div class="card-body">
      <h5 class="card-title">Hero Section</h5>
      <?php
        $hero = DB::table('appearance')->where('id', '1')->first();
      ?>
        <div class="row mb-3">
          <label for="inputText" class="col-sm-2 col-form-label">Welcome Text</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="hero_welcome" value="{{$hero->hero_welcome}}" maxlength="30"> 
          </div>
        </div>
        <div class="row mb-3">
          <label for="inputText" class="col-sm-2 col-form-label" style=" color: #03a4ed; font-weight: 700;
            text-transform: uppercase;"></label>
          <div class="col-sm-10">
            <span class="text-muted"> <span class="text-danger">*</span><i>Note: Must be in JPEG, JPG, PNG format. Max KB is 2048.</i></span>
          </div>
        </div>
        
        <div class="row mb-3">
          <label for="inputNumber" class="col-sm-2 col-form-label">File Upload</label>
            <div class="col-sm-10">
              <div class="col-md-1" id="image">
                <button class="btn btn-sm btn-outline-info" type="button" id="img-btn"><i class="bi bi-pencil-square"  style="font-size: 20px"></i></button>
            </div>
            <div class="col-md-3" id="image-file">
                @if($hero->hero_image)
                <img src="{{ asset('storage/img/'.$hero->hero_image) }}" style="height: 150px;width:200px;">
                @else 
                <span>No image found!</span>
                @endif
            </div>
            <div id="image-input" style="display: none">
              <input class="form-control" type="file" name="hero_image" value="{{$hero->hero_image}}">
            </div>
          </div>
        </div>
        
        <div class="row mb-3">
          <label for="inputPassword" class="col-sm-2 col-form-label">Motto</label>
          <div class="col-sm-10">
            <textarea class="form-control" style="height: 100px" name="hero_motto" maxlength="30">{{$hero->hero_motto}}</textarea>
          </div> 
        </div>
        <div class="row mb-3">
          <label for="inputText" class="col-sm-2 col-form-label" style=" color: #03a4ed; font-weight: 700;
            text-transform: uppercase;"></label>
          <div class="col-sm-10">
            <span class="text-muted"> <span class="text-danger">*</span><i>Note: Hightlighted words must match words from Motto</i></span>
          </div>
        </div>
       
        <div class="row mb-3">
          <label for="inputText" class="col-sm-2 col-form-label" style=" color: #03a4ed; font-weight: 700;
                text-transform: uppercase;">Highlight Word</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="hero_motto_highlight_1" value="{{$hero->hero_motto_highlight_1}}">
          </div>
        </div>
        <div class="row mb-3">
          <label for="inputText" class="col-sm-2 col-form-label" style=" color: #0275d8; font-weight: 700;
                text-transform: uppercase;">Highlight Word</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="hero_motto_highlight_2" value="{{$hero->hero_motto_highlight_2}}">
          </div>
        </div>
        <div class="row mb-3">
            <label for="inputText" class="col-sm-2 col-form-label">Description Text</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="hero_description" value="{{$hero->hero_description}}"  maxlength="90">
            </div>
          </div>


    </div>
  </div>
