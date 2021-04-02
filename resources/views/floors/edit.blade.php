@extends('layouts.admin')

@section('content')
    <div class="card card-primary w-75 m-auto">
        <div class="card-header">
            <h3 class="card-title">Add Floor</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->

        <form class="w-75 m-auto" method="POST" action="{{ route('floors.update' , [$floor->id]) }}">
            @csrf
            @method('PUT')
            @role('admin')
            <div class="card-body">
                <h3>Manager Info</h3>
                <div class="form-group">
                    <div class="mx-auto">
                        <label>Manger:<span class="text-danger">*</span></label>
                        <select name="manager_id" class="form-control">
                            <option selected disabled value="">Select a name:</option>
                            @foreach ($managers as $manager)
                                @if($manager->id == Auth::user()->id)
                                    <option selected value="{{ $manager->id }}">{{ $manager->id }}- {{ $manager->user->name }}</option>
                                @else
                                    <option value="{{ $manager->id }}">{{ $manager->id }}- {{ $manager->user->name }}</option>
                                @endif

                            @endforeach
                        </select>
                    </div>
                </div>
                <h3 class="mx-auto">Floor Info</h3>
                @endrole
                @role('manager')
                <div class="form-group">
                    <label>Manager id<span class="text-danger">*</span></label>
                    <input type="number" class="form-control" name="manager_id" readonly value="{{ $floor->manager_id }}">
                </div>
                @endrole
                <div class="form-group">
                    <label>Floor name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="name" value="{{ $floor->name }}">
                </div>
                <div class="form-group">
                    <label>Floor number<span class="text-danger">*</span></label>
                    <input type="number" class="form-control" name="number" readonly value="{{ $floor->number }}">
                </div>
                <div class="card w-75 mx-auto">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
            <!-- /.card-body -->


        </form>
    </div>
@endsection
