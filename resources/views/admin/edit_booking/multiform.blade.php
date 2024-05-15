<!-- Bordered Tabs Justified -->
<div class="tab-content pt-2" id="borderedTabJustifiedContent">
  <div class="tab-pane fade show active" id="bordered-justified-reservation" role="tabpanel" aria-labelledby="reservation-tab">
    <h5 class="card-title"><small class="text-muted">Step 1:</small> Reservation Details</h5>
      <div class="card-body">
        @if ($booking->status == '2' || $booking->status == '5')
        <div class="col-md-4 mb-5" style="display: none">
          <h5 class="card-title"><small class="text-muted">Type of Resevervation</small></h5>
          <select id="resv_type" class="form-select @error('resv_type') is-invalid @enderror" name="resv_type">
            @if($booking->resv_type == '1')
            <option value="1" selected>Online</option>
                      @elseif($booking->resv_type == '2')
                      <option value="2" selected>On-call</option>
                      @elseif($booking->resv_type == '3')
                      <option value="3" selected>Walk-in</option>
                      @endif
            <option disabled >Choose...</option>
            <option value="1">Online</option>
            <option value="2">On-call</option>
            <option value="3">Walk-in</option>
          </select>
        </div>
        @else
        <div class="col-md-4 mb-5">
          <h5 class="card-title"><small class="text-muted">Type of Resevervation</small></h5>
          <select id="resv_type" class="form-select @error('resv_type') is-invalid @enderror" name="resv_type">
            @if($booking->resv_type == '1')
            <option value="1" selected>Online</option>
                      @elseif($booking->resv_type == '2')
                      <option value="2" selected>On-call</option>
                      @elseif($booking->resv_type == '3')
                      <option value="3" selected>Walk-in</option>
                      @endif
            <option disabled >Choose...</option>
            <option value="1">Online</option>
            <option value="2">On-call</option>
            <option value="3">Walk-in</option>
          </select>
        </div>
        <hr>
        
        @endif
        @if ($booking->status == '2' || $booking->status == '5')
      
        @include('admin.booking.extra_charges')
        <input type="hidden" name="requests" id="requests" value="{{$booking->requests}}" style="width: 40%; text-align:center">
        <input type="hidden" name="no_adult" id="no_adult" value="{{$booking->no_adult}}" style="width: 40%; text-align:center">
        <input type="hidden" name="no_children" id="no_children" value="{{$booking->no_children}}" style="width: 40%; text-align:center">
        <input type="hidden" name="start_date" class="form-control @error('start_date') is-invalid @enderror" id="start_date" placeholder="" value="{{$booking->start_date}}">
        <input type="hidden" name="end_date" class="form-control @error('end_date') is-invalid @enderror" id="end_date" placeholder="" value="{{$booking->end_date}}">
        @else
        
        <div class="row g-3">
          <div class="col-md-4">
            <label for="" class="form-label text-muted">Guest</label>
            <div class="dropdown">
              <button class="btn btn-outline-primary" id="dropdown_btn" type="button" style="width: 100%">
                Adult - {{$booking->no_adult}} Children - {{$booking->no_children}}
              </button>
              <ul class="dropdown-menu" id="dropdown_menu" style="display: none; width: 100%">
                <li>
                  <nav aria-label="..." style="margin: 0 auto; width: 70%;">
                    <h5 class="card-title"><small class="text-muted"> Adult </small></h5>
                    <div class="btn-group" role="group">
                      <button type="button" class="btn btn-light" id="dec-adult">-</button>
                      <input type="text" name="no_adult" id="no_adult" value="{{$booking->no_adult}}" style="width: 40%; text-align:center">
                      <button type="button" class="btn btn-primary" id="inc-adult">+</button>
                    </div>
                  </nav>
                </li>
                <li>
                  <nav aria-label="..." style="margin: 0 auto; width: 70%;">
                    <h5 class="card-title"><small class="text-muted"> Children </small></h5>
                    <div class="btn-group" role="group">
                      <button type="button" class="btn btn-light" id="dec-children">-</button>
                      <input type="text" name="no_children" id="no_children" value="{{$booking->no_children}}" style="width: 40%; text-align:center">
                      <button type="button" class="btn btn-primary" id="inc-children">+</button>
                    </div>
                  </nav>
                </li>
                <li class="p-5"><button class="btn btn-outline-primary btn-sm" id="dropdown_done" type="button" style="width: 100%">Done</button></li>
              </ul>
            </div>
          </div>
          <div class="col-md-8">
            <label for="" class="form-label text-muted">Choose your date</label>
            <div class="input-group mb-3">
              <input type="text" name="start_date" class="form-control @error('start_date') is-invalid @enderror" id="start_date" placeholder="" value="{{$booking->start_date}}">
              <span class="input-group-text">to</span>
              <input type="text" name="end_date" class="form-control @error('end_date') is-invalid @enderror" id="end_date" placeholder="" value="{{$booking->end_date}}">
            </div>
          </div>
          <hr>
          @include('admin.edit_booking.roomcard')
          <hr>
          @include('admin.edit_booking.addons')
          @if(Auth::user()->level == '3')
          <div style="display: none">
            @include('admin.booking.extra_charges')
          </div>
          @else
          <hr>
          @include('admin.booking.extra_charges')
          @endif
         
        </div>
        @endif
    </div>
  
  </div>
@include('admin.edit_booking.guest_form')

  <div class="tab-pane fade" id="bordered-justified-summary" role="tabpanel" aria-labelledby="summary-tab">
    <h5 class="card-title"><small class="text-muted">Step 3:</small> Invoice Details</h5>
    @include('admin.booking.invoice')
  </div>
  
</div><!-- End Bordered Tabs Justified -->
<div class="card-footer d-flex justify-content-end">
    <button class="btn btn-light" type="button" id="backButton"  style="margin-right: 8px;">Back</button>
    <button class="btn btn-primary" type="button" id="nextButton" >Next Part</button>
</div>