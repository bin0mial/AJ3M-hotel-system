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
                        <h2 class="text-center border rounded-lg bg-light">Check Payment Info</h2>
                        <label for="guests_number" class="m-2">Number of Guests</label>
                        <input class="form-control" disabled value="{{ $request->guests_number }}" name="guests_number" id="guests_number" required>
                        <label for="nights_number" class="m-2">Reservation Period</label>
                        <input class="form-control" name="nights_number" disabled value="{{ $request->nights_number }}" id="nights_number" required>
                        <div class="card-footer bg-white px-sm-3 pt-sm-4 px-0">
                            <div class="row text-center ">
                                <div class="col my-auto border-line d-flex justify-content-around">
                                   {!! $checkout !!}
                                     <a href="/clientHome" class="btn btn-info">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row justify-content-between">
                    <div class="col">
                        <p class="text-muted"> Room ID: <span class="font-weight-bold text-dark">{{ $room->id }}</span></p>
                        <p class="text-muted"> Place on: <span class="font-weight-bold text-dark">{{ now()->isoFormat('ddd Do \of MMMM YYYY') }}</span> (today)</p>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="media flex-column flex-sm-row">
                    <div class="media-body ">
                        <h6 class="bold">Room Number</h6>
                        <p> {{ $room->number }}</p>
                        <p> {{ $request->nights_number }} <span class="text-muted">Night(s)</span></p>
                        <h4 class="mt-3 mb-4 bold">$ {{ $room->getNormalPrice() }}<span class="small text-muted"> per night</span></h4>
                        <h4 class="mt-3 mb-4 bold"><span class="small text-muted">for </span> {{ $request->guests_number }}<span class="small text-muted"> guest(s)</span></h4>
                        <p class="text-muted">Registration date on: <span class="Today">{{ now() }}</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('earlyScript')
    <script src="https://js.stripe.com/v3/"></script>
@endpush
