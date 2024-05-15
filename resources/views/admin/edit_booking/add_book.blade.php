@extends('admin.layout')
@section('title', 'CCST | Resva')
@section('content')
    
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Add Booking</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Pages</li>
          <li class="breadcrumb-item active">Add Booking</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <div class="">
      @if ($errors->any())
        <div class="alert alert-danger">
            {{ $errors->all()[0] }}
        </div>
      @endif
      <style>
        .overlay {
          position: fixed;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          background-color: rgba(0, 0, 0, 0.5);
          z-index: 9998;
          display: flex;
          justify-content: center; /* Center horizontally */
          align-items: center; /* Center vertically */
        }
        #alert-success {
        z-index: 9999;
        }
      </style>
      @if(session()->has('error'))
        <div id="alert-success" class="alert alert-danger alert-dismissible fade show"><i class="fas fa-exclamation-circle"></i> {{session('error')}}</div>
      @endif
  
      @if(session()->has('success'))
      <div class="overlay">
        <div class="alert alert-light fade show justify-content-center border-1">
          <div class="col d-flex justify-content-center">
            <button class="btn-close btn-close-custom  me-0 m-auto" type="button" style="font-size: 1.5rem; padding: 0.75rem 1rem; margin-left:25px"></button>
          </div>
            <div class="card-body">
                <div class="row m-auto justify-content-center mb-5 ">
                    <img src="{{asset('dashboard/assets/img/success-2.gif')}}" alt="" srcset="" style="width: 50%">
                </div>
                <div class="row mt-3">
                  <i class="fa fa-check mr-2 " ></i> <strong class="text-success text-center">{{session('success')}}</strong>
              </div>
                <div class="row">
                    <i class="fa fa-check mr-2 " ></i> <small class="text-secondary text-center">View your booking <a href="{{route('admin.pending')}}" type="button"> here</a>.</small>
                </div>
            </div>
        </div>
      </div>
      @endif
    </div>
<section class="section">
  <div class="row">
    <div class="col-lg-8">
      <div class="card">
        <div class="card-body">
          @foreach ($bookings as $booking)
          <?php
          $transactions = DB::table('transaction')->where('booking_id', $booking->id)->first();
          $invoice = DB::table('invoice')->where('booking_id', $booking->id)->first();
          $add_ons = DB::table('add_ons')->where('booking_id', $booking->id)->get();
          $start_date = new DateTime($booking->start_date);
                    $end_date = new DateTime($booking->end_date);
                    $days_diff = $end_date->diff($start_date)->days;

                    $room_type = DB::table('room_type')->where('name', $booking->room_type)->first();

                    // Ensure a room type is found
                    if($room_type) {
                        $subtotal = $room_type->price * $days_diff;
                    }

                    $itemsAddOns = $add_ons->where('items', '!=', null);

                      if ($itemsAddOns->isNotEmpty()) {
                          $itemsOptions = $itemsAddOns->toArray();
                          $allItemsPrice = 0;

                          foreach ($itemsOptions as $item) {
                              // Access properties using object notation
                              $allItemsPrice += $item->price * $item->qty;
                          }
                      } else {
                          $itemsOptions = [];
                          $allItemsPrice = 0;
                      }
          ?>
        
          <form action="{{url('pending.update/' . $booking->id)}}" method="post">
            @method('PUT')
            @csrf
            
          <input type="hidden" name="status" id="" value="{{$booking->status}}">
          @include('admin.edit_booking.multiform')
          @endforeach
        </div>
      </div>

    </div>

    </style>
    <div class="col-lg-4">

      <div class="card">
        <div class="card-body bg-light" style="font-size: 14px">
          <h5 class="card-title">Booking Summary</h5>
            <div class="row p-2">
              <div class="col-lg-9">
                Checkin
              </div>
              <div class="col-lg-3">
                <span class="text-muted">After 3:00PM</span>
              </div>
            </div>
            <div class="row p-2">
              <div class="col-lg-9">
                Checkout
              </div>
              <div class="col-lg-3">
                <span class="text-muted">Before 3:00PM</span>
              </div>
            </div>
            <hr>
            <div class="row p-2">
              <div class="col-lg-12">
                <span class="text-muted" id="summary-date">{{ \Carbon\Carbon::parse($booking->start_date)->format('F j, Y') }} - {{ \Carbon\Carbon::parse($booking->end_date)->format('F j, Y') }}</span>
              </div>
            </div>
            <div class="row p-2">
              <div class="col-lg-12">
                <span class="text-muted"><span id="summary-adult">{{$booking->no_adult}}</span> Adult - <span id="summary-children">{{$booking->no_children}}</span> Children</span>
              </div>
            </div>
            <div class="row p-2  mt-3">
              <div class="col-lg-9">
                <span class="text-muted" id="summary-room">{{$booking->room_type}}</span>
                <input type="hidden" name="room_type" id="input_room_type" value="{{$booking->room_type}}">
              </div>
              <div class="col-lg-3">
                <span class="text-muted" id="summary-subtotal">PHP{{$subtotal}}</span><br>
                <input type="hidden" name="" id="input-roomprice" value="{{$room_type->price}}">
                <input type="hidden" name="" id="input-subtotal" value="{{$subtotal}}">
                <small class="text-muted" style="font-size: 12px" id="summary-calc"></small>
              </div>
            </div>
            @if($booking->status == '2' || $booking->status == '5' || $booking->status == '1')
            <div class="row p-2">
              <div class="col-lg-9">
                <span class="text-muted">Add ons</span>
              </div>
              <div class="col-lg-3">
                <span class="text-muted" id="summary-lastaddons">PHP{{$allItemsPrice}}</span><br>
                <span class="text-muted" id="summary-addons">PHP0</span><br>
                <input type="hidden" name="" id="last-addons" value="{{$allItemsPrice}}">
                <input type="hidden" name="input-addons" id="input-addons" value="0">
                <input type="hidden" name="room_name"  value="{{$booking->room_name}}">
              </div>
            </div>
            @endif
            <hr>
            <input type="hidden" name="input-meals" id="input-meals" value="0">
            <input type="hidden" name="input-addons" id="input-addons" value="0">
            <div class="row p-2  mt-3">
              <div class="col-lg-9">
                <strong class="text-muted" >TOTAL</strong>
              </div>
              <div class="col-lg-3">
                <strong class="text-muted" id="summary-total-amount">PHP{{$invoice->total_amount}}</strong><br>
                <input type="hidden" name="total_amount" id="input-total-amount" value="{{$invoice->total_amount}}">
                
                
                <input type="hidden" name="room_name" id="input_room_name" value="">

                <input type="hidden" name="employee_id" id="input_employee_id">
                <input type="hidden" name="admin_id" id="input_admin_id">

              
              </div>
            </div>
          </form>
        </div>
      </div>

    </div>
  </div>
