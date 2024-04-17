<!-- Modal -->
<div class="modal fade" id="create_adjuntos_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar seguimiento</h5>
            </div>
            <form action="{{ route('store_adjuntos') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="autor_id" value="{{ Auth::user()->id }}">
                <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="ruta">Seleccionar archivo</label>
                                <input type="file" name="ruta" class="form-control"
                                    accept="image/jpg, image/jpeg, image/png, video/mp4" required>
                                @error('file')
                                    <span style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="descripcion">Ingrese la descripcion</label>
                                    <textarea name="descripcion" class="form-control" required></textarea>
                                    @error('descripcion')
                                        <span style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        onclick="$('#create_adjuntos_modal').modal('hide');" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>
