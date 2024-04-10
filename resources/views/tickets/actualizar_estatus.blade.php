<!-- Modal -->
<div class="modal fade" id="actualizar_estatus_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Actualizar estatus</h5>
            </div>
            <form action="{{ route('actualizar_estatus') }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="texto">Seleccione un estatus</label>
                        <select name="estatus_id" class="form-select" required>
                            <option value>---Seleccione--</option>
                            @foreach ($estatuses as $estatus)
                                <option value="{{ $estatus->id }}">{{ $estatus->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="$('#asignar_ticket_modal').modal('hide');"
                        data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>