</section>
</main>
@if($booking->status == '2' || $booking->status == '5')
{{-- Multiform JS --}}
<script>
  document.addEventListener("DOMContentLoaded", function() {
    const nextPartButton = document.getElementById('nextButton');
    const backButton = document.getElementById('backButton');
    const tabContent = document.getElementById('borderedTabJustifiedContent');
    const tabPanes = tabContent.querySelectorAll('.tab-pane');
    let currentTab = 0;

    // Function to switch to the next tab
    function switchToNextTab() {
      // If there's a next tab
      if (currentTab < tabPanes.length - 1) {
        // Hide the current tab
        tabPanes[currentTab].classList.remove('show', 'active');
        // Increment the current tab index
        currentTab++;
        // Show the next tab
        tabPanes[currentTab].classList.add('show', 'active');
        // If the next tab is the last one, change the button text to "Submit"
        if (currentTab === tabPanes.length - 1) {
          nextPartButton.textContent = "Submit";
        }
      }
    }

    // Function to switch to the previous tab
    function switchToPreviousTab() {
      // If the current tab is not the first one, allow switching
      if (currentTab > 0) {
        // Hide the current tab
        tabPanes[currentTab].classList.remove('show', 'active');
        // Decrement the current tab index
        currentTab--;
        // Show the previous tab
        tabPanes[currentTab].classList.add('show', 'active');
        // If we are no longer on the last tab, revert the button text to "Next Part"
        if (currentTab !== tabPanes.length - 1) {
          nextPartButton.textContent = "Next Part";
        }
      }
    }

    // Add click event listener to the "Next Part" button
    nextPartButton.addEventListener('click', function() {
      // If the button text is "Submit", submit the form
      if (nextPartButton.textContent === "Submit") {
        nextPartButton.setAttribute('type', 'submit');
      } else {
        switchToNextTab();
      }
    });

    // Add click event listener to the "Back" button
    backButton.addEventListener('click', function() {
      switchToPreviousTab();
    });
  });
</script>

