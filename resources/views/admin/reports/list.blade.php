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

    <div class="row mb-3 p-3">
      <div class="col-md-12">
        <form action="{{route('reports.post')}}" method="POST">
          @csrf
          <div class="col-sm-2 mb-3" style="font-size: 16px; margin-right:10px !important" >
            <small for="">From</small>
            <input type="text" name="" name="start_date" class="form-control" id="from-date">
          </div>
          <div class="col-sm-2" style="font-size: 16px; margin-right:10px !important" >
            <small for="">To</small>
            <input type="text" name="" name="end_date" class="form-control" id="to-date">
          </div>
          <div class="col-sm-2 pt-3" style="font-size: 16px; margin-right:10px !important" >
           <button type="submit" class="btn btn-primary">Search</button>
          </div>
        </form>
          {{-- <div class="col-sm-2" style="font-size: 16px; margin-right:10px !important" >
            <select class="form-select text-muted w" name="" id="">
              <option value="" selected disabled>Sort by Status</option>
            </select>
          </div> --}}
         
      </div>
    </div>
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <section class="section">
            <div class="row">
              <div class="card">
                <div class="card-body mt-3">
                  
                  <style>
                    .items{
                      color: #8c939b !important;
                      padding-top: 15px !important;
                    }
                  </style>
      
                  <!-- Table with hoverable rows -->
                  <table class="table datatable table-hover">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col" >Date Searched</th>
                        <th scope="col">Total Bookings</th>
                        <th scope="col">Price</th>
                        <th scope="col">Earnings</th>
                        <th scope="col" style="width: 10%; !important;">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th class="items" scope="row" style="padding-top: 15px !important; color: #0d6efd !important;"></th>
                        <td class="items" style="padding-top: 5px !important;"><small><br></small></td>
                        <td class="items" style="padding-left: 25px !important;"></td>
                        <td class="items"></td>
                        <td class="items"></td>
                        <td  class="items" style="padding-top: 10px !important;">
                          <button class="btn btn-sm btn-outline-primary" type="button" data-bs-toggle="modal" data-bs-target="#view">
                            <i class="bi bi-eye-fill" style="font-size: 20px"></i>
                          </button>
                         
                          
                          <a href="" class="btn btn-sm btn-outline-info" type="button"><i class="bi bi-pencil-square"  style="font-size: 20px"></i></a>
                         
                        </td>
                      </tr>
                      <!--MODAL -->
                          <div class="modal fade" id="view" tabindex="-1">
                            <div class="modal-dialog modal-dialog-scrollable modal-xl">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title">Booking Details</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                
                                </div>
                                <div class="modal-footer">
                                  <a href="" type="button" class="btn btn-secondary">PDF</a>
                                  {{-- <button type="button" class="btn btn-primary">Pay Now</button> --}}
                                </div>
                              </div>
                            </div>
                          </div><!-- End Vertically centered Modal-->
                   
                    </tbody>
                  </table>
                  <!-- End Table with hoverable rows -->
      
                </div>
              </div>
            </div>
          </section>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <script>
    $("#from-date").datepicker({
       
            dateFormat: 'yy/mm/dd',
              onSelect: function(selectedDate) {
                
                
                $('#ui-datepicker-div table td a').attr('href', 'javascript:;');
                  var minCheckOutDate = new Date(selectedDate);
                  minCheckOutDate.setDate(minCheckOutDate.getDate() + 1);
                  setTimeout(function() {

                  $("#to-date").datepicker('option', 'minDate', minCheckOutDate).datepicker('show');
                }, 0);
                  $(this).trigger('change'); 
              }
          });

          $("#to-date").datepicker({
              dateFormat: 'yy/mm/dd',
              onSelect: function(selectedDate) {
                  $(this).trigger('change'); 
              },
          }); 
  </script>
@endsection