 <!-- Default Accordion -->
 <h5 class="card-title"><small class="text-muted">Add ons  </small></h5>

 <div class="accordion" id="accordionExample">
    {{-- <div class="accordion-item">
      <h2 class="accordion-header" id="headingOne">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Meal Option/s
        </button>
      </h2>
      <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
        <div class="accordion-body">
            <div id="checkbox-container">
              
                @foreach ($mealOptions as $meal)
                <input type="checkbox" class="form-check-radio" name="meals[]" id="meals" value="{{$meal->meals}}" checked><label for="meals">{{$meal->meals}}</label>
                <input type="hidden" class="form-check-radio" name="price[]" id="" value="{{$meal->price}}">
                @endforeach
              
            </div>
        </div>
      </div>
    </div> --}}
    <div class="accordion-item">
      <h2 class="accordion-header " id="headingThree">
        <button class="accordion-button collapsed bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
          Do you have any request/s?
        </button>
      </h2>
      <div id="collapseThree" class="accordion-collapse collapse collapse show" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
        <div class="accordion-body">
            <p class="text-muted">Requests fees may vary</p>
            <input type="text" class="form-control @error('requests') is-invalid @enderror" name="requests" id="requests" value="{{old('requests')}}">
        </div>
      </div>
    </div>
  </div><!-- End Default Accordion Example -->