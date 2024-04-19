<!-- Modal -->
<div class="modal fade" id="nueva_sugerencia_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nueva sugerencia</h5>
            </div>
            <form action="{{ route('store_sugerencia') }}" method="POST">
                @csrf
                <input type="hidden" name="sintoma_id" value="{{ $sintoma->id }}">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="texto"><strong>Sugerencia</strong> </label>
                        <br>
                        <input type="text" name="nombre" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        onclick="$('#nueva_sugerencia_modal').modal('hide');" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>
