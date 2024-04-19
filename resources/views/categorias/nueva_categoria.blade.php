<!-- Modal -->
<div class="modal fade" id="nueva_categoria_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nueva categoría</h5>
            </div>
            <form action="{{ route('store_categoria') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="texto"><strong>Nombre</strong> </label>
                        <br>
                        <input type="text" name="nombre" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        onclick="$('#nueva_categoria_modal').modal('hide');" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>
