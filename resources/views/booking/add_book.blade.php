@extends('booking.layout')
@section('title', 'CCST | Resva')
@section('content')
    
<main id="main" class="main m-auto" style="margin-top: 100px !important; width: 80%">

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
                    <img src="{{asset('dashboard/assets/img/pending.gif')}}" alt="" srcset="" style="width: 50%">
                </div>
                <div class="row mt-3">
                  <strong class="text-alert text-center">{{session('success')}}</strong>
              </div>
                <div class="row">
                    <small class="text-secondary text-center">Kindly check your email for confirmation details</small>
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
          <form action="{{route('guest.add_book.post')}}" method="post">
            @csrf
          
          @include('booking.multiform')
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
                <span class="text-muted" id="summary-date">MM/DD/YYYY to MM/DD/YYYY</span>
              </div>
            </div>
            <div class="row p-2">
              <div class="col-lg-12">
                <span class="text-muted"><span id="summary-adult">2</span> Adult - <span id="summary-children">0</span> Children</span>
              </div>
            </div>
            <div class="row p-2  mt-3">
              <div class="col-lg-9">
                <span class="text-muted" id="summary-room">Room 101</span>
                <input type="hidden" name="room_type" id="input_room_type" value="Single Bed">
              </div>
              <div class="col-lg-3">
                <span class="text-muted" id="summary-subtotal"></span><br>
                <input type="hidden" name="" id="input-subtotal" value="0">
                <small class="text-muted" style="font-size: 12px" id="summary-calc"></small>
              </div>
            </div>
            {{-- <div class="row p-2">
              <div class="col-lg-9">
                <span class="text-muted">Meal Options</span>
              </div>
              <div class="col-lg-3">
                <span class="text-muted" id="summary-meals"></span><br>
                <input type="hidden" name="input-meals" id="input-meals" value="0">
                <div id="meals-container">

                </div>
              </div>
            </div> --}}
            <div class="row p-2">
              <div class="col-lg-9">
                <span class="text-muted">Add ons</span>
              </div>
              <div class="col-lg-3">
                <span class="text-muted" id="summary-addons"></span><br>
                <input type="hidden" name="input-addons" id="input-addons" value="0">
              </div>
            </div>
            <hr>
            <input type="hidden" name="input-meals" id="input-meals" value="0">
            <input type="hidden" name="input-addons" id="input-addons" value="0">
            <div class="row p-2  mt-3">
              <div class="col-lg-9">
                <strong class="text-muted" >TOTAL</strong>
              </div>
              <div class="col-lg-3">
                <strong class="text-muted" id="summary-total-amount"></strong><br>
                <input type="hidden" name="total_amount" id="input-total-amount" value="0">
                
                
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
        $('#adult').text(increment);
        checkDateAvailability();
      })
      $('#dec-adult').on('click', function(){
        var decrement = parseInt($('#no_adult').val())-1;
        if(decrement < 1) {
          decrement = 1;
        }
        $('#no_adult').val(decrement);
        $('#invoice-adult').text(decrement)
        $('#summary-adult').text(decrement);
        $('#adult').text(decrement);
        checkDateAvailability();
      })

      //children
      $('#inc-children').on('click', function(){
        var increment = parseInt($('#no_children').val())+1;
        $('#no_children').val(increment);
        $('#invoice-children').text(increment)
        $('#summary-children').text(increment);
        $('#children').text(increment);
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
        $('#children').text(decrement);
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
                  $('#card-container').html('<img src="{{asset('dashboard/assets/img/spinner3.gif')}}" style="display: block; margin: auto; height: 100px !important; width:94px !important">').show();
      
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
                                roomsPrice = room_type.price;
                                $('#summary-room').text(room_type.name);
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
                var add_ons = parseInt($('#input-addons').val());   
                var meals = parseInt($('#input-meals').val());  
                  
                    var diff = new Date(end_date) - new Date(start_date);
                    var days_diff = diff / (1000 * 60 * 60 * 24);    
                    var subTotal = days_diff * roomsPrice;
                    var totalPrice = meals + subTotal + add_ons; 
                   console.log(totalPrice);

                    $('#summary-subtotal').text("PHP" + subTotal);
                    $('#input-subtotal').val(subTotal);
                    $('#summary-calc').text("( " + "PHP" + roomsPrice + " x " + days_diff + " night /s)")
                    $('#summary-total-amount').text("PHP" + totalPrice);
                    $('#input-total-amount').val(totalPrice);

                    $('#invoice-subtotal').text("PHP" + subTotal);
                    $('#invoice-addons').text("PHP" + add_ons);
                    $('#invoice-meals').text("PHP" + meals);
                    $('#invoice-total-amount').text("PHP" +  totalPrice);

                    $('#invoice_extrabed2').text(" ( " + extrabedPrice + " x " + extrabed + " bed )");
                }
</script>



@endsection