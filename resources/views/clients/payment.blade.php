@extends('layouts.client')
@section('content')
    <div class="container-fluid my-5 d-sm-flex justify-content-center">

        <div class="card px-2">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{!! $error !!}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card-header bg-white">
                <div class="row">
                    <div class="container">
                        <form class="form-inline" method="POST" action="{{ route('clientHome.pay' ,[$room->id]) }}">
                            @csrf
                            <label for="guests_number" class="m-2">Number of Guests</label>
                            <input class="form-control" min="1" max="{{ $room->capacity }}" name="guests_number" type="number" value="1" id="guests_number" required>
                            <label for="nights_number" class="m-2">Reservation Period</label>
                            <input class="form-control" name="nights_number" type="number" value="3" id="nights_number" required>
                            <button type="submit" class="btn btn-success m-2">Make Reservation</button>
                            <div class="card-footer bg-white px-sm-3 pt-sm-4 px-0">
                                <div class="row text-center ">
                                    <div class="col my-auto border-line ">
{{--                                        {{ $checkout }}--}}
                                        <h5> <a href="/clientHome"> Cancel </a> </h5>
                                    </div>
                                </div>
                            </div>
                        </form>
                        {!! $checkout !!}

                    </div>
                </div>
                <hr>
                <div class="row justify-content-between">
                    <div class="col">
                        <p class="text-muted"> Room ID <span class="font-weight-bold text-dark">{{ $room->id }}</span></p>
                        <p class="text-muted"> Place On <span class="font-weight-bold text-dark">{{ now() }}</span> </p>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="media flex-column flex-sm-row">
                    <div class="media-body ">
                        <h6 class="bold">Room Number</h6>
                        <p> {{ $room->number }}</span> </p>
                        <p class="text-muted"> Registerd for: 1 Night</p>
                        <p class="text-muted" style="margin-top:-10px ">Max for: {{ $room->capacity }}</p>
                        <br><br>
                        <h4 class="mt-3 mb-4 bold">$ {{ $room->getNormalPrice() }}<span class="small text-muted"> per night </span></h4>
                        <p class="text-muted">Registration date on: <span class="Today">{{ now() }}</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="https://js.stripe.com/v3/"></script>
    @endpush
@endsection