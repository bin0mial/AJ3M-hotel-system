@extends('layouts.client')
@section('content')
<div class="container ">
{{-- <div class="row" style="justify-content: center">
    <h3>Reservation Request</h3>
</div>
<br> --}}
{{-- <div class="row">
    <div class="container">
        <form class="form-inline" style="justify-content: center">
          <label for="inlineFormEmail" class="m-2">Number of Guests</label>
          <input type="email" class="form-control m-2" id="inlineFormEmail">
          <label for="inlineFormPassword" class="m-2">Reservation Period</label>
          <input type="password" class="form-control m-2" id="inlineFormPassword">
          <button type="submit" class="btn btn-success m-2">Make Reservation</button>
        </form>
      </div>
</div> --}}
<br>
<br>
<br>
<div class="row" style="justify-content: center">
    <h3>Available Rooms</h3>
</div>
<br>
    <div class="row">
        <!-- Room component -->
        <div class="col-md-4">
            <div class="card">
                <div> <img src="{{ asset('images/rooms/hotelRoom1.jpg') }}" class="img-responsive image"> </div>
                <p class="rating">9.2</p>
                <div class="card-body">
                    <h5 class="card-title-desc" >The platinum terminal room</h5>
                    <p class="card-text" style="text-align: center"><i class="fa fa-star star-rating"></i><i class="fa fa-star star-rating"></i><i class="fa fa-star star-rating"></i><i class="fa fa-star star-rating"></i></p>
                    <h6>Room type: <small class="text-muted"> Premium Suite </small> </h6>
                    <p>Room Features: </p>
                    <ul>
                        <li>feature 1</li>
                        <li>feature 2</li>
                        <li>feature 3</li>
                    </ul>
                    <p>Sleeps: <span><i class="bi bi-person-fill"></i><i class="bi bi-person-fill"></i><i class="bi bi-person-fill"></i></span></p>

                    <h6 class="card-text price-tag">$ 1,399 <small class="text-muted"> per night </small></h6>
                    <button type="button" class="btn btn-success btn-lg btn-block">Reserve</button>
                </div>
            </div>
        </div>
        <!-- End of Room component -->

        <!-- Room component -->
        <div class="col-md-4">
            <div class="card">
                <div> <img src="{{ asset('images/rooms/hotelRoom1.jpg') }}" class="img-responsive image"> </div>
                <p class="rating">9.2</p>
                <div class="card-body">
                    <h5 class="card-title-desc" >The platinum terminal room</h5>
                    <p class="card-text" style="text-align: center"><i class="fa fa-star star-rating"></i><i class="fa fa-star star-rating"></i><i class="fa fa-star star-rating"></i><i class="fa fa-star star-rating"></i></p>
                    <h6>Room type: <small class="text-muted"> Premium Suite </small> </h6>
                    <p>Room Features: </p>
                    <ul>
                        <li>feature 1</li>
                        <li>feature 2</li>
                        <li>feature 3</li>
                    </ul>
                    <p>Sleeps: <span><i class="bi bi-person-fill"></i><i class="bi bi-person-fill"></i><i class="bi bi-person-fill"></i></span></p>

                    <h6 class="card-text price-tag">$ 1,399 <small class="text-muted"> per night </small></h6>
                    <button type="button" class="btn btn-success btn-lg btn-block">Reserve</button>
                </div>
            </div>
        </div>
        <!-- End of Room component -->

        <!-- Room component -->
        <div class="col-md-4">
            <div class="card">
                <div> <img src="{{ asset('images/rooms/hotelRoom1.jpg') }}" class="img-responsive image"> </div>
                <p class="rating">9.2</p>
                <div class="card-body">
                    <h5 class="card-title-desc" >The platinum terminal room</h5>
                    <p class="card-text" style="text-align: center"><i class="fa fa-star star-rating"></i><i class="fa fa-star star-rating"></i><i class="fa fa-star star-rating"></i><i class="fa fa-star star-rating"></i></p>
                    <h6>Room type: <small class="text-muted"> Premium Suite </small> </h6>
                    <p>Room Features: </p>
                    <ul>
                        <li>feature 1</li>
                        <li>feature 2</li>
                        <li>feature 3</li>
                    </ul>
                    <p>Sleeps: <span><i class="bi bi-person-fill"></i><i class="bi bi-person-fill"></i><i class="bi bi-person-fill"></i></span></p>

                    <h6 class="card-text price-tag">$ 1,399 <small class="text-muted"> per night </small></h6>
                    <button type="button" class="btn btn-success btn-lg btn-block">Reserve</button>
                </div>
            </div>
        </div>
        <!-- End of Room component -->


    </div> <!-- end of class row-->
</div><!-- end of container-->
@endsection
