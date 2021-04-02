@extends("layouts.admin")

@section("title", "Accept Client")

@section("content")
<div class="card card-primary w-75 m-auto">
    <div class="card-header">
        <h3 class="card-title">Accept Client</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form class="w-75 m-auto" method="POST" action="{{ route('client.update', $client->id ) }}" enctype="multipart/form-data">
        @csrf
        @method("PUT")
        <div class="card-body">
            <h3 class="mx-auto">Client Info</h3>
            <x-forms.input name="name" type="text" placeholder="Enter Name" :value="$client->user->name" disabled="true" />
            <x-forms.input name="email" type="email" placeholder="Enter email" :value="$client->user->email" disabled="true" />
            <x-forms.input name="national_id" type="text" placeholder="Enter national id" :value="$client->user->national_id" disabled="true" />
            <x-forms.input name="mobile" type="text" placeholder="Enter mobile" :value="$client->mobile" disabled="true" />
            <x-forms.input name="gender" type="text" placeholder="Enter gender" :value="$client->gender" disabled="true" />
            <x-forms.input name="country" type="text" placeholder="Enter country" :value="$client->country" disabled="true" />
        </div>
        <!-- /.card-body -->
        @hasanyrole('admin|manager')
        <div class="form-group">
            <label for="post_creator">ِAssign Receptionist</label>
            <select name="receptionist_id" class="form-control" id="post_creator" required>
                @foreach ($receptionists as $receptionist)
                <option value="{{$receptionist->id}}">{{$receptionist->user->name}}</option>
                @endforeach
            </select>
        </div>
        @endhasanyrole
        <div class="card w-50 mx-auto">
            <button type="submit" class="btn btn-primary">Apply</button>
        </div>


    </form>
</div>
@endsection