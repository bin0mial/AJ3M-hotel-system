@extends('layouts.client')
@section('content')
<div class="container ">

<br>
<br>
<div class="row" style="justify-content: center">
    <h3>Available Rooms</h3>

</div>
    @if(session()->has("success"))
        <div class="alert alert-success">
            <ul>
                @foreach (session()->get("success") as $success)
                    <li>{!! $success !!}</li>
                @endforeach
            </ul>
        </div>
    @endif
<br>
    <div class="row">
        <!-- Room component -->
    @foreach ($rooms as $room)
        <div class="col-md-4">
            <div class="card">
                <div>
                    <img src="{{ asset('images/rooms/hotelRoom1.jpg') }}" class="img-responsive image">
                </div>
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
                    <p>Sleeps: <span><i class="bi bi-person-fill"></i> X {{ $room->capacity }}</span></p>
                    <h6 class="card-text price-tag  text-lg"> {{ $room->price }} <small class="text-muted"> per night </small></h6>
                    <a type="button" class="btn btn-success btn-lg btn-block" href="{{ route('clientHome.reserve' ,[$room->id]) }}">Reserve</a>
                </div>
            </div>
        </div>

    @endforeach
        <!-- End of Room component -->

    </div> <!-- end of class row-->
</div><!-- end of container-->
@endsection
