@extends('layouts.admin')


@section('content')
    <div class="card card-primary w-75 m-auto">
        <div class="card-header">
            <h3 class="card-title">Edit receptionist</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form class="w-75 m-auto"  method="POST" action="{{ route('receptionists.update' , [$receptionist->id] ) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">
                @role('admin')
                <h3>Manager Info</h3>
                <div class="form-group">
                    <div class="w-100">
                        <label>Manger:<span class="text-danger">*</span></label>
                        <select name="manager_id" class="form-control">
                            <option selected disabled>Select a name:</option>
                             @foreach ($managers as $manager)
                                 @if($receptionist->receptionist->manager->user->name == $manager->user->name)
                                    <option selected value="{{ $manager->id }}">{{ $manager->id }}- {{ $manager->user->name }}</option>
                                @else
                                    <option value="{{ $manager->id }}">{{ $manager->id }}- {{ $manager->user->name }}</option>
                                @endif

                             @endforeach
                        </select>
                    </div>
                </div>
                <h3 class="mx-auto">Receptcionist Info</h3>
                @endrole

                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Enter name"
                           value="{{ $receptionist->name }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" name="email" placeholder="Enter email"
                           value="{{ $receptionist->email }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">National id</label>
                    <input type="number" class="form-control" name="national_id" placeholder="Enter national id"
                            value="{{ $receptionist->national_id ? $receptionist->national_id : "" }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Change Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Password">
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group mb-3">
                            <label>Choose image (optional)</label>
                            <input type="file" class="form-control-file" name="image" accept="image/*">
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card w-50 mx-auto">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>

@endsection
