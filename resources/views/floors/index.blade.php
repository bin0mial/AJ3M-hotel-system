@extends('layouts.admin')

@section('content')
    <div class="container overflow-auto">
        {{$dataTable->table()}}
    </div>
@endsection


@push('scripts')
    {{$dataTable->scripts()}}
    <script>

        const deleteFFButton = (url, name, table ,id) => {
            console.log(table);
            console.log(id);
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
                type: "POST",
                data: data,
                success: function () {
                    $(".fade").remove();
                    $(`#${table}-table`).DataTable().ajax.reload(null, false);
                },
                error: function (jqXhr){
                    $("#Fdelete"+id).css("display", "none");
                    $(".fade").remove();
                    $(`#${table}-table`).DataTable().ajax.reload(null, false);
                    alert(jqXhr.responseText);
                },
            });

        }
    </script>
@endpush
