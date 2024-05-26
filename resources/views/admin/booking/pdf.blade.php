

<h4 class="home-title">Res<span class="span-title">va</span></h4>

<h1>Booking Detail</h1>

<table>
  <tr style="font-size: 1.3em; font-weight: 700">
    <td>CCST RESVA Hotel</td>
    <td class="text-right"># {{$bookings->id}}</td>
  </tr>
  <tr>
    <td>SNS BLDG, Samsonville Subdivision, Aurea, Dau, Mabalacat, Pampanga</td>
    <td class="text-right">
      <small><i>Thank you for booking with us!</i></small>
    </td>
  </tr>
</table>

<p class="padding"></p>
<?php
$totalAmountPaid = DB::table('transaction')
    ->where('booking_id', $bookings->id)
    ->sum('amount_paid');


$transactions = DB::table('booking')
    ->join('transaction', 'booking.id', '=', 'transaction.booking_id')
    ->join('invoice', 'booking.id', '=', 'invoice.booking_id')
    ->select('transaction.*', 'invoice.*')
    ->where('booking.id', $bookings->id)
    ->orderBy('transaction.id', 'asc')
    ->get();

$transaction = DB::table('transaction')->where('booking_id', $bookings->id)->first();
$invoice = DB::table('invoice')->where('booking_id', $bookings->id)->first();

$add_ons = DB::table('add_ons')->where('booking_id', $bookings->id)->get();
if($totalAmountPaid >=  $invoice->total_amount){
            $remaining_balance = 0;
          }else{
            $remaining_balance = $totalAmountPaid - $invoice->total_amount;
          }
$mealsAddOns = $add_ons->where('meals', '!=', null);
if ($mealsAddOns->isNotEmpty()) {
  $mealOptions = $mealsAddOns->toArray();
} else {
  $mealOptions = [];
}

$itemsAddOns = $add_ons->where('items', '!=', null);
if ($itemsAddOns->isNotEmpty()) {
  $itemsOptions = $itemsAddOns->toArray();
} else {
    $itemsOptions = [];
}
?>
<table>
  <thead>
    <tr>
      <th class="text-left">Guest Name</th>
      <th class="text-left">Room</th>
      <th class="text-right">Date to Stay</th>      
      <th class="text-right">Total Sleeps</th>      
      <th class="text-right">Requests</th>
    <tr>
  </thead>

  <tbody>
    <tr style="border-top: solid 1px #555">
      <td>{{$bookings->firstname}} {{$bookings->surname}}</td>
      <td>@if($bookings->status == '2')
        {{$bookings->room_name}}
        @else
        {{$bookings->room_type}}
        @endif</td>
      <td class="text-right">{{ \Carbon\Carbon::parse($bookings->start_date)->format('F j, Y') }} - {{ \Carbon\Carbon::parse($bookings->end_date)->format('F j, Y') }}</td>
      <td class="text-right">{{$bookings->no_adult}} Adult |  {{$bookings->no_children}} Children</td>
      <td class="text-right">{{$bookings->requests}}</td>
    </tr>  
  </tbody>
  <?php 
  $start_date = new DateTime($bookings->start_date);
  $end_date = new DateTime($bookings->end_date);
  $days_diff = $end_date->diff($start_date)->days;

  $room_type = DB::table('room_type')->where('name', $bookings->room_type)->first();

  // Ensure a room type is found
  if($room_type) {
      $subtotal = $room_type->price * $days_diff;
  }
?>
  <tfoot>
    <tr style="border-top: solid 1px #555">
      <th class="text-right" colspan=4>Subtotal</th>
      <th class="text-right">PHP{{$subtotal}}</th>
    </tr>
    <tr>
      <th class="text-right" colspan=4>Add Ons</th>
      <th class="text-right">@foreach ($itemsOptions as $items)
        <?php 
        $price = $items->price * $items->qty ;
          ?>
        PHP{{$price}} - {{ $items->items }}({{ $items->qty }} ea)  
        @if($bookings->status == '4' || $bookings->status == '3')
        
        @else
        @endif
        <br>
        @endforeach</th>
    </tr>
    <tr>
      <th class="text-right" colspan=4>Total Amount</th>
      <th class="text-right">PHP{{$invoice->total_amount}}</th>
    </tr>
  </tfoot>
</table>

<p class="padding"></p>

<table class="text-center">
  <tr>
    <td class="text-left"> Company Information</td>
    <td class="text-right"> Guest Information </td>
  </tr>
  <tr class="sign-name">
    <td class="text-left">CCST RESVA Hotel</td>
    <td class="text-right">{{$bookings->firstname}} {{$bookings->surname}}</td>
  </tr>
  <tr>
    <td class="text-left">SNS BLDG, Samsonville Subdivision, Aurea, Dau, Mabalacat, Pampanga</td>
    <td class="text-right">@if($bookings->street_text)
      {{$bookings->street_text}},
      @endif
      @if($bookings->barangay_text)
      {{$bookings->barangay_text}},
      @endif
      @if($bookings->city_text)
      {{$bookings->city_text}},
      @endif
      @if($bookings->province_text)
      {{$bookings->province_text}},
      @endif
      @if($bookings->region_text)
      {{$bookings->region_text}}
      @endif</td>
      
  </tr>
  <tr>
    <td class="text-left"></td>
    <td class="text-right"> {{$bookings->email}}</td>
  </tr>
  <tr>
    <td class="text-left">  (045) 624 0215 </td>
    <td class="text-right"> {{$bookings->phone_no}}</td>
  </tr>
</table>


<style>
    body {
  margin: 20px;
  font-size: 12px;
  font-family: Arial, Verdana, Sans-serif
}

h1 {
  margin: 50px 0;
  text-align: center
}

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

table {
  width: 100%;
  border-collapse: collapse
}

th, td {
  padding: 5px;
}

thead th {
  border-bottom: solid 1px #555
}


.text-right {
  text-align: right
}

.text-left {
  text-align: left
}

.text-center {
  text-align: center
}

.sign-name {
  font-size: 1.4em;
  font-weight: 700
}

p.padding {
 margin-top: 30px 
}
</style>