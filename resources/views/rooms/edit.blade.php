@extends('layouts.admin')

@section('content')
    <div class="card card-primary w-75 m-auto">
        <div class="card-header">
            <h3 class="card-title">Add Floor</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->

        <form class="w-75 m-auto" method="POST" action="{{ route('rooms.update' , [$room->id]) }}">
            @csrf
            @method('PUT')
            @role('admin')
            <div class="card-body">
                <h3>Manager Info</h3>
                <div class="form-group">
                    <div class="mx-auto">
                        <label>Manger <span class="text-danger">*</span></label>
                        <select name="manager_id" class="form-control">
                            <option selected disabled value="">Select a name:</option>
                            @foreach ($managers as $manager)
                                @if($manager->id == $room->manager_id)
                                    <option selected value="{{ $manager->id }}">{{ $manager->id }}- {{ $manager->user->name }}</option>
                                @else
                                    <option value="{{ $manager->id }}">{{ $manager->id }}- {{ $manager->user->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                @endrole

                <h3 class="mx-auto">Floor Info</h3>
                <div class="mx-auto mb-2">
                    <label>Floor Name <span class="text-danger">*</span></label>
                    <select name="floor_id" class="form-control">
                        <option selected disabled value="">Select a name:</option>
                        @foreach ($floors as $floor)
                            @if($floor->id == $room->floor_id)
                                <option selected value="{{ $floor->id }}">{{ $floor->id }}- {{ $floor->name }}</option>
                            @else
                                <option value="{{ $floor->id }}">{{ $floor->id }}- {{ $floor->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <h3 class="mx-auto">Room Info</h3>
                <div class="form-group">
                    <label>Room Number <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" name="number" value="{{ $room->number }}">
                </div>
                <div class="form-group">
                    <label>Room Capacity <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" name="capacity" value="{{ $room->capacity }}">
                </div>
                <div class="form-group">
                    <label>Room Price ($) <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" name="price" value="{{ $room->getNormalPrice() }}">
                </div>

                <div class="card w-75 mx-auto">
                    <button type="submit" class="btn btn-primary">Update Room</button>
                </div>
            </div>
            <!-- /.card-body -->


        </form>
    </div>
@endsection
