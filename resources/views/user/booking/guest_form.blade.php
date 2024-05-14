<div class="tab-pane fade" id="bordered-justified-details" role="tabpanel" aria-labelledby="details-tab">
    <h5 class="card-title"><small class="text-muted">Step 2:</small> Guest Information</h5>
    <div class="card-body">
      <!-- Multi Columns Form -->
      <div class="row g-3">
        <div class="col-md-6">
          <label for="" class="form-label text-muted"><span style="color: #d9534f">*</span> Firstname</label>
          <input type="text" name="firstname" class="form-control @error('firstname') is-invalid @enderror" id="firstname" value="{{Auth::user()->firstname}}">
        </div>
        <div class="col-md-6">
          <label for="" class="form-label text-muted"><span style="color: #d9534f">*</span> Surname</label>
          <input type="text" name="surname" class="form-control @error('surname') is-invalid @enderror" id="surname" value="{{Auth::user()->surname}}">
        </div>
        <div class="col-md-6">
          <label for="" class="form-label text-muted"><span style="color: #d9534f">*</span> Email</label>
          <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{Auth::user()->email}}">
        </div>
        <div class="col-md-6">
          <label for="" class="form-label text-muted"><span style="color: #d9534f">*</span> Phone No.</label>
          <input type="number" name="phone_no" class="form-control @error('phone_no') is-invalid @enderror" id="phone_no" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==11) return false;" value="{{Auth::user()->phone_no}}">
        </div>
        <div class="col-12">
          <label for="inputAddress5" class="form-label text-muted"><span style="color: #d9534f">*</span> Address</label>
          <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" id="address" placeholder="1234 Main St" value="{{Auth::user()->address}}">
        </div>
        <div class="col-md-4">
          <label for="inputState" class="form-label text-muted"><span style="color: #d9534f">*</span> Mode of Payment</label>
          <select name="payment_type" id="payment_type" class="form-select @error('payment_type') is-invalid @enderror">
            <option disabled selected>Choose...</option>
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
