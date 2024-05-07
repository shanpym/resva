<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <style>
        
@import url(https://fonts.googleapis.com/css?family=Roboto:100,300,400,900,700,500,300,100);
*{
  margin: 0;
  box-sizing: border-box;

}
body{
  background: #E0E0E0;
  font-family: 'Roboto', sans-serif;
  background-image: url('');
  background-repeat: repeat-y;
  background-size: 100%;
}
::selection {background: #f31544; color: #FFF;}
::moz-selection {background: #f31544; color: #FFF;}
h1{
  font-size: 1.5em;
  color: #222;
}
h2{font-size: .9em;}
h3{
  font-size: 1.2em;
  font-weight: 300;
  line-height: 2em;
}
p{
  font-size: .7em;
  color: #666;
  line-height: 1.2em;
}

#invoiceholder{
  width:100%;
  hieght: 100%;
  padding-top: 50px;
}
#headerimage{
  z-index:-1;
  position:relative;
  top: -50px;
  height: 350px;
  background-image: url('http://michaeltruong.ca/images/invoicebg.jpg');

  -webkit-box-shadow:inset 0 2px 4px rgba(0,0,0,.15), inset 0 -2px 4px rgba(0,0,0,.15);
	-moz-box-shadow:inset 0 2px 4px rgba(0,0,0,.15), inset 0 -2px 4px rgba(0,0,0,.15);
	box-shadow:inset 0 2px 4px rgba(0,0,0,.15), inset 0 -2px 4px rgba(0,0,0,.15);
  overflow:hidden;
  background-attachment: fixed;
  background-size: 1920px 80%;
  background-position: 50% -90%;
}
#invoice{
  position: relative;
  top: -290px;
  margin: 0 auto;
  width: 700px;
  background: #FFF;
}

[id*='invoice-']{ /* Targets all id with 'col-' */
  border-bottom: 1px solid #EEE;
  padding: 30px;
}

#invoice-top{min-height: 120px;}
#invoice-mid{min-height: 120px;}
#invoice-bot{ min-height: 250px;}

