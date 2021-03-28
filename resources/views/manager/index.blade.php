@extends('layouts.manager')

@section('content')
    
<div class="container">
    <table class="table table-dark table-hover">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">National id</th>
                {{-- <th scope="col">Image</th> --}}
                <th scope="col">Created At</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($recepts as $recept)
            <tr>
                <td> {{$recept->id }} </td>
                <td> {{$recept->name }} </td>
                <td> {{$recept->email }} </td>
                <td> {{$recept->national_id }} </td>
                <td> {{$recept->created_at }} </td>
                <td>
                    <a class="btn btn-success" href="#" role="button">Action</a> 
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection