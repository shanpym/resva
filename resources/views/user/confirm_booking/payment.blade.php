
      <!-- Pills Tabs -->
      <ul class="nav nav-pills mb-3 justify-content-center" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="pills-online-tab" data-bs-toggle="pill" data-bs-target="#pills-online" type="button" role="tab" aria-controls="pills-online" aria-selected="true">Online Banking</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="pills-cash-tab" data-bs-toggle="pill" data-bs-target="#pills-cash" type="button" role="tab" aria-controls="pills-cash" aria-selected="false">Cash</button>
        </li>
      </ul>
      <div class="tab-content pt-2" id="myTabContent">
        <div class="tab-pane fade show active" id="pills-online" role="tabpanel" aria-labelledby="online-tab">
           <!-- Multi Columns Form -->
            <div class="col-md-12 mt-3">
              <label for="" class="form-label">Card Owner</label>
              <input type="text" class="form-control" id="">
            </div>
            
            <div class="col-12 mt-3">
                <label for="inputAddress5" class="form-label">Card Number</label>
                <input type="text" class="form-control" id="" placeholder="">
            </div>
            <div class="row mt-3">
                <div class="col-md-9">
                    <label for="" class="form-label">Expiration Date</label>
                    <div class="input-group mb-3">
                      <input type="text" class="form-control" placeholder="MM">
                      <input type="text" class="form-control" placeholder="YY">
                      
                    </div>
                  </div>
                  <div class="col-md-3">
                    <label for="" class="form-label">CVV</label>
                    <input type="text" class="form-control" id="">
                </div>
            </div>
            
           
            <div class="col-12 mt-3">
                <div class="alert alert-warning">
                    <small> Note: Kindly prepare the PHP(remaining amount) balance on your arrival day ({{$booking->start_date}})</small>
                </div>
                <label for="inputAddress5" class="form-label">Amount to Pay</label>
                <input type="text" class="form-control" name="amount_paid" id="online-payment" placeholder="PHP0">
            </div>

        </div>
        <div class="tab-pane fade" id="pills-cash" role="tabpanel" aria-labelledby="cash-tab">
            <div class="col-md-12">
                <div class="alert alert-warning">
                    <small> Note: Kindly prepare the PHP(remaining amount) balance on your arrival day ({{$booking->start_date}})</small>
                </div>
                <label for="" class="form-label">Amount to Pay</label>
                <input type="text" class="form-control" name="amount_paid" id="cash-payment" placeholder="PHP0">
            </div>
        </div>
      </div><!-- End Pills Tabs -->
      <script>
        $('#online-payment').change(function(){
            amount = parseInt($('#online-payment').val());
            $('#cash-payment').val(amount);
        })
      </script>
    