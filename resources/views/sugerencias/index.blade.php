@extends('layouts.app')

@section('content')
    <div class="container p-3" style="background-color: white;border: solid 5px #f4f6f9;">
        <h5>
            <div style="float: right;">
                <a href="javascript::void(0)" onclick="nuevaSugerencia();" class="btn btn-primary" title="Nuevo">
                    Nueva sugerencia
                </a>
            </div>
            Síntoma:
            <br><br>
            {{ $sintoma->servicio->subcategoria->categoria->nombre }} > {{ $sintoma->servicio->subcategoria->nombre }} >
            {{ $sintoma->nombre }}
        </h5>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>Sugerencia</th>
                </tr>
            </thead>
            <tbody>
                @forelse($sugerencias as $sugerencia)
                    <tr>
                        <td>{{ $sugerencia->nombre }}</td>
                    </tr>
                @empty
                    <tr>
                        <td>No se encontraron sugerencias</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @include('sugerencias.nueva_sugerencia')
@endsection
@section('custom_scripts')
    <script>
        function nuevaSugerencia() {
            $("#nueva_sugerencia_modal").modal('show');
        }
    </script>
@endsection
