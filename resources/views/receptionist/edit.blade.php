@extends('layouts.admin')


@section('content')
    <div class="card card-primary w-75 m-auto">
        <div class="card-header">
            <h3 class="card-title">Edit receptionist</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
{{--        @dd($receptionist)--}}
        <form class="w-75 m-auto"  method="POST" action="{{ route('receptionist.update' , [$receptionist->id] ) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card-body">
                @role('admin')
                <h3>Manager Info</h3>
                <div class="form-group">
                    <div class="w-100">
                        <label>Manger:<span class="text-danger">*</span></label>
                        <select name="manager_id" class="form-control">
                            <option selected disabled value="">Select a name:</option>
                            {{-- @foreach ($users as $user) --}}
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            {{-- @endforeach --}}
                        </select>
                    </div>
                </div>
                @endrole
                <h3 class="mx-auto">Receptcionist Info</h3>
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="recept_name" placeholder="Enter name"
                           value="{{ $receptionist->name }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" name="recept_email" placeholder="Enter email"
                           value="{{ $receptionist->email }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">National id</label>
                    <input type="number" class="form-control" name="recept_national_id" placeholder="Enter national id"
                            value="{{ $receptionist->national_id ? $receptionist->national_id : "" }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Change Password</label>
                    <input type="password" class="form-control" name="recept_password" placeholder="Password">
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group mb-3">
                            <label>Choose image (optional)</label>
                            <input type="file" class="form-control-file" name="recept_image" accept="image/*">
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