{{-- Simple Jquery --}}
<script>
  $('#dropdown_btn').on('click', function(){
    if ($('#dropdown_menu').css('display') === 'none') {
        $('#dropdown_menu').css('display', 'block');
    } else {
        $('#dropdown_menu').css('display', 'none');
    }
  });    

  $('#dropdown_done').on('click', function(){
    if ($('#dropdown_menu').css('display') === 'block') {
        $('#dropdown_menu').css('display', 'none');
    } else {
        $('#dropdown_menu').css('display', 'block');
    }
  });    

  //DATE PICKER
  $( function() {
    $("#start_date").datepicker({
            minDate: 0,
            dateFormat: 'yy/mm/dd',
              onSelect: function(selectedDate) {
                
                
                $('#ui-datepicker-div table td a').attr('href', 'javascript:;');
                  var minCheckOutDate = new Date(selectedDate);
                  minCheckOutDate.setDate(minCheckOutDate.getDate() + 1);
                  setTimeout(function() {

                  $("#end_date").datepicker('option', 'minDate', minCheckOutDate).datepicker('show');
                }, 0);
                  $(this).trigger('change'); 
              }
          });

          $("#end_date").datepicker({
              dateFormat: 'yy/mm/dd',
              onSelect: function(selectedDate) {
                  $(this).trigger('change'); 
              },
          });   
    });

  $('#start_date, #end_date').change(function() {
            var start_date = $('#start_date').val();
            var end_date = $('#end_date').val();
            if (start_date && end_date) {
                var start_dateFormat = new Date(start_date).toLocaleString('en-us', { month: 'short', day: 'numeric', year: 'numeric' });
                var end_dateFormat = new Date(end_date).toLocaleString('en-us', { month: 'short', day: 'numeric', year: 'numeric' });
                var diff = new Date(end_date) - new Date(start_date);
                var days_diff = diff / (1000 * 60 * 60 * 24);
                $('#summary-date').text(start_dateFormat + " - " + end_dateFormat + " (" + days_diff + " night /s)");
                $('#invoice-date').text(start_dateFormat + " - " + end_dateFormat + " (" + days_diff + " night /s)");
                $('#summary-subtotal').text("PHP0");
                $('#input-subtotal').val(0);
                $('#summary-calc').text('');
                $('#summary-total-amount').text("PHP0");
                $('#invoice-subtotal').text("PHP0");
                $('#invoice-addons').text("PHP0");
                $('#invoice-meals').text("PHP0");
                $('#invoice-total-amount').text("PHP0");
                
                checkDateAvailability();
                
            }
        });

  //adult 
      $('#inc-adult').on('click', function(){
        var increment = parseInt($('#no_adult').val())+1;
        $('#no_adult').val(increment);
        $('#invoice-adult').text(increment);
        $('#summary-adult').text(increment);
        checkDateAvailability();
      })
      $('#dec-adult').on('click', function(){
        var decrement = parseInt($('#no_adult').val())-1;
        if(decrement < 0) {
          decrement = 0;
        }
        $('#no_adult').val(decrement);
        $('#invoice-adult').text(decrement)
        $('#summary-adult').text(decrement);
        checkDateAvailability();
      })

      //children
      $('#inc-children').on('click', function(){
        var increment = parseInt($('#no_children').val())+1;
        $('#no_children').val(increment);
        $('#invoice-children').text(increment)
        $('#summary-children').text(increment);
        checkDateAvailability();
      })
      $('#dec-children').on('click', function(){
        var decrement = parseInt($('#no_children').val())-1;
        if(decrement < 0) {
          decrement = 0;

        }
        $('#no_children').val(decrement)
        $('#invoice-children').text(decrement)
        $('#summary-children').text(decrement);
        checkDateAvailability();
      })

      $('#requests').change(function(){
        var requests = $('#requests').val();
        $('#invoice-requests').text(requests);
      })

      $('#firstname, #surname, #email, #phone_no, #address').change(function(){
        var firstname = $('#firstname').val();
        var surname = $('#surname').val();
        var email = $('#email').val();
        var phone_no = $('#phone_no').val();
        var address = $('#address').val();
        $('#invoice-firstname').text(firstname);
        $('#invoice-surname').text(surname);
        $('#invoice-address').text(address);
        $('#invoice-email').text(email);
        $('#invoice-phone_no').text(phone_no);
      })

        
      $('#payment_type').on('change', function() {
        var selectedOption = $(this).find('option:selected').text();
        $('#invoice-payment-type').text(selectedOption);
      });

      $('#resv_type').on('change', function() {
        var selectedOption = $(this).find('option:selected').text();
        $('#invoice-resv-type').text(selectedOption);
      });

      $('.btn-close').on('click', function(){
        $('.alert').hide();
        $('.overlay').hide();
      })
      $('.overlay').on('click', function(event) {
          if (!$(event.target).closest('.alert').length) {
              $('.alert').hide();
              $('.overlay').hide();
          }
      });

      function fadeOutOverlay() {
          setTimeout(function() {
              $('.overlay').fadeOut();
              $('.alert').fadeOut();
          }, 5000); 
      }

      fadeOutOverlay();
      var i = 0;
      $('#add').click(function(){
        ++i;
        $('#table').append(
          `<tr>
            <td>
              <input type="text" class="form-control" id="" name="inputs[${i}][items]">
            </td>
            <td>
              <input type="text" class="form-control qty" id="qty[${i}]" name="inputs[${i}][qty]" >
            </td>
            <td>
              <input type="text" class="form-control price" id="price[${i}]" name="inputs[${i}][price]" >
            </td>      
            <td>
              <input type="text" class="form-control total" id="total[${i}]" name="inputs[${i}][total]" >
            </td>  
            <td><button type="button" class="btn btn-danger remove-table-row" name="remove">Remove</button></td>
          </tr>`
        );
      });

      
      $(document).on('change', '.qty, .price', function() {
        var row = $(this).closest('tr');
        var qty = parseInt(row.find('.qty').val()) || 0;
        var price = parseInt(row.find('.price').val()) || 0;

        var total = qty * price;
        row.find('.total').val(total);

        var grandTotal = 0;
          $('.total').each(function() {
              var val = parseInt($(this).val()) || 0;
              grandTotal += val;
          });
          $('#summary-addons').text("PHP" + grandTotal);
          $('#input-addons').val(grandTotal);
          calculatePrice()
      });

      $(document).on('click', '.remove-table-row', function() {
         
          var rowTotal = parseInt($(this).closest('tr').find('.total').val()) || 0;
          $(this).closest('tr').remove();
          var grandTotal = 0;
          $('.total').each(function() {
              var val = parseInt($(this).val()) || 0;
              grandTotal += val;
          });
          
          $('#summary-addons').text("PHP" + grandTotal);
          $('#input-addons').val(grandTotal);
          calculatePrice()
      });



      function checkDateAvailability() {
                  
                  // Hide the room-card content
                  $('#card-container').hide();
                  // Show the preloader inside room-card
                  $('#card-container').html('<img src="{{asset('dashboard/assets/img/spinner3.gif')}}" height="100" width="94" style="display: block; margin: auto;">').show();
      
                  $('#selectOption').removeClass('is-valid');
                  var start_date = $('#start_date').val();
                  var end_date = $('#end_date').val();
                  var no_adult = parseInt($('#no_adult').val());
                  var no_children = parseInt($('#no_children').val());
      
                  $.ajax({
                      url: '/rooms/check',
                      type: 'GET',
                      dataType: 'json',
                      data: {
                          start_date: start_date,
                          end_date: end_date,
                          no_adult: no_adult,
                          no_children: no_children
                      },
                      success: function (response) {
                        
                          setTimeout(function () {
                            // Remove the preloader
                          $('.preloader').remove();
                          $('#card-container').empty();
                          $('#room_message').attr("class", "text-muted text-sm ml-5").text('');
                              if (response.length > 0) {
                              $.each(response, function (index, room_type) {

                                  var card_section = $('<section class="section">');
                                  var row = $('<div class="row align-items-top">');   
                                  var col_12 = $('<div class="col-lg-12">'); 
                                  var card = $('<div class="card mb-3">')
                                      .attr("id", "card_" + room_type.id)
                                      .css({
                                          'border': '1px solid transparent',
                                          'border-radius': '0px'
                                      }); 
                                  var row_g0 = $('<div class="row g-0">'); 
                                  var col_md4 = $('<div class="col-md-4">'); 
                                    var img = $('<img class="img-fluid rounded-start">')
                                  .attr("src", "{{ asset('storage/img/') }}" + "/" + room_type.image)
                                  .css({ 'height': '200px', 'width': '1000px' });
                                  var col_md8 = $('<div class="col-md-8">');     
                                  var card_body = $('<div class="card-body">');
                                  var title = $('<h5 class="card-title">').text(room_type.name);
                                  var text = $('<p class="card-text">');
                                  var colRad = $('<div class="col-1">').css({
                                      'display': 'none',
                                  });
                                  var radioBtn = $('<input class="radio-btn mb-3">')
                                      .attr("type", "radio").attr("id", "radio" + room_type.id)
                                      .attr("name", "roomid").val(room_type.id)
                                      .css({
                                          'display': 'none',
                                      });
                                  var label = $('<label>').attr("for", "radio" + room_type.id)
                                      .css('cursor', 'pointer');
      
                                  var label2 = $('<label class="radio">')
                                      .attr("id", "label_" + room_type.id)
                                      .css({
                                          'color': '#007bff',
                                      });


                                  colRad.append(radioBtn);
                                  colRad.append(label2);
                                  card_body.append(text);
                                  card_body.append(title);
                                  col_md8.append(card_body);
                                  col_md4.append(img);
                                  row_g0.append(col_md4);
                                  row_g0.append(col_md8);
                                  card.append(colRad);
                                  card.append(row_g0);
                                  col_12.append(card);
                                  row.append(col_12);
                                  label.append(row);
                                  card_section.append(label);
                                  $('#card-container').append(card_section);
                              });
                            } else {
                                    $('#room_message').attr("class", "text-muted text-sm ml-5").text("No available rooms for selected dates.");
                                }
                          }, 1000);
                      }
                  });
              }

              
              $(document).on('change', '.radio-btn', function() {
                if ($('.radio-btn').is(':checked')) {
                    var roomId = $(this).val();
                    $.ajax({
                        url: '/room/' + roomId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(response) {
                          var totalMeals = 0;
                          $('#summary-meals').text("PHP" + totalMeals);
                          $('#input-meals').val(totalMeals);
                          $('#checkbox-container').empty();
                          $('#meals-container').empty();
                            $.each(response, function(index, room_type) {
                                roomsPrice = room_type.price;
                                $('#summary-room').text(room_type.name);
                                $('#input_room_type').val(room_type.name);
                                $('.card').css('border-color', 'transparent');
                                  $('#card_' + room_type.id).css('border', '1px solid #007bff');
                                $.each(response.meals, function(index, meal) {
                                  if(meal.room_type_id == room_type.name){
                                 
                                    var label = $('<label class="form-label">').attr("for", "checkbox_" + meal.name)
                                          .css('cursor', 'pointer').text(meal.name);
                                    var checkboxBtn = $('<input class="form-check-input">')
                                            .attr("type", "checkbox").attr("id", "checkbox_" + meal.name)
                                            .attr("name", "meals[]").val(meal.name);
                                    var inputPrice = $('<input class="">')
                                            .attr("type", "hidden").attr("id", "input" + meal.name)
                                            .attr("name", "price[]").val(meal.price);   
                                    
                                    $('#checkbox-container').append(checkboxBtn).append(label).append(inputPrice).append('<br>'); 
                                    
                                    
                                  
                                    $(document).on('change', '[id^=checkbox_]', function() {
                                        var mealName = $(this).attr('id').replace('checkbox_', '');

                                        if ($(this).is(':checked')) {
                                            var mealPrice = $('#input' + mealName).val();
                                            totalMeals += parseFloat(mealPrice);
                                            var summaryMeals = $('<small class="text-muted">')
                                                .attr("id", "summary" + mealName)
                                                .text(mealName);   
                                            $('#meals-container').append(summaryMeals);
                                        } else {
                                            var mealPrice = $('#input' + mealName).val();
                                            totalMeals -= parseFloat(mealPrice);
                                            $('#summary' + mealName).remove();  
                                        }

                                        // Remove all line breaks from the meals container
                                        $('#meals-container br').remove();

                                        // Add line breaks after each summary item except the last one
                                        $('#meals-container small').not(':last').after('<br>');

                                        $('#summary-meals').text("PHP" + totalMeals);
                                        $('#input-meals').val(totalMeals);
                                        calculatePrice();
                                    });

                                  }
                                });
                                calculatePrice()
                            });
                        }
                    });
                }
              });

              function calculatePrice(){
                var start_date = $('#start_date').val();
                var end_date = $('#end_date').val(); 
                var prevadd_ons = parseInt($('#last-addons').val());
                var add_ons = parseInt($('#input-addons').val());   
                var room_price = parseInt($('#input-roomprice').val()); 
                var meals = parseInt($('#input-meals').val());  
                    var diff = new Date(end_date) - new Date(start_date);
                    var days_diff = diff / (1000 * 60 * 60 * 24);    
                    var subTotal = days_diff * room_price;
                    var totalPrice = prevadd_ons + meals + subTotal + add_ons; 

                    $('#summary-subtotal').text("PHP" + subTotal);
                    $('#input-subtotal').val(subTotal);
                    $('#summary-calc').text("( " + "PHP" + room_price + " x " + days_diff + " night /s)")
                    $('#summary-total-amount').text("PHP" + totalPrice);
                    $('#input-total-amount').val(totalPrice);

                    $('#invoice-subtotal').text("PHP" + subTotal);
                    $('#invoice-addons').text("PHP" + add_ons);
                    $('#invoice-meals').text("PHP" + meals);
                    $('#invoice-total-amount').text("PHP" +  totalPrice);

                    $('#invoice_extrabed2').text(" ( " + extrabedPrice + " x " + extrabed + " bed )");
                }
