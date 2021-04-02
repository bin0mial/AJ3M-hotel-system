@extends("layouts.main")
@section('title') AJ3M @endsection

@section('header')
    <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
        <div class="container">
        <a class="navbar-brand" href="#">AJ3M Hotels</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="nav navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#">Home<span class="sr-only">(current)</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#">Features</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#">Pricing</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/client">Login</a>
            </li>
          </ul>
        </div>
        </div>
    </nav>
@endsection

@section('content')
<br>
<div>
    <h3 style="text-align: center"> AJ3M Hotels – Share a Grand Experience!</h3>
    <br>
</div>
<section>
    <div class="row container">
      <div class="col-md-6 gx-5 mb-4">
        <div class="bg-image hover-overlay ripple shadow-2-strong" data-mdb-ripple-color="light">
          <img src="{{ asset('images/hotel_images/hotel_coffee.jpg') }}" class="img-fluid" />
          <a href="#!">
            <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
          </a>
        </div>
      </div>

      <div class="col-md-6  mb-4">
        <h4><strong>We speak your language! </strong></h4>
        <p class="text-muted">
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis consequatur
          eligendi quisquam doloremque vero ex debitis veritatis placeat unde animi laborum
          sapiente illo possimus, commodi dignissimos obcaecati illum maiores corporis.
        </p>
        <p><strong>Our vision</strong></p>
        <p class="text-muted">
          Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod itaque voluptate
          nesciunt laborum incidunt. Officia, quam consectetur. Earum eligendi aliquam illum
          alias, unde optio accusantium soluta, iusto molestiae adipisci et?
        </p>

        <p><strong>Our ethics</strong></p>
        <p class="text-muted">
          Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod itaque voluptate
          nesciunt laborum incidunt. Officia, quam consectetur. Earum eligendi aliquam illum
          alias, unde optio accusantium soluta, iusto molestiae adipisci et?
        </p>
      </div>
    </div>
  </section>
<br>
<div style="text-align: center"> <h3>The luxury of being yourself!</h3></div>
<div class="container my-2">
<!--Carousel Wrapper-->
<div id="carousel-thumb" class="carousel slide carousel-fade carousel-thumbnails shadow-2-strong " data-ride="carousel">
    <!--Slides-->
    <div class="carousel-inner" role="listbox">
      <div class="carousel-item active">
        <img class="d-block w-100" src="{{ asset('images/hotel_images/hotel_carousel1.jpg') }}"
          alt="First slide">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="{{ asset('images/hotel_images/hotel_carousel2.jpg') }}"
          alt="Second slide">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="{{ asset('images/hotel_images/hotel_carousel3.jpg') }}"
          alt="Third slide">
      </div>
    </div>
    <!--/.Slides-->
    <!--Controls-->
    <a class="carousel-control-prev" href="#carousel-thumb" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carousel-thumb" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
    <!--/.Controls-->
    <ol class="carousel-indicators">
      <li data-target="#carousel-thumb" data-slide-to="0" class="active">
        <img src="https://mdbootstrap.com/img/Photos/Others/Carousel-thumbs/img%20(88).jpg" width="100">
      </li>
      <li data-target="#carousel-thumb" data-slide-to="1">
        <img src="https://mdbootstrap.com/img/Photos/Others/Carousel-thumbs/img%20(121).jpg" width="100">
      </li>
      <li data-target="#carousel-thumb" data-slide-to="2">
        <img src="https://mdbootstrap.com/img/Photos/Others/Carousel-thumbs/img%20(31).jpg" width="100">
      </li>
    </ol>
  </div>
  <!--/.Carousel Wrapper-->
</div>
@endsection