.logo{
  float: left;
	height: 60px;
	width: 60px;
	background: url(https://blueridgevacationcabins.com/wp-content/uploads/2016/10/loog1-132x100.png) no-repeat;
	background-size: 60px 60px;
}
.clientlogo{
  float: left;
	height: 60px;
	width: 60px;
	background: url(http://michaeltruong.ca/images/client.jpg) no-repeat;
	background-size: 60px 60px;
    border-radius: 50px;
}
.info{
  display: block;
  float:left;
  margin-left: 20px;
}
.title{
  float: right;
}
.title p{text-align: right;}
#project{margin-left: 52%;}
table{
  width: 100%;
  border-collapse: collapse;
}
td{
  padding: 5px 0 5px 15px;
  border: 1px solid #EEE
}
.tabletitle{
  padding: 5px;
  background: #EEE;
}
.service{border: 1px solid #EEE;}
.item{width: 50%;}
.itemtext{font-size: .9em;}

#legalcopy{
  margin-top: 30px;
}
form{
  float:right;
  margin-top: 30px;
  text-align: right;
}


.effect2
{
  position: relative;
}
.effect2:before, .effect2:after
{
  z-index: -1;
  position: absolute;
  content: "";
  bottom: 15px;
  left: 10px;
  width: 50%;
  top: 80%;
  max-width:300px;
  background: #777;
  -webkit-box-shadow: 0 15px 10px #777;
  -moz-box-shadow: 0 15px 10px #777;
  box-shadow: 0 15px 10px #777;
  -webkit-transform: rotate(-3deg);
  -moz-transform: rotate(-3deg);
  -o-transform: rotate(-3deg);
  -ms-transform: rotate(-3deg);
  transform: rotate(-3deg);
}
.effect2:after
{
  -webkit-transform: rotate(3deg);
  -moz-transform: rotate(3deg);
  -o-transform: rotate(3deg);
  -ms-transform: rotate(3deg);
  transform: rotate(3deg);
  right: 10px;
  left: auto;
}



.legal{
  width:70%;
}
    </style>
    <div id="invoiceholder">
        @foreach ($bookings as $booking)
            
       
        <div id="headerimage"></div>
        <div id="invoice" class="effect2">
          
          <div id="invoice-top">
            <div class="logo"></div>
            <div class="info">
              <h2>CCST | RESVA Hotel</h2>
              <p> ccstresva2024@gmail.com </br>
                09XX XXX XXXX
              </p>
            </div><!--End Info-->
            <div class="title">
              <h1>Booking # {{$booking->id}}</h1>
              <p>{{$booking->created_at}}</br>
              </p>
            </div><!--End Title-->
          </div><!--End InvoiceTop-->
      
      
          
          <div id="invoice-mid">
            
            <div class="clientlogo"></div>
            <div class="info">
                <h2>{{$booking->firstname}} {{$booking->surname}}</h2>
                <p> {{$booking->email}} </br>
                  {{$booking->phone_no}}
                </p>
            </div>
      
            <div id="project">
              <h2>Thank you for booking with us!</h2>
              <p>Here is the invoice of your booking. Let us know if you have any other questions regarding of this invoice.</p>
            </div>   
      
          </div><!--End Invoice Mid-->
          
          <div id="invoice-bot">
            
            <div id="table">
              <table>
                <tr class="tabletitle">
                  <td class="item" style="width: 20% !important"><h2>Room</h2></td>
                  <td class="Hours"><h2>Stay</h2></td>
                  <td class="Rate"><h2>Rate/night</h2></td>
                  <td class="subtotal"><h2>Sub-total</h2></td>
                </tr>
                
                <tr class="service">
                  <td ><p class="itemtext">{{$booking->room_name}}</p></td>
                  <td class="tableitem"><p class="itemtext">{{$booking->start_date}} - {{$booking->end_date}}</p></td>
                  <?php 

                 
                  $rooms = DB::table('room_type')->where('name', $booking->room_type)->first();
                  $roomPrice = $rooms->price;
                  $start_date = new DateTime($booking->start_date);
                  $end_date = new DateTime($booking->end_date);
                  $interval = $start_date->diff($end_date);
                  $days_diff = $interval->days;

                  $subTotal = $roomPrice * $days_diff;

                  $add_ons = DB::table('add_ons')->where('booking_id', $booking->id)->get();
                  $transactions = DB::table('transaction')->where('booking_id', $booking->id)->first();
                    $invoice = DB::table('invoice')->where('booking_id', $booking->id)->first();

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
                        $mealOptions = [];
                    }

                  ?>
                  <td class="tableitem"><p class="itemtext">PHP{{ $roomPrice}}</p></td>
                  <td class="tableitem"><p class="itemtext">PHP{{$subTotal}}</p></td>
                </tr>
                
                
                <tr class="tabletitle">
                    <td></td>
                    <td></td>
                    <td class="Rate"><small>Meal Option</small></td>
                    <td class="payment"><small>
                        @foreach ($mealOptions as $meal)
                        PHP{{ $meal->price }} - {{ $meal->meals }}<br>
                    @endforeach</small></td>
                  </tr>
                <tr class="tabletitle">
                  <td></td>
                  <td></td>
                  <td class="Rate"><small>Add ons</small></td>
                  <td class="payment" style="width: 30%"><small> @foreach ($itemsOptions as $items)
                    <?php 
                    $price = $items->price * $items->qty ;
                      ?>
                    PHP{{$price}} <br> {{ $items->qty }} x {{ $items->items }}({{ $items->price }})<br>
                    @endforeach</small></td>
                </tr>
                
                <tr class="tabletitle">
                    <td></td>
                    <td></td>
                    <td class="Rate"><h2>Total</h2></td>
                    <td class="payment"><h2>PHP{{$invoice->total_amount}}</h2></td>
                  </tr>
                
              </table>
            </div><!--End Table-->
      
            
            <div id="legalcopy">
              <p class="legal"><strong>Thank you for your business!</strong>  Payment is expected within 31 days; please process this invoice within that time. There will be a 5% interest charge per month on late invoices. 
              </p>
            </div>
            @endforeach
          </div><!--End InvoiceBot-->
        </div><!--End Invoice-->
      </div><!-- End Invoice Holder-->
</body>
</html>