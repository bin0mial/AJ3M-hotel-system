@extends('layouts.admin')


@section('content')
    <div class="card card-primary w-75 m-auto">
        <div class="card-header">
            <h3 class="card-title">Create receptionist</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form class="w-75 m-auto"  method="POST" action="{{ route('receptionist.store') }}" enctype="multipart/form-data">
            @csrf
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
                    <label>Name<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="recept_name" placeholder="Enter name">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" name="recept_email" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">National id <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" name="recept_national_id" placeholder="Enter national id">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password <span class="text-danger">*</span></label>
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
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
        </form>
    </div>

@endsection
