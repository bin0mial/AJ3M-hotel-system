@extends('layouts.admin')

@section('content')
    <div class="container overflow-auto">
        {{$dataTable->table()}}
    </div>
@endsection


@push('scripts')
    {{$dataTable->scripts()}}
    <script>

        const lockButton = (url, name, table) => {
            console.log(table);

            {{--const data = {--}}
            {{--    _method: "PUT",--}}
            {{--    _token: "{{ csrf_token() }}"--}}
            {{--}--}}
            {{--$.ajaxSetup({--}}
            {{--    url: url,--}}
            {{--    global: false,--}}
            {{--    headers: {--}}
            {{--        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),--}}
            {{--    },--}}
            {{--    type: "POST"--}}
            {{--});--}}

            {{--$.ajax({--}}
            {{--    type: "POST",--}}
            {{--    data: data,--}}
            {{--    success: function () {--}}
            $(".fade").remove();
            {{--        $(`#${table}-table`).DataTable().ajax.reload(null, false);--}}
            {{--    },--}}
            {{--    error: function (jqXhr){--}}
            {{--        alert(jqXhr.responseText)--}}
            {{--    },--}}
            {{--});--}}

        }
    </script>
@endpush
