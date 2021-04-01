@extends('layouts.admin')


@section('content')
    <div class="card card-primary w-75 m-auto">
        <div class="card-header">
            <h3 class="card-title">Create receptionist</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form class="w-75 m-auto" method="POST" action="{{ route('receptionists.store') }}"
              enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                @role('admin')
                <h3>Manager Info</h3>
                <div class="form-group">
                    <div class="w-100">
                        <label>Manger:<span class="text-danger">*</span></label>
                        <select name="manager_id" class="form-control">
                            <option selected disabled value="">Select a name:</option>
                            @foreach ($managers as $manager)
                                <option value="{{ $manager->id }}">{{ $manager->id }} {{ $manager->user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <h3 class="mx-auto">Receptcionist Info</h3>
                @endrole

                <x-forms.input name="name" type="text" placeholder="Enter Name" :value="old('name')" required="true"/>
                <x-forms.input name="email" type="email" placeholder="Enter email" :value="old('email')" required="true"/>
                <x-forms.input name="national_id" type="text" placeholder="Enter national id" :value="old('national_id')" required="true"/>
                <x-forms.input name="password" type="password" placeholder="Password" required="true"/>
                <x-forms.input name="password_confirmation" type="password" placeholder="Confirm Password" required="true"/>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group mb-3">
                            <label for="avatar_image">Choose image (optional)</label>
                            <input type="file" class="form-control-file" id="avatar_image" name="avatar_image"
                                   accept="image/jpeg,png">
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
