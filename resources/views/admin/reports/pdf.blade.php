<style>
    table{width:100%;border:1px solid #ccc;border-collapse:collapse}
    table th,
    table td{border:1px solid #ddd;border-width:1px 0;padding:5px 10px;font-size:14px}
    table thead tr:first-of-type th{text-transform: uppercase;letter-spacing:3px;font-size: 12px}
    table thead tr:last-of-type th{border-width:0 1px;}

    table thead tr:first-of-type th{border-width:0 1px;}

    table tbody tr:nth-child(odd){background-color:#e5e5e5}
    table .number{text-align:right}
    table .date{text-align:center}
    table tfoot th,
    table tfoot td{border-top-width: 2px}
    table tfoot th{text-align: right;}
    .show-phone{display:none}

    .home-title{
  font-family: 'Poppins', sans-serif !important;
  font-size: 24px !important;
  font-weight: 700 !important;
  text-transform: uppercase !important;
  color: #03a4ed !important;
  }
  .span-title{
  font-family: 'Poppins', sans-serif !important;
  color: #0275d8 !important;
  }
</style>


<div style="text-align: center; margin-top:55px">
    <h4 class="home-title">Res<span class="span-title">va</span></h4>
    <p>SNS BLDG, Samsonville Subdivision, Aurea, Dau, Mabalacat, Pampanga</p>
    <h1>Reports</h1>
</div>



<table id="loyalty-rewards" class="report responsive">
    <thead>
    <tr>
    <th scope="col" class="date"></th>
    <th scope="col" class="date">Transaction Date</th>
    <th scope="col" class="number"><span class="show-phone">Order</span> # Booking</th>
    <th scope="col" class="number"><span class="show-phone">Order</span> Status</th>
    <th scope="col" class="number"><span class="show-phone">Points</span> Room</th>
    <th scope="col" class="number"><span class="show-phone">Points</span> Fee</th>
    <th scope="col" class="number"><span class="show-phone">Points</span> Amount Paid</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($bookings as $booking)
    <?php
     $invoice = DB::table('invoice')->where('booking_id', $booking->id)->first();
     $totalAmountPaid1 = DB::table('transaction')
                    ->where('booking_id', $booking->id)
                    ->sum('amount_paid');
    ?>
        <tr>
        <td class="number">{{$loop->iteration}}</td>
        <td class="date">{{$booking->created_at}}</td>
        <td class="number">{{$booking->id}}</td>
        <td class="number">
            @if ($booking->status == 1)
            Pending
            @elseif($booking->status == 2) 
            Confirmed
            @elseif($booking->status == 3) 
            Cancelled
            @elseif($booking->status == 4) 
            Completed
            @elseif($booking->status == 5) 
            Arrived
            @elseif($booking->status == 6) 
            Pending
            @elseif($booking->status == 7) 
            Confirmed
            @endif
        </td>
        <td class="number">{{$booking->room_type}}</td>
        <td class="number">PHP{{$invoice->total_amount}}</td>
        <td class="number">PHP{{$totalAmountPaid1}}</td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
    <td></td>
    <td></td>
    <th colspan="3">Total:</th>
    <td class="number">PHP{{$newtotalPrice}}</td>
    <td class="number">PHP{{$totalAmountPaid}}</td>
    </tr>
    </tfoot>
    </table>