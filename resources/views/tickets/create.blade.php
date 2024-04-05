@extends('layouts.app')

@section('content')
    <div class="container p-3" style="background-color: white;border: solid 5px #f4f6f9;">
        <h3>
            Crear ticket
        </h3>
        <form action="{{ route('store_tickets') }}" id="form_store_tickets" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="categoria">Categoría</label>
                        <select name="categoria" id="cbo_categoria" onchange="cargarSubcategorias(this.value);"
                            class="form-select select2">
                            <option value>--Seleccione--</option>
                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger" id="error_categoria"></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="subcategoria">Subcategoria</label>
                        <select name="subcategoria" id="cbo_subcategoria" onchange="cargarServicios(this.value);"
                            class="form-select select2">
                            <option value>--Seleccione--</option>
                        </select>
                        <span class="text-danger" id="error_subcategoria"></span>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="servicio">Servicio /Artículo</label>
                        <select name="servicio" id="cbo_servicio" onchange="cargarSintomas(this.value);"
                            class="form-select select2">
                            <option value>--Seleccione--</option>
                        </select>
                        <span class="text-danger" id="error_servicio"></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="sintoma_id">Sintoma</label>
                        <select name="sintoma_id" id="cbo_sintoma" class="form-select select2"
                            onchange="cargarSugerencia(this.value)">
                            <option value>--Seleccione--</option>
                        </select>
                        <span class="text-danger" id="error_sintoma_id"></span>
                    </div>
                </div>
            </div>
            <br>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <textarea name="descripcion" id="txt_descripcion" class="form-control"></textarea>
                    <span class="text-danger" id="error_descripcion"></span>
                </div>
            </div>
            <br>
            <div class="col-md-12">
                <div class="form-group text-primary" id="texto_sugerencia">
                    &nbsp;
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group p-2">
                        <input type="submit" class="btn btn-primary" value="Guardar cambios" style="float:right;">
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('custom_scripts')
    <script>
        $(document).ready(function() {
            $("#form_store_tickets").submit(function(e) {
                e.preventDefault();
                $(".text-danger").text('');
                axios.post('store_tickets', $("#form_store_tickets").serialize())
                    .then(response => {
                        console.log(response.data);
                        if (response.data.error <= 0) {
                            successNotification(response.data.mensaje);
                            setTimeout(window.location = "{{ route('home') }}", 3000);
                        } else {
                            errorNotification(response.data.mensaje);
                        }
                    })
                    .catch(error => {
                        $.each(error.response.data.errors, function(index, item) {
                            $("#error_" + index).text(item[0]);
                        });
                    });
            });
        });

        function cargarSubcategorias(categoria_id) {
            if (categoria_id.length > 0) {
                axios.get('cargar_subcategorias', {
                        params: {
                            categoria_id: categoria_id
                        }
                    })
                    .then(response => {
                        $("#cbo_subcategoria").html('<option value>--Seleccione--</option>');
                        $("#cbo_servicio").html('<option value>--Seleccione--</option>');
                        $("#cbo_sintoma").html('<option value>--Seleccione--</option>');
                        $("#texto_sugerencia").text('');
                        var html = `<option value>--Seleccione--</option>`;
                        $.each(response.data, function(index, item) {
                            html += `<option value ="${item.id}">${item.nombre}</option>`;
                        });
                        $("#cbo_subcategoria").html(html);
                    })
                    .catch(error => {
                        console.log(error);
                    });
            } else {
                $("#cbo_subcategoria").html('<option value>--Seleccione--</option>');
                $("#cbo_servicio").html('<option value>--Seleccione--</option>');
                $("#cbo_sintoma").html('<option value>--Seleccione--</option>');
                $("#texto_sugerencia").text('');
            }
        }

        function cargarServicios(subcategoria_id) {
            if (subcategoria_id.length > 0) {
                axios.get('cargar_servicios', {
                        params: {
                            subcategoria_id: subcategoria_id
                        }
                    })
                    .then(response => {
                        $("#cbo_servicio").html('<option value>--Seleccione--</option>');
                        $("#cbo_sintoma").html('<option value>--Seleccione--</option>');
                        $("#texto_sugerencia").text('');
                        var html = `<option value>--Seleccione--</option>`;
                        $.each(response.data, function(index, item) {
                            html += `<option value ="${item.id}">${item.nombre}</option>`;
                        });
                        $("#cbo_servicio").html(html);
                    })
                    .catch(error => {
                        console.log(error);
                    });
            } else {
                $("#cbo_servicio").html('<option value>--Seleccione--</option>');
                $("#cbo_sintoma").html('<option value>--Seleccione--</option>');
                $("#texto_sugerencia").text('');
            }
        }

        function cargarSintomas(servicio_id) {
            if (servicio_id.length > 0) {
                axios.get('cargar_sintomas', {
                        params: {
                            servicio_id: servicio_id
                        }
                    })
                    .then(response => {
                        $("#cbo_sintoma").html('<option value>--Seleccione--</option>');
                        $("#texto_sugerencia").text('');
                        var html = `<option value>--Seleccione--</option>`;
                        $.each(response.data, function(index, item) {
                            html += `<option value ="${item.id}">${item.nombre}</option>`;
                        });
                        $("#cbo_sintoma").html(html);
                    })
                    .catch(error => {
                        console.log(error);
                    });
            } else {
                $("#cbo_sintoma").html('<option value>--Seleccione--</option>');
                $("#texto_sugerencia").text('');
            }
        }

        function cargarSugerencia(sintoma_id) {
            if (sintoma_id.length > 0) {
                axios.get('cargar_sugerencia', {
                        params: {
                            sintoma_id: sintoma_id
                        }
                    })
                    .then(response => {
                        $("#texto_sugerencia").text('');
                        if (Object.keys(response.data).length > 0) {
                            $("#texto_sugerencia").text(response.data.nombre);
                        } else {
                            $("#texto_sugerencia").text("No se encontraron sugerencias");
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    });
            } else {
                $("#texto_sugerencia").text('');
            }
        }
    </script>
@endsection