</script>
@else

{{-- Multiform JS --}}
<script>
  document.addEventListener("DOMContentLoaded", function() {
    const nextPartButton = document.getElementById('nextButton');
    const backButton = document.getElementById('backButton');
    const tabContent = document.getElementById('borderedTabJustifiedContent');
    const tabPanes = tabContent.querySelectorAll('.tab-pane');
    let currentTab = 0;

    // Function to switch to the next tab
    function switchToNextTab() {
      // If there's a next tab
      if (currentTab < tabPanes.length - 1) {
        // Hide the current tab
        tabPanes[currentTab].classList.remove('show', 'active');
        // Increment the current tab index
        currentTab++;
        // Show the next tab
        tabPanes[currentTab].classList.add('show', 'active');
        // If the next tab is the last one, change the button text to "Submit"
        if (currentTab === tabPanes.length - 1) {
          nextPartButton.textContent = "Submit";
        }
      }
    }

    // Function to switch to the previous tab
    function switchToPreviousTab() {
      // If the current tab is not the first one, allow switching
      if (currentTab > 0) {
        // Hide the current tab
        tabPanes[currentTab].classList.remove('show', 'active');
        // Decrement the current tab index
        currentTab--;
        // Show the previous tab
        tabPanes[currentTab].classList.add('show', 'active');
        // If we are no longer on the last tab, revert the button text to "Next Part"
        if (currentTab !== tabPanes.length - 1) {
          nextPartButton.textContent = "Next Part";
        }
      }
    }

    // Add click event listener to the "Next Part" button
    nextPartButton.addEventListener('click', function() {
      // If the button text is "Submit", submit the form
      if (nextPartButton.textContent === "Submit") {
        nextPartButton.setAttribute('type', 'submit');
      } else {
        switchToNextTab();
      }
    });

    // Add click event listener to the "Back" button
    backButton.addEventListener('click', function() {
      switchToPreviousTab();
    });
  });
