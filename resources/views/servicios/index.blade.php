@extends('layouts.app')

@section('content')
    <div class="container p-3" style="background-color: white;border: solid 5px #f4f6f9;">
        <h5>
            <div style="float: right;">
                <a href="javascript::void(0)" onclick="nuevoServicio();" class="btn btn-primary" title="Nuevo">
                    Nuevo servicio
                </a>
            </div>
            Subcategoría:
            <br><br>
            {{ $subcategoria->categoria->nombre }} > {{ $subcategoria->nombre }}
        </h5>
        <br>
        <div class="row">
            @forelse ($servicios as $servicio)
                <div class="card col-md-6">
                    <div class="card-header p-3">
                        <h5>{{ $servicio->nombre }}</h5>
                        <h6>
                            Sintomas
                            <br>
                            <a href="javascript:void();" onclick="nuevoSintoma({{ $servicio->id }});">
                                Agregar
                            </a>
                        </h6>
                    </div>
                    <ul>
                        @forelse ($servicio->sintomas as $sintoma)
                            <li>
                                <i onclick="editarSintoma({{ $sintoma->id }})" title="Editar síntoma"
                                    class="icon icon-pencil"
                                    style="float:right;color:orange;padding-top:5px;cursor:pointer;"></i>
                                <a href="{{ route('sugerencias', $sintoma->id) }}"
                                    title="TR: {{ $sintoma->tiempo_respuesta }} mins / TS: {{ $sintoma->tiempo_solucion }} mins.">{{ $sintoma->nombre }}
                                    ({{ count($sintoma->sugerencias) }})
                                </a>
                            </li>
                        @empty
                            <li>No hay registros</li>
                        @endforelse
                    </ul>
                </div>
            @empty
                <center>Sin servicios / Productos</center>
            @endforelse
        </div>
    </div>
    @include('servicios.nuevo_servicio')
    @include('servicios.nuevo_sintoma')
    @include('servicios.editar_sintoma')
@endsection
@section('custom_scripts')
    <script>
        function nuevoServicio() {
            $("#nuevo_servicio_modal").modal('show');
        }

        function nuevoSintoma(servicio_id) {
            $("#txt_servicio_id").val(servicio_id);
            $("#nuevo_sintoma_modal").modal('show');
        }

        function editarSintoma(sintoma_id) {
            console.log(sintoma_id);
            axios.get("{{ route('cargar_sintoma') }}", {
                    params: {
                        sintoma_id: sintoma_id
                    }
                })
                .then(response => {
                    $("#txt_editar_sintoma_id").val(sintoma_id);
                    $("#txt_editar_nombre_sintoma").val(response.data.nombre);
                    $("#txt_editar_tiempo_respuesta_sintoma").val(response.data.tiempo_respuesta);
                    $("#txt_editar_tiempo_solucion_sintoma").val(response.data.tiempo_solucion);
                    $("#editar_sintoma_modal").modal('show');
                })
                .catch(error => {
                    //console.log(error);
                });
        }
    </script>
@endsection
