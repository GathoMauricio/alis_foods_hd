@extends('layouts.app')

@section('content')
    <div class="container p-3" style="background-color: white;border: solid 5px #f4f6f9;">
        <h3>
            Crear ticket de categoría {{ $categoria->nombre }}
        </h3>
        <form action="{{ route('store_tickets') }}" id="form_store_tickets" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="categoria" value="{{ $categoria->id }}">
            {{--  <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="categoria">Categoría</label>
                        <select name="categoria" id="cbo_categoria" onchange="cargarSubcategorias(this.value);"
                            class="form-select select2" required>
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
                            class="form-select select2" required>
                            <option value>--Seleccione--</option>
                        </select>
                        <span class="text-danger" id="error_subcategoria"></span>
                    </div>
                </div>
            </div>  --}}
            <div class="row">
                <div class="form-group">
                    <label for="subcategoria" style="font-weight:bold;">Subcategoria</label>
                    <br><br>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    @foreach ($subcategorias as $subcategoria)
                                        <div class="col-md-3"
                                            style="box-shadow: -3px -1px 19px 5px rgba(52,152,219,0.75);
-webkit-box-shadow: -3px -1px 19px 5px rgba(52,152,219,0.75);
-moz-box-shadow: -3px -1px 19px 5px rgba(52,152,219,0.75);padding:10px;">
                                            <input type="radio" value="{{ $subcategoria->id }}" name="subcategoria"
                                                onclick="cargarServicios(this.value);">
                                            <label style="font-weight:bold;">{{ $subcategoria->nombre }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="servicio" style="font-weight:bold;">Servicio /Artículo</label>
                        <select name="servicio" id="cbo_servicio" onchange="cargarSintomas(this.value);"
                            class="form-select select2" required>
                            <option value>--Seleccione--</option>
                        </select>
                        <span class="text-danger" id="error_servicio"></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="sintoma_id" style="font-weight:bold;">Sintoma</label>
                        <select name="sintoma_id" id="cbo_sintoma" class="form-select select2"
                            onchange="cargarSugerencia(this.value)" required>
                            <option value>--Seleccione--</option>
                        </select>
                        <span class="text-danger" id="error_sintoma_id"></span>
                    </div>
                </div>
            </div>
            <br>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="descripcion" style="font-weight:bold;">Descripción</label>
                    <textarea name="descripcion" id="txt_descripcion" class="form-control" required></textarea>
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
                    <a href="javascript:void(0);" onclick="agregarAdjunto();">
                        <span class="icon icon-plus"></span> Adjuntar archivos
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12" id="div_adjuntos">
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
            /*
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
                                    console.log(error);
                                    $.each(error.response.data.errors, function(index, item) {
                                        $("#error_" + index).text(item[0]);
                                    });
                                });
                        });
                        */
        });

        function cargarSubcategorias(categoria_id) {
            if (categoria_id.length > 0) {
                axios.get("{{ route('cargar_subcategorias') }}", {
                        params: {
                            categoria_id: categoria_id
                        }
                    })
                    .then(response => {
                        //$("#cbo_subcategoria").html('<option value>--Seleccione--</option>');
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
                        //console.log(error);
                    });
            } else {
                //$("#cbo_subcategoria").html('<option value>--Seleccione--</option>');
                $("#cbo_servicio").html('<option value>--Seleccione--</option>');
                $("#cbo_sintoma").html('<option value>--Seleccione--</option>');
                $("#texto_sugerencia").text('');
            }
        }

        function cargarServicios(subcategoria_id) {
            if (subcategoria_id.length > 0) {
                axios.get("{{ route('cargar_servicios') }}", {
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
                        //console.log(error);
                    });
            } else {
                $("#cbo_servicio").html('<option value>--Seleccione--</option>');
                $("#cbo_sintoma").html('<option value>--Seleccione--</option>');
                $("#texto_sugerencia").text('');
            }
        }

        function cargarSintomas(servicio_id) {
            if (servicio_id.length > 0) {
                axios.get("{{ route('cargar_sintomas') }}", {
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
                        //.log(error);
                    });
            } else {
                $("#cbo_sintoma").html('<option value>--Seleccione--</option>');
                $("#texto_sugerencia").text('');
            }
        }

        function cargarSugerencia(sintoma_id) {
            if (sintoma_id.length > 0) {
                axios.get("{{ route('cargar_sugerencia') }}", {
                        params: {
                            sintoma_id: sintoma_id
                        }
                    })
                    .then(response => {
                        $("#texto_sugerencia").text('');
                        if (Object.keys(response.data).length > 0) {
                            var html = '<ul>';
                            $.each(response.data.sugerencias, function(index, item) {
                                html += '<li>' + item.nombre + '</li>';
                            });
                            html += '<ul>';
                            $("#texto_sugerencia").html(html);
                        } else {
                            $("#texto_sugerencia").text("No se encontraron sugerencias");
                        }
                    })
                    .catch(error => {
                        //console.log(error);
                    });
            } else {
                $("#texto_sugerencia").text('');
            }
        }
        var contador = 1;

        function agregarAdjunto() {
            const html = `
            <div class="container" id="div_adjunto_${contador}">
                <div class="row">
                    <div class="col-md-5">
                        <input type="file" name="file_ruta[]" class="form-control"
                            accept="image/jpg, image/jpeg, image/png , application/pdf" required>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" name="file_descripcion[]" class="form-control"
                                placeholder="Descripción..." required>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <a href="javascript:void(0)" onclick="removerDivAdjuntos(${contador});" style="float:right;"><span class="icon icon-cross"></span></a>
                    </div>
                </div>
            </div><br>
            `;
            $("#div_adjuntos").append(html);
        }

        function removerDivAdjuntos(id) {
            $("#div_adjunto_" + id).remove();
        }
    </script>
@endsection
