@extends('master')

@section('content')

<a class="btn btn-success mt-3 mb-3" href="{{ route('device.create') }}">
    Crear
</a>

<table class="table">
    <thead>
        <tr>
            <td>
                Id
            </td>
            <td>
                UUID
            </td>
            <td>
                Habilitado
            </td>
            <td>
                Creación
            </td>
            <td>
                Actualización
            </td>
            <td>
                Acciones
            </td>
        </tr>
    </thead>
    <tbody>
        @foreach ($devices as $device)
        <tr>
            <td>
                {{ $device->id }}
            </td>
            <td>
                {{ $device->uuid }}
            </td>
            <td>
                {{ $device->enable }}
            </td>
            <td>
                {{ $device->created_at->format('d-m-Y') }}
            </td>
            <td>
                {{ $device->updated_at->format('d-m-Y') }}
            </td>
            <td>
                <a href="{{ route('device.show',$device->id) }}" class="btn btn-primary">Ver</a>
                <a href="{{ route('device.edit',$device->id) }}" class="btn btn-primary">Editar</a>

                <button data-toggle="modal" data-target="#deleteModal" data-id="{{ $device->id }}"
                    class="btn btn-danger">Borrar</button>

            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $devices->links() }}

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>¿Desea borrar este dispositivo?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

                <form id="formDelete" method="POST" action="{{ route('device.destroy',0) }}"
                    data-action="{{ route('device.destroy',0) }}">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger">Borrar</button>
                </form>


            </div>
        </div>
    </div>
</div>

<script>
    window.onload = function(){
        $('#deleteModal').on('show.bs.modal', function (event) {
                
        var button = $(event.relatedTarget) // Button that triggered the modal
        var id = button.data('id') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.

        action = $('#formDelete').attr('data-action').slice(0,-1)
        action += id
        console.log(action)

        $('#formDelete').attr('action',action)

        var modal = $(this)
        modal.find('.modal-title').text('Dispositivo: ' + id)
        });
    };
</script>

@endsection