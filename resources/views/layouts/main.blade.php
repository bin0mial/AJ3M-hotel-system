<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
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
                <a class="nav-link" href="#">Register</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#">Login</a>
            </li>
          </ul>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="text-center text-white fixed-bottom" style="background-color: #caced1;">
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
                            src="{{ Storage::url('public/hotel_images/hotel1.jpg') }}"
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
                            src="{{ Storage::url('public/hotel_images/hotel2.jpg') }}"
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
                            src="{{ Storage::url('public/hotel_images/hotel3.jpg') }}"
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
                            src="{{ Storage::url('public/hotel_images/hotel5.jpg') }}"
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
                            src="{{ Storage::url('public/hotel_images/hotel6.jpg') }}"
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
                            src="{{ Storage::url('public/hotel_images/hotel7.jpg') }}"
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
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>
</html>
