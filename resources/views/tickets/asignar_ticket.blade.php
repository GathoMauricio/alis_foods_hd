<!-- Modal -->
<div class="modal fade" id="asignar_ticket_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Asignar ticket</h5>
            </div>
            <form action="{{ route('tomar_ticket') }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="texto">Seleccione un técnico</label>
                        <select name="tecnico_id" class="form-select" required>
                            <option value>---Seleccione--</option>
                            @foreach ($tecnicos as $tecnico)
                                <option value="{{ $tecnico->id }}">{{ $tecnico->name }} {{ $tecnico->apaterno }}
                                    {{ $tecnico->amaterno }}</option>
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
