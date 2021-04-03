@extends('layouts.admin')
@section('content')
    <div class="card card-primary w-75 m-auto">
        <div class="card-header">
            <h3 class="card-title">Add Room</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->

        <form class="w-75 m-auto" method="POST" action="{{ route('rooms.store') }}" enctype="multipart/form-data">
            @csrf
            @role('admin')
            <div class="card-body">
                <h3>Manager Info</h3>
                <div class="form-group">
                    <div class="mx-auto">
                        <label>Manger:<span class="text-danger">*</span></label>
                        <select name="manager_id" class="form-control">
                            <option selected disabled>Select a name:</option>
                            @foreach ($managers as $manager)
                                @if(old('manager_id') == $manager->id)
                                    <option selected value="{{ $manager->id }}">{{ $manager->id }} {{ $manager->user->name }}</option>
                                @else
                                    <option value="{{ $manager->id }}">{{ $manager->id }} {{ $manager->user->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                @endrole

                <h3 class="mx-auto">Room Info</h3>
                <x-forms.input name="number" type="number" placeholder="Enter room number..." :value="old('number')" required="true"/>
                <x-forms.input name="capacity" type="number" placeholder="Enter room capacity..." :value="old('capacity')" required="true"/>
                <div class="form-group">
                    <label>Price $ <span class="text-danger">*</span></label>
                    <input value="{{old('price')}}" type="text" class="form-control" name="price"
                           placeholder="Enter room price...">
                </div>
                <h3>Floor Info</h3>
                <div class="form-group">
                    <div class="mx-auto">
                        <label>Floor Name:<span class="text-danger">*</span></label>
                        <select name="floor_id" class="form-control">
                            <option selected disabled value="{{old('floor_id')}}">Select a name:</option>
                            @foreach ($floors as $floor)
                                <option value="{{ $floor->id }}">{{ $floor->id }}- {{ $floor->name }}</option>
                                @if(old('floor_id') == $floor->id)
                                    <option selected value="{{ $floor->id }}">{{ $floor->id }}- {{ $floor->name }}</option>
                                @else
                                    <option value="{{ $floor->id }}">{{ $floor->id }}- {{ $floor->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="card w-75 mx-auto">
                    <button type="submit" class="btn btn-primary">Add Room</button>
                </div>
            </div>
            <!-- /.card-body -->


        </form>
    </div>
@endsection
