@extends('layouts.app')

@section('content')
    <div class="container p-3" style="background-color: white;border: solid 5px #f4f6f9;">
        <h3>
            Detalle ticket
        </h3>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    Estatus:
                </div>
                <div class="col-md-6">
                    {{ $ticket->estatus->nombre }}
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    Técnico asignado:
                </div>
                <div class="col-md-6">
                    @if (isset($ticket->tecnico->id))
                        {{ $ticket->tecnico->name }} {{ $ticket->tecnico->apaterno }} {{ $ticket->tecnico->amaterno }}
                    @else
                        No disponible
                    @endif
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    Categoría:
                </div>
                <div class="col-md-6">
                    {{ $ticket->sintoma->servicio->subcategoria->categoria->nombre }}
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    Subcategoría:
                </div>
                <div class="col-md-6">
                    {{ $ticket->sintoma->servicio->subcategoria->nombre }}
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    Servicio:
                </div>
                <div class="col-md-6">
                    {{ $ticket->sintoma->servicio->nombre }}
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    Síntoma:
                </div>
                <div class="col-md-6">
                    {{ $ticket->sintoma->nombre }}
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    Descripción:
                </div>
                <div class="col-md-6">
                    {{ $ticket->descripcion }}
                </div>
            </div>
        </div>
    </div>
    <div class="container p-3" style="background-color: white;border: solid 5px #f4f6f9;">
        <h3>
            <div style="float: right;">
                <a href="javascript:void(0)" onclick="create();" class="btn btn-primary" title="Nuevo"><i
                        class="icon icon-plus"></i></a>
            </div>
            Seguimientos
        </h3>
        <div class="container">
            <table class="table">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Autor</th>
                        <th>Texto</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($ticket->seguimientos as $seguimiento)
                        <tr>
                            <td>{{ $seguimiento->created_at }}</td>
                            <td>
                                {{ $seguimiento->autor->name }}
                                {{ $seguimiento->autor->apaterno }}
                                {{ $seguimiento->autor->amaterno }}
                            </td>
                            <td>{{ $seguimiento->texto }}</td>
                            <td></td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center" colspan="4">Sin registros</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="container p-3" style="background-color: white;border: solid 5px #f4f6f9;">
        <h3>
            Adjuntos
        </h3>
        <div class="container">
            <table class="table">
                <thead>
                    <tr>
                        <th>Img</th>
                        <th>Fecha</th>
                        <th>Autor</th>
                        <th>Descripción</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($ticket->adjuntos as $adjunto)
                        <tr>
                            <td>{{ $adjunto->ruta }}</td>
                            <td>{{ $adjunto->created_at }}</td>
                            <td>
                                {{ $adjunto->autor->name }}
                                {{ $adjunto->autor->apaterno }}
                                {{ $adjunto->autor->amaterno }}
                            </td>
                            <td>{{ $adjunto->descripcion }}</td>
                            <td></td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center" colspan="4">Sin registros</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @include('seguimientos.create')
@endsection
@section('custom_scripts')
    <script>
        function create() {
            $("#create_seguimientos_modal").modal('show');
        }
    </script>
@endsection
