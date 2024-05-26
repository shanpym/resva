<div class="tab-pane fade" id="bordered-justified-details" role="tabpanel" aria-labelledby="details-tab">
    <h5 class="card-title"><small class="text-muted">Step 2:</small> Guest Information</h5>
    <div class="card-body">
      <!-- Multi Columns Form -->
      <div class="row g-3">
        <div class="col-md-6">
          <label for="" class="form-label text-muted">Firstname</label>
          <input type="text" name="firstname" class="form-control @error('firstname') is-invalid @enderror" id="firstname" value="{{$booking->firstname}}">
        </div>
        <div class="col-md-6">
          <label for="" class="form-label text-muted">Surname</label>
          <input type="text" name="surname" class="form-control @error('surname') is-invalid @enderror" id="surname" value="{{$booking->surname}}">
        </div>
        <div class="col-md-6">
          <label for="" class="form-label text-muted">Email</label>
          <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{$booking->email}}">
        </div>
        <div class="col-md-6">
          <label for="" class="form-label text-muted">Phone No.</label>
          <input type="number" name="phone_no" class="form-control @error('phone_no') is-invalid @enderror" id="phone_no" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==11) return false;" value="{{$booking->phone_no}}">
        </div>
        <div class="col-12">
          <label for="inputAddress5" class="form-label text-muted">Address</label>
          @if($booking->street_text)
                          {{$booking->street_text}},
                          @endif
                          @if($booking->barangay_text)
                          {{$booking->barangay_text}},
                          @endif
                          @if($booking->city_text)
                          {{$booking->city_text}},
                          @endif
                          @if($booking->province_text)
                          {{$booking->province_text}},
                          @endif
                          @if($booking->region_text)
                          {{$booking->region_text}}
                          @endif
        </div>
        <div class="col-md-4">
          <label for="inputState" class="form-label text-muted">Mode of Payment</label>
          <?php $invoice = DB::table('invoice')->where('booking_id', $booking->id)->first();?>
          <select name="payment_type" id="payment_type" class="form-select @error('payment_type') is-invalid @enderror">
            @if($invoice->payment_type == '1')
            <option value="1" selected>Online Banking</option>
            @elseif($invoice->payment_type == '2')
            <option value="2" selected>Cash</option>
            @endif
            <option disabled >Choose...</option>
            <option value="1">Online Banking</option>
            <option value="2">Cash</option>
          </select>
        </div>
        <div class="col-12">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" id="gridCheck">
            <label class="form-check-label" for="gridCheck">
              I agree to the Terms & Conditions
            </label>
          </div>
        </div>
      </div>
    </div>
  </div>
