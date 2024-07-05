<!-- Modal -->
<div class="modal fade" id="editar_sintoma_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar síntoma</h5>
            </div>
            <form action="{{ route('update_sintoma') }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="sintoma_id" id="txt_editar_sintoma_id">
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="texto"><strong>Nombre</strong>(Minutos) </label>
                                    <br>
                                    <input type="text" name="nombre" id="txt_editar_nombre_sintoma"
                                        class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="tiempo_respuesta"><strong>Tiempo de respuesta</strong>(Minutos) </label>
                                <br>
                                <input type="number" name="tiempo_respuesta" id="txt_editar_tiempo_respuesta_sintoma"
                                    class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label for="tiempo_solucion"><strong>Tiempo de solución</strong> </label>
                                <br>
                                <input type="number" name="tiempo_solucion" id="txt_editar_tiempo_solucion_sintoma"
                                    class="form-control" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="$('#editar_sintoma_modal').modal('hide');"
                        data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>
