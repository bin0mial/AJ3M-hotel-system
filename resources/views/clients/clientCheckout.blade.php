@extends('layouts.client')
@section('content')
<div class="container-fluid my-5 d-sm-flex justify-content-center">
    <div class="card px-2">
        <div class="card-header bg-white">
            <div class="row justify-content-between">
                <div class="col">
                    <p class="text-muted"> Room ID <span class="font-weight-bold text-dark">1222528743</span></p>
                    <p class="text-muted"> Place On <span class="font-weight-bold text-dark">12,March 2021</span> </p>
                </div>
                <div class="flex-col my-auto">
                    <h6 class="ml-auto mr-3"> <a href="#">View Details</a> </h6>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="media flex-column flex-sm-row">
                <div class="media-body ">
                    <h5 class="bold">Room Name</h5>
                    <p class="text-muted"> Registerd for: 1 Night</p>
                    <h4 class="mt-3 mb-4 bold"> <span class="mt-5">$</span> 1,500 <span class="small text-muted"> via (Master Card) </span></h4>
                    <p class="text-muted">Registration date on: <span class="Today">11:30pm, Today</span></p>
                    <div class="row">
                        <div class="container">
                            <form class="form-inline" style="justify-content: center">
                              <label for="inlineFormEmail" class="m-2">Number of Guests</label>
                              <input type="email" class="form-control m-2" id="inlineFormEmail">
                              <label for="inlineFormPassword" class="m-2">Reservation Period</label>
                              <input type="password" class="form-control m-2" id="inlineFormPassword">
                              <button type="submit" class="btn btn-success m-2">Make Reservation</button>
                            </form>
                          </div>
                    </div>
                </div><img class="align-self-center img-fluid" src="{{ asset('images/hotel_images/hotel4.jpg') }}" class="img-responsive image" style="width: 50%">
            </div>
        </div>

        <div class="card-footer bg-white px-sm-3 pt-sm-4 px-0">
            <div class="row text-center ">
                <div class="col my-auto border-line ">
                    <h5>Cancel</h5>
                </div>
                <div class="col my-auto border-line ">
                    <h5>Pre-pay</h5>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
