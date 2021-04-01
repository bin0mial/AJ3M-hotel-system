<button type='button' class='btn btn-danger' data-toggle='modal' data-target='#delete{{ $id }}'>
    {{ $slot }}
</button>
<div class='modal fade' id='delete{{ $id }}' tabindex='-1'
     aria-labelledby='exampleModalLabel' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title  text-dark' id='exampleModalLabel'>
                    Are you sure you want to delete this receptionist ?
                </h5>
                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
            </div>
            <div class='modal-footer'>
                <form class='d-inline' method='POST' action='{{ $action }}'>
                    @csrf
                    @method('DELETE')
                    <button class='btn btn-danger' type='submit'>Yes ,delete</button>
                </form>
                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancel</button>
            </div>
        </div>
    </div>
</div>