</script>

{{-- Simple Jquery --}}
<script>
  $('#dropdown_btn').on('click', function(){
    if ($('#dropdown_menu').css('display') === 'none') {
        $('#dropdown_menu').css('display', 'block');
    } else {
        $('#dropdown_menu').css('display', 'none');
    }
  });    

  $('#dropdown_done').on('click', function(){
    if ($('#dropdown_menu').css('display') === 'block') {
        $('#dropdown_menu').css('display', 'none');
    } else {
        $('#dropdown_menu').css('display', 'block');
    }
  });    

  //DATE PICKER
  $( function() {
    $("#start_date").datepicker({
            minDate: 0,
            dateFormat: 'yy/mm/dd',
              onSelect: function(selectedDate) {
                
                
                $('#ui-datepicker-div table td a').attr('href', 'javascript:;');
                  var minCheckOutDate = new Date(selectedDate);
                  minCheckOutDate.setDate(minCheckOutDate.getDate() + 1);
                  setTimeout(function() {

                  $("#end_date").datepicker('option', 'minDate', minCheckOutDate).datepicker('show');
                }, 0);
                  $(this).trigger('change'); 
              }
          });

          $("#end_date").datepicker({
              dateFormat: 'yy/mm/dd',
              onSelect: function(selectedDate) {
                  $(this).trigger('change'); 
              },
          });   
    });

  $('#start_date, #end_date').change(function() {
            var start_date = $('#start_date').val();
            var end_date = $('#end_date').val();
            if (start_date && end_date) {
                var start_dateFormat = new Date(start_date).toLocaleString('en-us', { month: 'short', day: 'numeric', year: 'numeric' });
                var end_dateFormat = new Date(end_date).toLocaleString('en-us', { month: 'short', day: 'numeric', year: 'numeric' });
                var diff = new Date(end_date) - new Date(start_date);
                var days_diff = diff / (1000 * 60 * 60 * 24);
                $('#summary-date').text(start_dateFormat + " - " + end_dateFormat + " (" + days_diff + " night /s)");
                $('#invoice-date').text(start_dateFormat + " - " + end_dateFormat + " (" + days_diff + " night /s)");
                $('#summary-subtotal').text("PHP0");
                $('#input-subtotal').val(0);
                $('#summary-calc').text('');
                $('#summary-total-amount').text("PHP0");
                $('#invoice-subtotal').text("PHP0");
                $('#invoice-addons').text("PHP0");
                $('#invoice-meals').text("PHP0");
                $('#invoice-total-amount').text("PHP0");
                
                checkDateAvailability();
                
            }
        });

  //adult 
      $('#inc-adult').on('click', function(){
        var increment = parseInt($('#no_adult').val())+1;
        $('#no_adult').val(increment);
        $('#invoice-adult').text(increment);
        $('#summary-adult').text(increment);
        checkDateAvailability();
      })
      $('#dec-adult').on('click', function(){
        var decrement = parseInt($('#no_adult').val())-1;
        if(decrement < 0) {
          decrement = 0;
        }
        $('#no_adult').val(decrement);
        $('#invoice-adult').text(decrement)
        $('#summary-adult').text(decrement);
        checkDateAvailability();
      })

      //children
      $('#inc-children').on('click', function(){
        var increment = parseInt($('#no_children').val())+1;
        $('#no_children').val(increment);
        $('#invoice-children').text(increment)
        $('#summary-children').text(increment);
        checkDateAvailability();
      })
      $('#dec-children').on('click', function(){
        var decrement = parseInt($('#no_children').val())-1;
        if(decrement < 0) {
          decrement = 0;

        }
        $('#no_children').val(decrement)
        $('#invoice-children').text(decrement)
        $('#summary-children').text(decrement);
        checkDateAvailability();
      })

      $('#requests').change(function(){
        var requests = $('#requests').val();
        $('#invoice-requests').text(requests);
      })

      $('#firstname, #surname, #email, #phone_no, #address').change(function(){
        var firstname = $('#firstname').val();
        var surname = $('#surname').val();
        var email = $('#email').val();
        var phone_no = $('#phone_no').val();
        var address = $('#address').val();
        $('#invoice-firstname').text(firstname);
        $('#invoice-surname').text(surname);
        $('#invoice-address').text(address);
        $('#invoice-email').text(email);
        $('#invoice-phone_no').text(phone_no);
      })

        
      $('#payment_type').on('change', function() {
        var selectedOption = $(this).find('option:selected').text();
        $('#invoice-payment-type').text(selectedOption);
      });

      $('#resv_type').on('change', function() {
        var selectedOption = $(this).find('option:selected').text();
        $('#invoice-resv-type').text(selectedOption);
      });

      $('.btn-close').on('click', function(){
        $('.alert').hide();
        $('.overlay').hide();
      })
      $('.overlay').on('click', function(event) {
          if (!$(event.target).closest('.alert').length) {
              $('.alert').hide();
              $('.overlay').hide();
          }
      });

      function fadeOutOverlay() {
          setTimeout(function() {
              $('.overlay').fadeOut();
              $('.alert').fadeOut();
          }, 5000); 
      }

      fadeOutOverlay();
      var i = 0;
      $('#add').click(function(){
        ++i;
        $('#table').append(
          `<tr>
            <td>
              <input type="text" class="form-control" id="" name="inputs[${i}][items]">
            </td>
            <td>
              <input type="text" class="form-control qty" id="qty[${i}]" name="inputs[${i}][qty]" >
            </td>
            <td>
              <input type="text" class="form-control price" id="price[${i}]" name="inputs[${i}][price]" >
            </td>      
            <td>
              <input type="text" class="form-control total" id="total[${i}]" name="inputs[${i}][total]" >
            </td>  
            <td><button type="button" class="btn btn-danger remove-table-row" name="remove">Remove</button></td>
          </tr>`
        );
      });

      
      $(document).on('change', '.qty, .price', function() {
        var row = $(this).closest('tr');
        var qty = parseInt(row.find('.qty').val()) || 0;
        var price = parseInt(row.find('.price').val()) || 0;

        var total = qty * price;
        row.find('.total').val(total);

        var grandTotal = 0;
          $('.total').each(function() {
              var val = parseInt($(this).val()) || 0;
              grandTotal += val;
          });
          $('#summary-addons').text("PHP" + grandTotal);
          $('#input-addons').val(grandTotal);
          calculatePrice()
      });

      $(document).on('click', '.remove-table-row', function() {
         
          var rowTotal = parseInt($(this).closest('tr').find('.total').val()) || 0;
          $(this).closest('tr').remove();
          var grandTotal = 0;
          $('.total').each(function() {
              var val = parseInt($(this).val()) || 0;
              grandTotal += val;
          });
          
          $('#summary-addons').text("PHP" + grandTotal);
          $('#input-addons').val(grandTotal);
          calculatePrice()
      });



      function checkDateAvailability() {
                  
                  // Hide the room-card content
                  $('#card-container').hide();
                  // Show the preloader inside room-card
                  $('#card-container').html('<img src="{{asset('dashboard/assets/img/spinner3.gif')}}" height="100" width="94" style="display: block; margin: auto;">').show();
      
                  $('#selectOption').removeClass('is-valid');
                  var start_date = $('#start_date').val();
                  var end_date = $('#end_date').val();
                  var no_adult = parseInt($('#no_adult').val());
                  var no_children = parseInt($('#no_children').val());
      
                  $.ajax({
                      url: '/rooms/check',
                      type: 'GET',
                      dataType: 'json',
                      data: {
                          start_date: start_date,
                          end_date: end_date,
                          no_adult: no_adult,
                          no_children: no_children
                      },
                      success: function (response) {
                        
                          setTimeout(function () {
                            // Remove the preloader
                          $('.preloader').remove();
                          $('#card-container').empty();
                          $('#room_message').attr("class", "text-muted text-sm ml-5").text('');
                              if (response.length > 0) {
                              $.each(response, function (index, room_type) {

                                  var card_section = $('<section class="section">');
                                  var row = $('<div class="row align-items-top">');   
                                  var col_12 = $('<div class="col-lg-12">'); 
                                  var card = $('<div class="card mb-3">')
                                      .attr("id", "card_" + room_type.id)
                                      .css({
                                          'border': '1px solid transparent',
                                          'border-radius': '0px'
                                      }); 
                                  var row_g0 = $('<div class="row g-0">'); 
                                  var col_md4 = $('<div class="col-md-4">'); 
                                    var img = $('<img class="img-fluid rounded-start">')
                                  .attr("src", "{{ asset('storage/img/') }}" + "/" + room_type.image)
                                  .css({ 'height': '230px', 'width': '1000px' });
                                  var col_md8 = $('<div class="col-md-8">');     
                                  var card_body = $('<div class="card-body">');
                                  var title = $('<h5 class="card-title">').text(room_type.name);
                                  var hasWifi = room_type.wifi === '1' ? 'YES' : 'NO';
                                  var hasAC = room_type.ac === '1' ? 'YES' : 'NO';
                                  var sleeps = $('<p class="card-text">').html(
                                    '<i class="bi bi-person-fill" style="font-size: 16px;"></i> ' + room_type.total_sleeps 
                                    + ' | <i class="ri-hotel-bed-fill" style="font-size: 16px;"></i> ' + room_type.bed
                                    + ' | <i class="ri-showers-fill" style="font-size: 16px;"></i> ' + room_type.restroom
                                    + ' | <i class="ri-signal-wifi-fill" style="font-size: 16px;"></i> ' + hasWifi
                                    + ' | <i class="bi bi-wind" style="font-size: 16px;"></i> ' + hasAC
                                  );
                                  var description = $('<p class="card-text">').text(room_type.description);
                                  var price = $('<h5 class="card-title text-end">').text('PHP' + room_type.price);

                                  var colRad = $('<div class="col-1">').css({
                                      'display': 'none',
                                  });
                                  var radioBtn = $('<input class="radio-btn mb-3">')
                                      .attr("type", "radio").attr("id", "radio" + room_type.id)
                                      .attr("name", "roomid").val(room_type.id)
                                      .css({
                                          'display': 'none',
                                      });
                                  var label = $('<label>').attr("for", "radio" + room_type.id)
                                      .css('cursor', 'pointer');
      
                                  var label2 = $('<label class="radio">')
                                      .attr("id", "label_" + room_type.id)
                                      .css({
                                          'color': '#007bff',
                                      });


                                  colRad.append(radioBtn);
                                  colRad.append(label2);
                                 
                                  card_body.append(title);
                                  card_body.append(sleeps);
                                  card_body.append(description);
                                  card_body.append(price);
                                  col_md8.append(card_body);
                                  col_md4.append(img);
                                  row_g0.append(col_md4);
                                  row_g0.append(col_md8);
                                  card.append(colRad);
                                  card.append(row_g0);
                                  col_12.append(card);
                                  row.append(col_12);
                                  label.append(row);
                                  card_section.append(label);
                                  $('#card-container').append(card_section);
                              });
                            } else {
                                    $('#room_message').attr("class", "text-muted text-sm ml-5").text("No available rooms for selected dates.");
                                }
                          }, 1000);
                      }
                  });
              }

              
              $(document).on('change', '.radio-btn', function() {
                if ($('.radio-btn').is(':checked')) {
                    var roomId = $(this).val();
                    $.ajax({
                        url: '/room/' + roomId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(response) {
                          var totalMeals = 0;
                          $('#summary-meals').text("PHP" + totalMeals);
                          $('#input-meals').val(totalMeals);
                          $('#checkbox-container').empty();
                          $('#meals-container').empty();
                            $.each(response, function(index, room_type) {
                                $('#input-roomprice').val(room_type.price);
                                $('#summary-room').text(room_type.name);
                                $('#input_room_type').val(room_type.name);
                                $('.card').css('border-color', 'transparent');
                                  $('#card_' + room_type.id).css('border', '1px solid #007bff');
                                $.each(response.meals, function(index, meal) {
                                  if(meal.room_type_id == room_type.name){
                                 
                                    var label = $('<label class="form-label">').attr("for", "checkbox_" + meal.name)
                                          .css('cursor', 'pointer').text(meal.name);
                                    var checkboxBtn = $('<input class="form-check-input">')
                                            .attr("type", "checkbox").attr("id", "checkbox_" + meal.name)
                                            .attr("name", "meals[]").val(meal.name);
                                    var inputPrice = $('<input class="">')
                                            .attr("type", "hidden").attr("id", "input" + meal.name)
                                            .attr("name", "price[]").val(meal.price);   
                                    
                                    $('#checkbox-container').append(checkboxBtn).append(label).append(inputPrice).append('<br>'); 
                                    
                                    
                                  
                                    $(document).on('change', '[id^=checkbox_]', function() {
                                        var mealName = $(this).attr('id').replace('checkbox_', '');

                                        if ($(this).is(':checked')) {
                                            var mealPrice = $('#input' + mealName).val();
                                            totalMeals += parseFloat(mealPrice);
                                            var summaryMeals = $('<small class="text-muted">')
                                                .attr("id", "summary" + mealName)
                                                .text(mealName);   
                                            $('#meals-container').append(summaryMeals);
                                        } else {
                                            var mealPrice = $('#input' + mealName).val();
                                            totalMeals -= parseFloat(mealPrice);
                                            $('#summary' + mealName).remove();  
                                        }

                                        // Remove all line breaks from the meals container
                                        $('#meals-container br').remove();

                                        // Add line breaks after each summary item except the last one
                                        $('#meals-container small').not(':last').after('<br>');

                                        $('#summary-meals').text("PHP" + totalMeals);
                                        $('#input-meals').val(totalMeals);
                                        calculatePrice();
                                    });

                                  }
                                });
                                calculatePrice()
                            });
                        }
                    });
                }
              });

              function calculatePrice(){
                var start_date = $('#start_date').val();
                var end_date = $('#end_date').val(); 
                var prevadd_ons = parseInt($('#last-addons').val());
                var add_ons = parseInt($('#input-addons').val());   
                var meals = parseInt($('#input-meals').val());  
                var diff = new Date(end_date) - new Date(start_date);
                var days_diff = diff / (1000 * 60 * 60 * 24);  
                var room_price = parseInt($('#input-roomprice').val());   
                var subTotal = days_diff * room_price;
                var totalPrice =  meals + subTotal + add_ons + prevadd_ons; 
                    $('#summary-subtotal').text("PHP" + subTotal);
                    $('#input-subtotal').val(subTotal);
                    $('#summary-calc').text("( " + "PHP" + room_price + " x " + days_diff + " night /s)")
                    $('#summary-total-amount').text("PHP" + totalPrice);
                    $('#input-total-amount').val(totalPrice);

                    $('#invoice-subtotal').text("PHP" + subTotal);
                    $('#invoice-addons').text("PHP" + add_ons);
                    $('#invoice-meals').text("PHP" + meals);
                    $('#invoice-total-amount').text("PHP" +  totalPrice);

                    $('#invoice_extrabed2').text(" ( " + extrabedPrice + " x " + extrabed + " bed )");
                }
</script>

@endif

@endsection