@extends('layouts.admin')

@section('content')

    <div class="container">
        {{$dataTable->table()}}
    </div>
@endsection

@push('scripts')
    {{$dataTable->scripts()}}
    <script>
        function delete_recept(url) {
            const data = {
                _method: "DELETE",
                _token: "{{ csrf_token() }}"
            }
            $.ajaxSetup({
                url: url,
                global: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                type: "POST"
            });
            $.ajax({
                type: "DELETE",
                data: data,
                success: function () {
                    $("#manager-table").ajax.reload();
                },
            });
        }
    </script>
@endpush


