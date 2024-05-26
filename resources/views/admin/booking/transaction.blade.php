<section class="section profile">
    <div class="row">
      <div class="col-xl-12">

        <div class="card">
          <div class="card-body profile-card pt-4 d-flex flex-column">
            <h5 class="card-title">Transaction Detail</h5>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <strong>Date</strong>
                    </div>
                    <div class="col-md-4">
                        <strong>Transaction Type</strong>
                    </div>
                    <div class="col-md-2">
                        <strong>Status</strong>
                    </div>
                    <div class="col-md-2 text-end">
                        <strong>Amount Paid</strong>
                    </div>
                    <hr>
                </div>
                
                @foreach ($transactions as $transaction)
                    
                    <div class="row" style="color:#8c939b !important;">
                        <div class="col-md-4">
                            {{$transaction->confirmed_at}}
                        </div>
                        <div class="col-md-4">
                            @if ($transaction->payment_type == 1)
                            <span>Online Banking</span>
                            @elseif($transaction->payment_type == 2) 
                            <span>Cash</span>
                            @endif
                        </div>
                        <div class="col-md-2">
                            @if ($transaction->status == 1)
                            <span class="badge bg-warning">Pending</span>
                            @elseif($transaction->status == 2) 
                            <span class="badge bg-primary">Confirmed</span>
                            @elseif($transaction->status == 3) 
                            <span class="badge bg-danger">Cancelled</span>
                            @elseif($transaction->status == 4) 
                            <span class="badge bg-success">Completed</span>
                            @elseif($transaction->status == 5) 
                            <span class="badge bg-info">Arrived</span>
                            @elseif($transaction->status == 6) 
                            <span class="badge bg-warning">Pending</span>
                            @elseif($transaction->status == 7) 
                            <span class="badge bg-primary">Confirmed</span>
                            @endif
                        </div>
                        
                        <div class="col-md-2 text-end">
                            PHP{{$transaction->amount_paid}}
                        </div>
                    </div>
                <hr>
                
                @endforeach
               <div class="row ">
                <div class="col-md-12 text-end">
                    <h4><strong>Total</strong> <span>PHP {{$totalAmountPaid}}</span></h4>
                </div>
               </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>
</section>