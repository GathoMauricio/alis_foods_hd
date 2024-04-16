<!-- Modal -->
<div class="modal fade" id="finalizar_ticket_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Finalizar ticket</h5>
            </div>
            <form action="{{ route('estatus_ticket') }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                <input type="hidden" name="estatus_id" value="5">
                <div class="modal-body">
                    <div class="form-group" id="div_detalle_proceso_terceros">
                        <label for="texto"><strong>Puede ingresar algun comentario antes de finalizar el
                                ticket</strong> </label>
                        <br>
                        <textarea name="detalle_finalizado" class="form-control"></textarea>
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