@section('footer')
<!-- Grid container -->
<div class="container p-4">
    <!-- Section: Images -->
    <section class="">
      <div class="row">
          <!--Grid column-->
          <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
            <h5 class="text-uppercase">About Us</h5>
            <p>
              The AJ3M Porto hotel is a 4-star boutique hotel with many rooms located in the heart of terminal land,
              among agroup of listed buildings due to their historic value that date back to the late 18th century.
              The hotel sits next to the cosmopolitan terminal Square,
              one of the city’s major leisure and shopping areas the terminal Railway Station and some of its most visited tourist attractions.
            </p>
          </div>
          <!--Grid column-->

          <!--Grid column-->
          <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
            <h5 class="text-uppercase">Contacts</h5>

              <div>
              <ul style="text-align: left">
                  <li> Address: Central Halkidiki, Halkidiki, North Greece, Greece</li>
                  <li> Phone: 0030 123 111222</li>
                  <li> Phone: 0030 12322 2333</li>
                  <li> Phone: 0030 123 555666</li>
                  <li> Url: www.AJ3MHotels.com</li>
                  <li> Social: Facebook, Twitter, Pinterest</li>
              </ul>
              </div>
          </div>
          <!--Grid column-->
        </div>


      <div class="row">
      <!--first image-->
          <div class="col-lg-2 col-md-12 mb-4 mb-md-0">
              <div
              class="bg-image hover-overlay ripple shadow-1-strong rounded"
              data-ripple-color="light"
              >
                  <img
                      src="{{ asset('images/hotel_images/hotel1.jpg') }}"
                      class="w-100"
                  />
                  <a href="#!">
                      <div
                      class="mask"
                      style="background-color: rgba(251, 251, 251, 0.2);"
                      >
                      </div>
                  </a>
              </div>
          </div>

          <!--second image-->
          <div class="col-lg-2 col-md-12 mb-4 mb-md-0">
              <div
              class="bg-image hover-overlay ripple shadow-1-strong rounded"
              data-ripple-color="light"
              >
                  <img
                      src="{{ asset('images/hotel_images/hotel2.jpg') }}"
                      class="w-100"
                  />
                  <a href="#!">
                      <div
                      class="mask"
                      style="background-color: rgba(251, 251, 251, 0.2);"
                      >
                      </div>
                  </a>
              </div>
          </div>

          <!--third image-->
          <div class="col-lg-2 col-md-12 mb-4 mb-md-0">
              <div
              class="bg-image hover-overlay ripple shadow-1-strong rounded"
              data-ripple-color="light"
              >
                  <img
                      src="{{ asset('images/hotel_images/hotel7.jpg') }}"
                      class="w-100"
                  />
                  <a href="#!">
                      <div
                      class="mask"
                      style="background-color: rgba(251, 251, 251, 0.2);"
                      >
                      </div>
                  </a>
              </div>
          </div>

          <!--fourth image-->
          <div class="col-lg-2 col-md-12 mb-4 mb-md-0">
              <div
              class="bg-image hover-overlay ripple shadow-1-strong rounded"
              data-ripple-color="light"
              >
                  <img
                      src="{{ asset('images/hotel_images/hotel5.jpg') }}"
                      class="w-100"
                  />
                  <a href="#!">
                      <div
                      class="mask"
                      style="background-color: rgba(251, 251, 251, 0.2);"
                      >
                      </div>
                  </a>
              </div>
          </div>

          <!--fifth image-->
          <div class="col-lg-2 col-md-12 mb-4 mb-md-0">
              <div
              class="bg-image hover-overlay ripple shadow-1-strong rounded"
              data-ripple-color="light"
              >
                  <img
                      src="{{ asset('images/hotel_images/hotel6.jpg') }}"
                      class="w-100"
                  />
                  <a href="#!">
                      <div
                      class="mask"
                      style="background-color: rgba(251, 251, 251, 0.2);"
                      >
                      </div>
                  </a>
              </div>
          </div>

          <!--sixth image-->
          <div class="col-lg-2 col-md-12 mb-4 mb-md-0">
              <div
              class="bg-image hover-overlay ripple shadow-1-strong rounded"
              data-ripple-color="light"
              >
                  <img
                      src="{{ asset('images/hotel_images/hotel3.jpg') }}"
                      class="w-100"
                  />
                  <a href="#!">
                      <div
                      class="mask"
                      style="background-color: rgba(251, 251, 251, 0.2);"
                      >
                      </div>
                  </a>
              </div>
          </div>
      </div>
    </section>
    <!-- Section: Images -->
  </div>
  <!-- Grid container -->

  <!-- Copyright -->
  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
    © 2021 Copyright:
    <a class="text-white" href="/home">AJ3MHotles Staff</a>
  </div>
  <!-- Copyright -->
@endsection

