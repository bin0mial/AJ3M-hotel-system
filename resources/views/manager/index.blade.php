@extends("layouts.admin")

@section("content")
    {{$dataTable->table()}}
@endsection

@push("scripts")
    {{$dataTable->scripts()}}
@endpush
