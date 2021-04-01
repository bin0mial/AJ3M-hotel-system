@extends('layouts.admin')

@section('content')
    <div class="container overflow-auto">
        {{$dataTable->table()}}
    </div>
@endsection


@push('scripts')
    {{$dataTable->scripts()}}
    <script>


    </script>
@endpush
