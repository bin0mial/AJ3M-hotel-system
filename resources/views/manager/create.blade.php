@extends('layouts.manager')


@section('content')
    <div class="card card-primary w-75 m-auto">
        <div class="card-header">
            <h3 class="card-title">Create receptionist</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form class="w-75 m-auto"  method="POST" action="{{ route('manager.store') }}" enctype="multipart/form-data">
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
                    <label for="exampleInputFile">Choose image (optional)</label>
                    <div class="input-group">
                        <div class="input-group mb-3">
                            <label>Choose a picture:</label>
                            <input type="file" class="form-control-file" name="recept_image" accept="image/*">
                        </div>
                        <div class="input-group-append">
                            <span class="input-group-text">Upload</span>
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
