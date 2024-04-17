<!-- Modal -->
<div class="modal fade" id="tomar_ticket_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tomar ticket</h5>
            </div>
            <form action="{{ route('estatus_ticket') }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                <input type="hidden" name="tecnico_id" value="{{ Auth::user()->id }}">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="texto"><strong>Seleccione el tipo de estatus para este ticket</strong> </label>
                        <br>
                        <select name="estatus_id" class="form-select" required
                            onchange="tipoEstatusProceso(this.value)">
                            <option value>---Seleccione--</option>
                            <option value="2">En proceso con terceros</option>
                            <option value="3">Iniciar proceso</option>
                        </select>
                    </div>
                    <div class="form-group" id="div_detalle_proceso_terceros" style="display:none">
                        <label for="texto"><strong>Ingrese los detalles del proceso con terceros</strong> </label>
                        <br>
                        <textarea name="detalle_proceso_terceros" id="txt_detalle_proceso_terceros" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="$('#tomar_ticket_modal').modal('hide');"
                        data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function tipoEstatusProceso(estatus_id) {
        console.log(estatus_id);
        if (estatus_id == 2) {
            $("#div_detalle_proceso_terceros").css('display', 'block');
            $("#txt_detalle_proceso_terceros").val('');
            $("#txt_detalle_proceso_terceros").prop('required', true);
        } else {
            $("#div_detalle_proceso_terceros").css('display', 'none');
            $("#txt_detalle_proceso_terceros").val('');
            $("#txt_detalle_proceso_terceros").prop('required', false);
        }
    }
</script>
