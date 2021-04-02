@extends('layouts.admin')

@section('content')
    <div class="container">
        {{$dataTable->table()}}
    </div>
@endsection

@push('scripts')
    {{$dataTable->scripts()}}
@endpush


