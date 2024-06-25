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
               
                @php
                    // Extract the motto and highlights from your PHP variables
                    $heroMotto = $appearance->hero_motto;
                    $highlight1 = $appearance->hero_motto_highlight_1;
                    $highlight2 = $appearance->hero_motto_highlight_2;

                    // Create regular expressions to find whole words
                    $regex1 = '/\b' . preg_quote($highlight1, '/') . '\b/i';
                    $regex2 = '/\b' . preg_quote($highlight2, '/') . '\b/i';

                    // Replace matching words with styled spans
                    $heroMottoHighlighted = preg_replace($regex1, '<em class="highlight">$0</em>', $heroMotto);
                    $heroMottoHighlighted = preg_replace($regex2, '<span class="highlight">$0</span>', $heroMottoHighlighted);
                @endphp

                <h6>{{$appearance->hero_welcome}}</h6>

                <h2>{!! $heroMottoHighlighted !!}</h2>

                <p>{{$appearance->hero_description}}</p>
            
                <div class="main-red-button"><a href="{{route('add_book')}}">Book Now</a></div>
              </div>
            </div>
            <style>
              .right-image{
                  position: relative;
                }

                .image-mask {
                  position: absolute;
                  top: 0;
                  left: 0;
                  width: 100%;
                  height: 100%;
                  mask-image: url('{{ asset('home/assets/images/banner-right-image.png') }}');
                  mask-size: cover;
                  -webkit-mask-image: url('{{ asset('home/assets/images/banner-right-image.png') }}');
                  -webkit-mask-size: cover;
                }

                .about-mask {
                    position: absolute; /* Ensure the position is relative if needed */
                    left: 0;
                    width: 100%;
                    height: 80%;
                    mask-image: url('{{ asset('home/assets/images/about-bg.png') }}');
                    mask-size: cover;
                    -webkit-mask-image: url('{{ asset('home/assets/images/about-bg.png') }}');
                    -webkit-mask-size: cover;
                }
                .icon-mask {
                    position: relative; /* Ensure the position is relative if needed */
                    width: 100%;
                    height: 100%;
                    mask-image: url('{{ asset('home/assets/images/service-icon-01.png') }}');
                    mask-size: cover;
                    -webkit-mask-image: url('{{ asset('home/assets/images/service-icon-01.png') }}');
                    -webkit-mask-size: cover;
                }
             
                .room-mask {
                  position: relative;
                  top: 0;
                  left: 0;
                  width: 306px; 
                  height: 345.77px;
                  mask-image: url('{{ asset('home/assets/images/family.jpg') }}');
                  mask-size: contain;
                  -webkit-mask-image: url('{{ asset('home/assets/images/family.jpg') }}');
                  -webkit-mask-size: contain;
                }

                .room-mask img {
                  width: 306px; 
                  height: 345.77px;
                  object-fit: cover; /* Ensures the image covers the container */
                  position: absolute;
                  top: 0;
                  left: 0;
                }
            </style>
             <?php
                $hero = DB::table('appearance')->where('id', '1')->first();
              ?>
            <div class="col-lg-6">
              <div class="right-image wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.5s">
                <div class="image-mask">
                  <img src="{{ asset('storage/img/'.$hero->hero_image) }}" alt="mask image" style="width:636px; height: 604.3px;">
                </div>
                <img src="{{ asset('home/assets/images/banner-right-image.png') }}" alt="team meeting">
              </div>
            </div>
            
          </div>
        </div>
      </div>
    </div>
  </div>

  
  <?php
  $findImages = DB::table('appearance')->where('id', '2')->first();
  ?>
  <div class="about-mask">
    <img src="{{ asset('storage/img/'.$findImages->about_background) }}" alt="mask image" style="filter: brightness(0.5);">
  </div>

  <div id="about" class="about-us section">
    
    <div class="container">
      <div class="row">
        
        <div class="col-lg-4">
          <div class="left-image wow fadeIn" data-wow-duration="1s" data-wow-delay="0.2s">
            <img src="{{ asset('storage/img/'.$findImages->about_character) }}" alt="person graphic" style="width: 371px; height: 371px;">
          </div>
        </div>
        <div class="col-lg-8 align-self-center">
          <div class="services">
            <div class="row">
              <?php
                $about1 = $appearance->where('id', '2')->first();
                $about2 = $appearance->where('id', '3')->first();
                $about3 = $appearance->where('id', '4')->first();
                $about4 = $appearance->where('id', '5')->first();
              ?>
              <div class="col-lg-6">
                <div class="item wow fadeIn" data-wow-duration="1s" data-wow-delay="0.5s">
                  <div class="icon">
                    <div class="icon-mask">
                      <img src="{{ asset('storage/img/'.$about1->about_icon) }}" alt="reporting" style="width: 70px; height:70px;">
                    </div>
                  </div>
                  <div class="right-text">
                  
                    <h4>{{$about1->about_name}}</h4>
                    <p>{{$about1->about_description}}</p>
                    
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="item wow fadeIn" data-wow-duration="1s" data-wow-delay="0.7s">
                  <div class="icon">
                    <div class="icon-mask">
                      <img src="{{ asset('storage/img/'.$about2->about_icon) }}" alt="reporting" style="width: 70px; height:70px;">
                    </div>
                  </div>
                  <div class="right-text">
                    <h4>{{$about2->about_name}}</h4>
                    <p>{{$about2->about_description}}</p>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="item wow fadeIn" data-wow-duration="1s" data-wow-delay="0.9s">
                  <div class="icon">
                    <div class="icon-mask">
                      <img src="{{ asset('storage/img/'.$about3->about_icon) }}" alt="reporting" style="width: 70px; height:70px;">
                    </div>
                  </div>
                  <div class="right-text">
                    <h4>{{$about3->about_name}}</h4>
                    <p>{{$about3->about_description}}</p>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="item wow fadeIn" data-wow-duration="1s" data-wow-delay="1.1s">
                  <div class="icon">
                    <div class="icon-mask">
                      <img src="{{ asset('storage/img/'.$about4->about_icon) }}" alt="reporting" style="width: 70px; height:70px;">
                    </div>
                  </div>
                  <div class="right-text">
                    <h4>{{$about4->about_name}}</h4>
                    <p>{{$about4->about_description}}</p>
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
        @php
          $s_desc = DB::table('appearance')->where('id', 6)->first();

          $highlight1 = $s_desc->service_description_highlight_1;
          $highlight2 = $s_desc->service_description_highlight_2;
          $serviceDescription = $s_desc->service_name; // Assuming 'service_description' is the column name

          // Create regular expressions to find whole words
          $regex1 = '/\b' . preg_quote($highlight1, '/') . '\b/i';
          $regex2 = '/\b' . preg_quote($highlight2, '/') . '\b/i';

          // Replace matching words with styled spans
          $s_descHighlighted = preg_replace($regex1, '<em class="highlight">$0</em>', $serviceDescription);
          $s_descHighlighted = preg_replace($regex2, '<span class="highlight">$0</span>', $s_descHighlighted);
        @endphp
        <div class="col-lg-6 align-self-center  wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.2s">
          <div class="left-image">
            <img src="{{ asset('storage/img/'.$s_desc->service_image) }}" alt="" style="width: 591px; height: 413.69px">
          </div>
        </div>
      
        <div class="col-lg-6 wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.2s">
          <div class="section-heading">
            <h2>{!! $s_descHighlighted !!}</h2>
            <p>{{$s_desc->service_description}}</p>
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
      <?php
      $findRoom = DB::table('appearance')->where('id', '7')->first();
      $room1 = DB::table('room_type')->where('id', $findRoom->room_id)->first();

      $findRoom2 = DB::table('appearance')->where('id', '8')->first();
      $room2 = DB::table('room_type')->where('id', $findRoom2->room_id)->first();

      $findRoom3 = DB::table('appearance')->where('id', '9')->first();
      $room3 = DB::table('room_type')->where('id', $findRoom3->room_id)->first();

      $findRoom4 = DB::table('appearance')->where('id', '10')->first();
      $room4 = DB::table('room_type')->where('id', $findRoom4->room_id)->first();



      ?>
      <div class="row">
        <div class="col-lg-3 col-sm-6">
            <div class="item wow bounceInUp" data-wow-duration="1s" data-wow-delay="0.3s">
              <div class="hidden-content">
                <h4>{{$room1->name}}</h4>
                <p>{{$room1->description}}</p>
              </div>
              <div class="room-mask">
                <img src="{{ asset('storage/img/'.$room1->image) }}" alt="mask image">
              </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="item wow bounceInUp" data-wow-duration="1s" data-wow-delay="0.3s">
              <div class="hidden-content">
                <h4>{{$room2->name}}</h4>
                <p>{{$room2->description}}</p>
              </div>
              <div class="room-mask">
                <img src="{{ asset('storage/img/'.$room2->image) }}" alt="mask image">
              </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="item wow bounceInUp" data-wow-duration="1s" data-wow-delay="0.3s">
              <div class="hidden-content">
                <h4>{{$room3->name}}</h4>
                <p>{{$room3->description}}</p>
              </div>
              <div class="room-mask">
                <img src="{{ asset('storage/img/'.$room3->image) }}" alt="mask image">
              </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="item wow bounceInUp" data-wow-duration="1s" data-wow-delay="0.3s">
              <div class="hidden-content">
                <h4>{{$room4->name}}</h4>
                <p>{{$room4->description}}</p>
              </div>
              <div class="room-mask">
                <img src="{{ asset('storage/img/'.$room4->image) }}" alt="mask image">
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>

  {{-- <div id="blog" class="our-blog section">
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
  </div> --}}

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