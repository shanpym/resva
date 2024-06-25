<div class="card">
    <div class="card-body">
      <?php
        $about = $appearance->where('id', '2')->first();
        $about1 = $appearance->where('id', '2')->first();
        $about2 = $appearance->where('id', '3')->first();
        $about3 = $appearance->where('id', '4')->first();
        $about4 = $appearance->where('id', '5')->first();
      ?>
      <h5 class="card-title">Service Section</h5>
        <div class="row mb-3">
            <label for="inputNumber" class="col-sm-2 col-form-label">Background Upload</label>
            <div class="col-sm-10">
              <div class="col-sm-10">
                <div class="col-md-1" id="image-about-bg">
                  <button class="btn btn-sm btn-outline-info" type="button" id="img-btn-about-bg"><i class="bi bi-pencil-square"  style="font-size: 20px"></i></button>
              </div>
              <div class="col-md-3" id="image-file-about-bg">
                  @if($about->about_background)
                  <img src="{{ asset('storage/img/'.$about->about_background) }}" style="height: 150px;width:200px;">
                  @else 
                  <span>No image found!</span>
                  @endif
              </div>
              <div id="image-input-about-bg" style="display: none">
                <input class="form-control" type="file" name="about_background" value="{{$about->about_background}}">
              </div>
            </div>
          </div>
        <div class="row mb-3 mt-5">
            <label for="inputNumber" class="col-sm-2 col-form-label">Character Upload</label>
            <div class="col-sm-10">
              <div class="col-sm-10">
                <div class="col-md-1" id="image-about-char">
                    <button class="btn btn-sm btn-outline-info" type="button" id="img-btn-about-char"><i class="bi bi-pencil-square"  style="font-size: 20px"></i></button>
                </div>
                <div class="col-md-3" id="image-file-about-char">
                    @if($about->about_character)
                    <img src="{{ asset('storage/img/'.$about->about_character) }}" style="height: 150px;width:200px;">
                    @else 
                    <span>No image found!</span>
                    @endif
                </div>
                <div id="image-input-about-char" style="display: none">
                  <input class="form-control" type="file" name="about_character" value="{{$about->about_character}}">
                </div>
            </div>
          </div>
       
       <div class="row mt-5">
          <div class=" col-xl-6">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">1</h5>
                <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-2 col-form-label">Icon Upload</label>
                  <div class="col-sm-10">
                    <div class="col-md-1" id="image-icon-1">
                      <button class="btn btn-sm btn-outline-info" type="button" id="img-btn-icon-1"><i class="bi bi-pencil-square"  style="font-size: 20px"></i></button>
                    </div>
                    <div class="col-md-3" id="image-file-icon-1">
                        @if($about1->about_icon)
                        <img src="{{ asset('storage/img/'.$about1->about_icon) }}" style="height: 150px;width:200px;">
                        @else 
                        <span>No image found!</span>
                        @endif
                    </div>
                    <div id="image-input-icon-1" style="display: none">
                      <input class="form-control" type="file" name="about_icon_1" value="{{$about1->about_icon}}">
                    </div>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Title</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="about_name_1" value="{{$about1->about_name}}" maxlength="25">
                  </div>
                </div>
                <div class="row mb-3">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" style="height: 100px" name="about_description_1" maxlength="60">{{$about1->about_description}}</textarea>
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
                  <label for="inputNumber" class="col-sm-2 col-form-label">Icon Upload</label>
                  <div class="col-sm-10">
                    <div class="col-md-1" id="image-icon-2">
                      <button class="btn btn-sm btn-outline-info" type="button" id="img-btn-icon-2"><i class="bi bi-pencil-square"  style="font-size: 20px"></i></button>
                    </div>
                    <div class="col-md-3" id="image-file-icon-2">
                        @if($about2->about_icon)
                        <img src="{{ asset('storage/img/'.$about2->about_icon) }}" style="height: 150px;width:200px;">
                        @else 
                        <span>No image found!</span>
                        @endif
                    </div>
                    <div id="image-input-icon-2" style="display: none">
                      <input class="form-control" type="file" name="about_icon_2" value="{{$about2->about_icon}}">
                    </div>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Title</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="about_name_2" value="{{$about2->about_name}}" maxlength="25">
                  </div>
                </div>
                <div class="row mb-3">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" style="height: 100px" name="about_description_2" maxlength="60">{{$about2->about_description}}</textarea>
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
                <label for="inputNumber" class="col-sm-2 col-form-label">Icon Upload</label>
                <div class="col-sm-10">
                  <div class="col-md-1" id="image-icon-3">
                    <button class="btn btn-sm btn-outline-info" type="button" id="img-btn-icon-3"><i class="bi bi-pencil-square"  style="font-size: 20px"></i></button>
                  </div>
                  <div class="col-md-3" id="image-file-icon-3">
                      @if($about3->about_icon)
                      <img src="{{ asset('storage/img/'.$about3->about_icon) }}" style="height: 150px;width:200px;">
                      @else 
                      <span>No image found!</span>
                      @endif
                  </div>
                  <div id="image-input-icon-3" style="display: none">
                    <input class="form-control" type="file" name="about_icon_3" value="{{$about3->about_icon}}">
                  </div>
                </div>
              </div>
              <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Title</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="about_name_3" value="{{$about3->about_name}}" maxlength="25">
                </div>
              </div>
              <div class="row mb-3">
                  <label for="inputPassword" class="col-sm-2 col-form-label">Description</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" style="height: 100px" name="about_description_3" maxlength="60">{{$about3->about_description}}</textarea>
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
                <label for="inputNumber" class="col-sm-2 col-form-label">Icon Upload</label>
                <div class="col-sm-10">
                  <div class="col-md-1" id="image-icon-4">
                    <button class="btn btn-sm btn-outline-info" type="button" id="img-btn-icon-4"><i class="bi bi-pencil-square"  style="font-size: 20px"></i></button>
                  </div>
                  <div class="col-md-3" id="image-file-icon-4">
                      @if($about4->about_icon)
                      <img src="{{ asset('storage/img/'.$about4->about_icon) }}" style="height: 150px;width:200px;">
                      @else 
                      <span>No image found!</span>
                      @endif
                  </div>
                  <div id="image-input-icon-4" style="display: none">
                    <input class="form-control" type="file" name="about_icon_4" value="{{$about4->about_icon}}">
                  </div>
                </div>
              </div>
              <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Title</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="about_name_4" value="{{$about4->about_name}}" maxlength="25">
                </div>
              </div>
              <div class="row mb-3">
                  <label for="inputPassword" class="col-sm-2 col-form-label">Description</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" style="height: 100px" name="about_description_4" maxlength="60">{{$about4->about_description}}</textarea>
                  </div>
              </div>
            </div>
          </div>
        </div>
     </div>
    </div>
  </div>
