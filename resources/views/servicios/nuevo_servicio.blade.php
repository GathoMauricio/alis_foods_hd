<!-- Modal -->
<div class="modal fade" id="nuevo_servicio_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nuevo servicio / producto</h5>
            </div>
            <form action="{{ route('store_servicio') }}" method="POST">
                @csrf
                <input type="hidden" name="subcategoria_id" value="{{ $subcategoria->id }}">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="texto"><strong>Nombre</strong> </label>
                        <br>
                        <input type="text" name="nombre" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="$('#nuevo_servicio_modal').modal('hide');"
                        data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>
