@extends("layouts.admin")

@section("title", "Edit Manager")

@section("content")
    <div class="card card-primary w-75 m-auto">
        <div class="card-header">
            <h3 class="card-title">Edit Manager</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form class="w-75 m-auto" method="POST" action="{{ route('managers.update', $manager->id) }}" enctype="multipart/form-data">
            @csrf
            @method("PUT")
            <div class="card-body">
                <h3 class="mx-auto">Manager Info</h3>
                <x-forms.input name="name" type="text" placeholder="Enter Name" :value="$manager->user->name" required="true"/>
                <x-forms.input name="email" type="email" placeholder="Enter email" :value="$manager->user->email" required="true"/>
                <x-forms.input name="national_id" type="text" placeholder="Enter national id" :value="$manager->user->national_id" required="true"/>
                <x-forms.input name="password" type="password" placeholder="Password" />
                <x-forms.input name="password_confirmation" type="password" placeholder="Confirm Password"/>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group mb-3">
                            <label for="avatar_image">Choose image (optional)</label>
                            <input type="file" class="form-control-file" id="avatar_image" name="avatar_image" accept="image/jpeg,png">
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

