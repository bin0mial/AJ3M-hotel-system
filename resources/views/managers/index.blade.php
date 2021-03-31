@extends("layouts.admin")

@section("title", "Managers")

@section("content")
    <div class="container">
        {{$dataTable->table()}}
    </div>
@endsection

@push("scripts")
    {{$dataTable->scripts()}}
@endpush
