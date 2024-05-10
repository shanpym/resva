<!-- Free to use, HTML email template designed & built by FullSphere. Learn more about us at www.fullsphere.co.uk -->

<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>

  <!--[if gte mso 9]>
  <xml>
    <o:OfficeDocumentSettings>
      <o:AllowPNG/>
      <o:PixelsPerInch>96</o:PixelsPerInch>
    </o:OfficeDocumentSettings>
  </xml>
  <![endif]-->

  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="x-apple-disable-message-reformatting">
  <!--[if !mso]><!--><meta http-equiv="X-UA-Compatible" content="IE=edge"><!--<![endif]-->

    <!-- Your title goes here -->
    <title>Resva</title>
    <!-- End title -->

    <!-- Start stylesheet -->
    <style type="text/css">
      a,a[href],a:hover, a:link, a:visited {
        /* This is the link colour */
        text-decoration: none!important;
        color: #0000EE;
      }
      .link {
        text-decoration: underline!important;
      }
      p, p:visited {
        /* Fallback paragraph style */
        font-size:15px;
        line-height:24px;
        font-family:'Helvetica', Arial, sans-serif;
        font-weight:300;
        text-decoration:none;
        color: #000000;
      }
      h1 {
        /* Fallback heading style */
        font-size:22px;
        line-height:24px;
        font-family:'Helvetica', Arial, sans-serif;
        font-weight:normal;
        text-decoration:none;
        color: #000000;
      }
      .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td {line-height: 100%;}
      .ExternalClass {width: 100%;}
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
    <!-- End stylesheet -->

</head>

  <!-- You can change background colour here -->
  <body style="text-align: center; margin: 0; padding-top: 10px; padding-bottom: 10px; padding-left: 0; padding-right: 0; -webkit-text-size-adjust: 100%;background-color: #f2f4f6; color: #000000" align="center">
  
  <!-- Fallback force center content -->
  <div style="text-align: center;">

    <!-- Email not displaying correctly -->
    <table align="center" style="text-align: center; vertical-align: middle; width: 600px; max-width: 600px;" width="600">
      <tbody>
        <tr>
          <td style="width: 596px; vertical-align: middle;" width="596">

            <p style="font-size: 11px; line-height: 20px; font-family: 'Helvetica', Arial, sans-serif; font-weight: 400; text-decoration: none; color: #000000;">Did you book a reservation with us? If not, please ignore. </p>

          </td>
        </tr>
      </tbody>
    </table>
    <!-- Email not displaying correctly -->
    
    <!-- Start container for logo -->
    <table align="center" style="text-align: center; vertical-align: top; width: 600px; max-width: 600px; background-color: #ffffff;" width="600">
      <tbody>
        <tr>
          <td style="width: 596px; vertical-align: top; padding-left: 0; padding-right: 0; padding-top: 15px; padding-bottom: 15px;" width="596">
              <a href="" class="logo">
                <h4 class="home-title">Res<span class="span-title">va</span></h4>
              </a>

          </td>
        </tr>
      </tbody>
    </table>
    <!-- End container for logo -->

    {{-- <!-- Hero image -->
    <img style="width: 600px; max-width: 600px; height: 350px; max-height: 350px; text-align: center;" alt="Hero image" src="https://fullsphere.co.uk/misc/free-template/images/hero.jpg" align="center" width="600" height="350">
    <!-- Hero image --> --}}

    <!-- Start single column section -->
    <table align="center" style="text-align: left; vertical-align: top; width: 600px; max-width: 600px; background-color: #ffffff;" width="600">
        <tbody>
          <tr>
            <td style="width: 596px; vertical-align: top; padding-left: 30px; padding-right: 30px; padding-top: 30px; padding-bottom: 40px;" width="596">

              <h1 style="font-size: 20px; line-height: 24px; font-family: 'Helvetica', Arial, sans-serif; font-weight: 600; text-decoration: none; color: #000000;">Your Booking</h1>

              <p style="font-size: 15px; line-height: 24px; font-family: 'Helvetica', Arial, sans-serif; font-weight: 400; text-decoration: none; color: #919293;">
                <?php 
                  $booking = DB::table('booking')->where('id', $bookingID)->first();
                  $invoice =  DB::table('invoice')->where('booking_id', $bookingID)->first();
                
                    $payable_amount = $invoice->total_amount * .5;
                ?>
              
                <u>Guest Information</u>  <br>
                Full Name: {{$booking->firstname}} {{$booking->surname}}<br>
                Address: {{$booking->address}}<br>
                Email: {{$booking->email}}<br>
                Phone No: {{$booking->phone_no}}<br>

                <hr>

                <u>Reservation Details</u>  <br>
                @if($booking->status == '2')
                Your Room: {{$booking->room_name}}<br>
                @else
                Your Room: {{$booking->room_type}}<br>
                @endif
               
                Date to Stay: {{ \Carbon\Carbon::parse($booking->start_date)->format('F j, Y') }} - {{ \Carbon\Carbon::parse($booking->end_date)->format('F j, Y') }}<br>
                Total Sleep/s: {{$booking->no_adult}} Adult |  {{$booking->no_children}} Children<br><br><br>
                Your Request/s: {{$booking->requests}}<br>
                <hr>
                <strong>Total Amount PHP {{$invoice->total_amount}}</strong><br>
                Kindly pay the 50% downpayment to secure your reservation (PHP {{$payable_amount}}) 
              </p>   
              <p style="font-size: 15px; line-height: 24px; font-family: 'Helvetica', Arial, sans-serif; font-weight: 400; text-decoration: none; color: #919293;">You can check the status of your booking here</p>
            
              <!-- Start button (You can change the background colour by the hex code below) -->
              <a href="{{url('/admin/confirm_booking/guest_payment/' .$booking->id)}}" target="_blank" style="background-color: #000000; font-size: 15px; line-height: 22px; font-family: 'Helvetica', Arial, sans-serif; font-weight: normal; text-decoration: none; padding: 12px 15px; color: #ffffff; border-radius: 5px; display: inline-block; mso-padding-alt: 0;">
                <!--[if mso]>
                <i style="letter-spacing: 25px; mso-font-width: -100%; mso-text-raise: 30pt;">&nbsp;</i>
              <![endif]-->

                <span style="mso-text-raise: 15pt; color: #ffffff;">Pay Here</span>
                <!--[if mso]>
                <i style="letter-spacing: 25px; mso-font-width: -100%;">&nbsp;</i>
              <![endif]-->
              </a>
              <!-- End button here -->
           
            </td>
          </tr>
        </tbody>
      </table>
     
  </div>

  </body>

</html>