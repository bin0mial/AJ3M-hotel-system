@extends("layouts.admin")

@section("content")
    <div class="container">
        {{$dataTable->table()}}
    </div>
@endsection

@push("scripts")
    {{$dataTable->scripts()}}
@endpush

@push("scripts")
    <script>
        const deleteButton = (url, name) => {
            if (confirm(`Are you sure you want to delete ${name}, permanently`)){
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
                        $("#manager-table").ajax.reload();
                    },
                });
            }
        }
    </script>
@endpush
