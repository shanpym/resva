@extends('admin.layout')
@section('title', 'CCST | Resva')
@section('content')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>Reports</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Pages</li>
          <li class="breadcrumb-item active">Reports</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

   
    <section class="section">
      
      <div class="row">
        <div class="col-lg-12">
          <section class="section">
            <div class="row">
              <div class="card">
                <div class="card-body mt-3">
                  
    <div class="row">
      <div class="col-md-12">
        <form action="{{route('reports.post')}}" method="POST">
          @csrf
          <div class="row d-flex">
          <div class="col-sm-3 ">
            <small for="">Date</small>
              <div class="input-group mb-3">
                <input type="text" name="start_date" class="form-control" id="from-date">
                <span class="input-group-text">to</span>
                <input type="text" name="end_date" class="form-control" id="to-date">
              </div>
          </div>
          <div class="col-sm-2 ">
            <div class="col-sm-0" style="font-size: 16px;" >
              <small for="">Sort by Status</small>
              <select class="form-select" name="status" id="status">
                <option value="9" selected>All</option>
                <option value="1">Pending</option>
                <option value="2">Confirmed</option>
                <option value="3">Cancelled</option>
                <option value="4">Completed</option>
                <option value="5">Arrived</option>
              </select>
            </div>
          </div>
          <div class="col-md-2 pt-4" style="font-size: 16px;" >
            <button type="button" id="clear-btn" class="btn btn-secondary">Clear</button>
            <button type="button" id="clear-btn" class="btn btn-outline-primary">PDF</button>
          </div>
        </div>
          
        </form>
      </div>
    </div>
                  <table class="table table-bordered">
                    <style>
                      .col, .items{
                        background-color: #f1f4f7 !important;
                        font-weight: 600
                      }
                      .result{
                        color: #8c939b !important;
                      }
                    </style>
                    <thead>
                      <tr >
                        <th class="col">#</th>
                        <th class="col">Date Created</th>
                        <th class="col">Booking ID</th>
                        <th class="col">Booking Fee</th>
                        <th class="col">Add Ons</th>
                        <th class="col">Amount Paid</th>
                        <th class="col">Total</th>
                        {{-- <th scope="col" style="width: 10%;">Actions</th> --}}
                      </tr>
                    </thead>
                    <tbody id="result-data">
                    </tbody>
                    <tfoot>
                      <tr>
                        <th class="items" scope="row" style="padding-top: 15px !important; color: #0d6efd !important;"></th>
                        {{-- <td class="items"><span id="filter-date"></span></td> --}}
                        <td class="items"></td>
                        <td class="items"></td>
                        <td class="items" ><span id="total-price"></span></td>
                        <td class="items"><span id="total-addons"></span></td>
                        <td class="items" ><span id="amount-paid"></span></td>
                        <td class="items"><span id="earnings"></td>
                        {{-- <td class="items" style="padding-top: 10px !important;">
                          <button class="btn btn-sm btn-outline-primary" type="button" data-bs-toggle="modal" data-bs-target="#view">
                            See Details
                          </button>
                        </td> --}}
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>
    </section>

</main><!-- End #main -->

<!--MODAL -->
<div class="modal fade" id="view" tabindex="-1">
  <div class="modal-dialog modal-dialog-scrollable modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Booking Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Modal content goes here -->
      </div>
      <div class="modal-footer">
        <a href="" type="button" class="btn btn-secondary">PDF</a>
      </div>
    </div>
  </div>
</div><!-- End Vertically centered Modal-->

<script>
  $("#from-date").datepicker({
    dateFormat: 'yy-mm-dd',
    onSelect: function(selectedDate) {
      var minCheckOutDate = new Date(selectedDate);
      minCheckOutDate.setDate(minCheckOutDate.getDate() + 1);
      setTimeout(function() {
        $("#to-date").datepicker('option', 'minDate', minCheckOutDate).datepicker('show');
      }, 0);
      $(this).trigger('change');
    },
  });

  $("#to-date").datepicker({
    dateFormat: 'yy-mm-dd',
    onSelect: function(selectedDate) {
      $(this).trigger('change'); 
      filter();
    },
  });

  $("#clear-btn").on('click', function(){
    $('#result-data').empty();
    $('#filter-date').text('');
    $('#total-booking').text('');
    $('#amount-paid').text('');
    $('#total-price').text('');
    $('#earnings').text('');
    $('#status').val('9');
    $('#from-date').val('');
    $('#to-date').val('');
  });

  $("#status").change(filter);

  function filter() {
    var from_date = $('#from-date').val();
    var to_date = $('#to-date').val();
    var status = $('#status').val();

    var start_dateFormat = new Date(from_date).toLocaleString('en-us', { month: 'short', day: 'numeric', year: 'numeric' });
    var end_dateFormat = new Date(to_date).toLocaleString('en-us', { month: 'short', day: 'numeric', year: 'numeric' });

    $('#filter-date').text(start_dateFormat + ' - ' + end_dateFormat);

    $.ajax({
      url: '/filter/reports',
      type: 'GET',
      data: { 
        start_date: from_date,
        end_date: to_date,
        status: status
      },
      dataType: 'json',
      success: function(response) {
        var totalBooking = response.totalBooking;
        var totalAmountPaid = response.totalAmountPaid;
        var totalPrice = response.totalPrice;
        var earnings = response.earnings;
        
        // Clear any previous results
        $('#result-data').empty();
        
        $.each(response.bookings, function(index, booking) {
          $('#total-price').text('PHP' + booking.totalSubtotal);
          $('#total-addons').text('PHP' + booking.totalAddons);

          var createdDate = new Date(booking.created_at);
          var formattedDate = createdDate.toISOString().split('T')[0];
          var row = $('<tr>');
          row.append($('<th scope="row">').text(index + 1));
          row.append($('<td class="result">').text(formattedDate));
          row.append($('<td class="result">').text(booking.id));
          row.append($('<td class="result">').text('PHP' + booking.subtotal));
          row.append($('<td class="result">').text('PHP' + booking.addonsPrice));
          row.append($('<td class="result">').text('PHP' + booking.amountPaid));
          row.append($('<td class="result">').text('PHP' + booking.totalAmount));
            console.log("response:",booking.totalAddons);
          // row.append($('<td>').html('<button class="btn btn-sm btn-outline-primary" type="button" data-bs-toggle="modal" data-bs-target="#view">See Details</button>'));
          $('#result-data').append(row);
        });

        $('#total-booking').text(totalBooking);
        $('#amount-paid').text('PHP' + totalAmountPaid);
        
        $('#earnings').text('PHP' + response.newtotalPrice);
        
        console.log("response:",totalBooking, totalAmountPaid, totalPrice, earnings);
      },
      error: function(xhr, status, error) {
        console.error(xhr.response);
      }
    });
  }
</script>

@endsection
