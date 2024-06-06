@extends('layout')
@section('title', 'CCST | Resva')
@section('content')
    
  <div class="main-banner wow fadeIn" id="top" data-wow-duration="1s" data-wow-delay="0.5s">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="row">
            <div class="col-lg-6 align-self-center">
              <div class="left-content header-text wow fadeInLeft" data-wow-duration="1s" data-wow-delay="1s">
                <h6>Welcome to CCST Resva Hotel</h6>
                <h2>Where  <em>Luxury </em><span>Meets </span> Hospitality</h2>
                <p>CCST Resva is a system made by a group of ACT students from CCST.</p>
                <div class="main-red-button"><a href="{{route('add_book')}}">Book Now</a></div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="right-image wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.5s">
                <img src="{{asset('home/assets/images/banner-right-image.png')}}" alt="team meeting">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="about" class="about-us section">
    <div class="container">
      <div class="row">
        <div class="col-lg-4">
          <div class="left-image wow fadeIn" data-wow-duration="1s" data-wow-delay="0.2s">
            <img src="{{asset('home/assets/images/about-left-image.png')}}" alt="person graphic">
          </div>
        </div>
        <div class="col-lg-8 align-self-center">
          <div class="services">
            <div class="row">
              <div class="col-lg-6">
                <div class="item wow fadeIn" data-wow-duration="1s" data-wow-delay="0.5s">
                  <div class="icon">
                    <img src="home/assets/images/service-icon-01.png" alt="reporting">
                  </div>
                  <div class="right-text">
                    <h4>Accommodation</h4>
                    <p>Guests can reserve rooms based on their preferences</p>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="item wow fadeIn" data-wow-duration="1s" data-wow-delay="0.7s">
                  <div class="icon">
                    <img src="home/assets/images/service-icon-02.png" alt="">
                  </div>
                  <div class="right-text">
                    <h4>Flexible Booking Options</h4>
                    <p>Allowing guests to modify or cancel their reservations</p>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="item wow fadeIn" data-wow-duration="1s" data-wow-delay="0.9s">
                  <div class="icon">
                    <img src="home/assets/images/service-icon-03.png" alt="">
                  </div>
                  <div class="right-text">
                    <h4>Best Rate Guarantees</h4>
                    <p>Clearly displaying all fees, taxes, and additional charges upfront</p>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="item wow fadeIn" data-wow-duration="1s" data-wow-delay="1.1s">
                  <div class="icon">
                    <img src="home/assets/images/service-icon-04.png" alt="">
                  </div>
                  <div class="right-text">
                    <h4>Additional Services</h4>
                    <p>Lorem ipsum dolor sit amet, ctetur aoi adipiscing eliter</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="services" class="our-services section">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 align-self-center  wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.2s">
          <div class="left-image">
            <img src="home/assets/images/services-left-image.png" alt="">
          </div>
        </div>
        <div class="col-lg-6 wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.2s">
          <div class="section-heading">
            <h2>Learn more About the <em>services</em> that we <span>Provide</span></h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi ipsa illum repellendus neque quas! Aliquid sint qui quisquam labore maxime cupiditate temporibus eum nihil quos? Explicabo ipsa sapiente magnam quibusdam.</p>
          </div>
          <div class="main-red-button"><a href="{{route('add_book')}}">Book Now</a></div>
        </div>
      </div>
    </div>
  </div>

  <div id="portfolio" class="our-portfolio section mb-5">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 offset-lg-3">
          <div class="section-heading  wow bounceIn" data-wow-duration="1s" data-wow-delay="0.2s">
            <h2>Check out our <em>Available</em> <span>Rooms!</span></h2>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-3 col-sm-6">
          <a href="#">
            <div class="item wow bounceInUp" data-wow-duration="1s" data-wow-delay="0.3s">
              <div class="hidden-content">
                <h4>Single Bed</h4>
                <p>Lorem ipsum dolor sit ameti ctetur aoi adipiscing eto.</p>
              </div>
              
                <img src="home/assets/images/portfolio-image.png" alt="">
              
            </div>
          </a>
        </div>
        <div class="col-lg-3 col-sm-6">
          <a href="#">
            <div class="item wow bounceInUp" data-wow-duration="1s" data-wow-delay="0.4s">
              <div class="hidden-content">
                <h4>Deluxe Room</h4>
                <p>Lorem ipsum dolor sit ameti ctetur aoi adipiscing eto.</p>
              </div>
                <img src="home/assets/images/portfolio-image.png" alt="">
              
            </div>
          </a>
        </div>
        <div class="col-lg-3 col-sm-6">
          <a href="#">
            <div class="item wow bounceInUp" data-wow-duration="1s" data-wow-delay="0.5s">
              <div class="hidden-content">
                <h4>Family Room</h4>
                <p>Lorem ipsum dolor sit ameti ctetur aoi adipiscing eto.</p>
              </div>
                <img src="home/assets/images/portfolio-image.png" alt="">
              
            </div>
          </a>
        </div>
        <div class="col-lg-3 col-sm-6">
          <a href="#">
            <div class="item wow bounceInUp" data-wow-duration="1s" data-wow-delay="0.6s">
              <div class="hidden-content">
                <h4>Executive Room</h4>
                <p>Lorem ipsum dolor sit ameti ctetur aoi adipiscing eto.</p>
              </div>
                <img src="home/assets/images/portfolio-image.png" alt="">
              
            </div>
          </a>
        </div>
      </div>
    </div>
  </div>

  <div id="blog" class="our-blog section">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.25s">
          <div class="section-heading">
            <h2>See What our <em>Guest</em> think of <span>Us</span></h2>
          </div>
        </div>
        <div class="col-lg-6 wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.25s">
          <div class="top-dec">
            <img src="home/assets/images/blog-dec.png" alt="">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-6 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.25s">
          <div class="left-image">
            <a href="#"><img src="home/assets/images/big-blog-thumb.jpg" alt="Workspace Desktop"></a>
          </div>
        </div>
        <div class="col-lg-6 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.25s">
          <div class="right-list">
            <ul>
              <li>
                <div class="left-content align-self-center">
                  <span><i class="fa fa-calendar"></i> 18 Mar 2021</span>
                  <a href="#"><h4>Juan Dela Cruz</h4></a>
                  <p>Lorem ipsum dolor sit amsecteturii and sed doer ket eismod...</p>
                </div>
              </li>
              <li>
                <div class="left-content align-self-center">
                  <span><i class="fa fa-calendar"></i> 14 Mar 2021</span>
                  <a href="#"><h4>John Doe</h4></a>
                  <p>Lorem ipsum dolor sit amsecteturii and sed doer ket eismod...</p>
                </div>
              </li>
              <li>
                <div class="left-content align-self-center">
                  <span><i class="fa fa-calendar"></i> 06 Mar 2021</span>
                  <a href="#"><h4>John Doe</h4></a>
                  <p>Lorem ipsum dolor sit amsecteturii and sed doer ket eismod...</p>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- <div id="contact" class="contact-us section">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 align-self-center wow fadeInLeft" data-wow-duration="0.5s" data-wow-delay="0.25s">
          <div class="section-heading">
            <h2>Feel Free To Send Us a Message About Your Reservation Needs</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed doer ket eismod tempor incididunt ut labore et dolores</p>
            <div class="phone-info">
              <h4>For any inquiry, Call Us: <span><i class="fa fa-phone"></i> <a href="#">010-020-0340</a></span></h4>
            </div>
          </div>
        </div>
        <div class="col-lg-6 wow fadeInRight" data-wow-duration="0.5s" data-wow-delay="0.25s">
          <form id="contact" action="" method="post">
            <div class="row">
              <div class="col-lg-6">
                <fieldset>
                  <input type="name" name="name" id="name" class="form-control" placeholder="Name" autocomplete="on" >
                </fieldset>
              </div>
              <div class="col-lg-6">
                <fieldset>
                  <input type="surname" name="surname" id="surname" class="form-control" placeholder="Surname" autocomplete="on" >
                </fieldset>
              </div>
              <div class="col-lg-12">
                <fieldset>
                  <input type="text" name="email" id="email" pattern="[^ @]*@[^ @]*"  class="form-control" placeholder="Your Email" >
                </fieldset>
              </div>
              <div class="col-lg-12">
                <fieldset>
                  <textarea name="message" type="text" class="form-control" id="message" placeholder="Message" ></textarea>  
                </fieldset>
              </div>
              <div class="col-lg-12">
                <fieldset>
                  <button type="submit" id="form-submit" class="main-button ">Send Message</button>
                </fieldset>
              </div>
            </div>
            <div class="contact-dec">
              <img src="home/assets/images/contact-decoration.png" alt="">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div> --}}

@endsection