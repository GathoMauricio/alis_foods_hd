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
                                <a href="{{ route('sugerencias', $sintoma->id) }}">{{ $sintoma->nombre }}
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
    </script>
@endsection
