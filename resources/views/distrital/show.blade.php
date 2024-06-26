@extends('layouts.app')

@section('content')
    <div class="container p-3" style="background-color: white;border: solid 5px #f4f6f9;">
        <h3>
            Detalle ticket {{ $ticket->folio }} (Distrital)
        </h3>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    Estatus:
                </div>
                <div class="col-md-6">
                    <span class="bg-info p-2 rounded">
                        {{ $ticket->estatus->nombre }}
                    </span>
                    <br>
                    @if ($ticket->estatus_id == 1)
                        <br>
                        "{{ $ticket->created_at }}"
                    @endif
                    @if ($ticket->estatus_id == 2)
                        <br>
                        "{{ $ticket->detalle_proceso_terceros }}"
                    @endif
                    @if ($ticket->estatus_id == 3)
                        <br>
                        "{{ $ticket->proceso_at }}"
                    @endif
                    @if ($ticket->estatus_id == 4)
                        <br>
                        "{{ $ticket->cerrado_at }}"
                    @endif
                    @if ($ticket->estatus_id == 5)
                        <br>
                        "{{ $ticket->finalizado_at }}"
                    @endif
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    Autor:
                </div>
                <div class="col-md-6">
                    {{ $ticket->autor->name }} {{ $ticket->autor->apaterno }} {{ $ticket->autor->amaterno }}
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
                        NO ASIGNADO
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
    @if ($ticket->estatus_id >= 5)
        <div class="container p-3" style="background-color: white;border: solid 5px #f4f6f9;">
            <h3>Histórico</h3>
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        Creado:
                    </div>
                    <div class="col-md-6">
                        {{ $ticket->created_at }}
                    </div>
                </div>
                <br>
                @if ($ticket->detalle_proceso_terceros)
                    <div class="row">
                        <div class="col-md-6">
                            Proceso con terceros:
                        </div>
                        <div class="col-md-6">
                            {{ $ticket->detalle_proceso_terceros }}
                        </div>
                    </div>
                    <br>
                @endif
                <div class="row">
                    <div class="col-md-6">
                        Inicio del proceso:
                    </div>
                    <div class="col-md-6">
                        {{ $ticket->proceso_at }}
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        Cerrado por el técnico
                    </div>
                    <div class="col-md-6">
                        {{ $ticket->cerrado_at }}
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        Tipo de finalización:
                    </div>
                    <div class="col-md-6">
                        {{ $ticket->tipo_finalizado }}
                    </div>
                </div>
                <br>
                @if ($ticket->detalle_finalizado)
                    <div class="row">
                        <div class="col-md-6">
                            Tipo de finalización:
                        </div>
                        <div class="col-md-6">
                            {{ $ticket->detalle_finalizado }}
                        </div>
                    </div>
                    <br>
                @endif
                <div class="row">
                    <div class="col-md-6">
                        Finalizado:
                    </div>
                    <div class="col-md-6">
                        {{ $ticket->finalizado_at }}
                    </div>
                </div>
                <br>
            </div>
        </div>
    @endif
    <div class="container p-3" style="background-color: white;border: solid 5px #f4f6f9;">
        <h3>
            Adjuntos</small>
        </h3>
        <div class="container">
            <div class="row">
                @forelse ($ticket->adjuntos as $adjunto)
                    <div class="col-md-3 text-center">
                        <div class="card">
                            <div class="card-header">
                                <h6>
                                    {{ $adjunto->autor->name }} {{ $adjunto->autor->apaterno }}
                                    {{ $adjunto->autor->amaterno }}
                                </h6>
                            </div>
                            <div class="card-body">
                                @if ($adjunto->mimetype == 'video/mp4')
                                    <video src="{{ asset('storage/adjuntos/' . $adjunto->ruta) }}"
                                        style="width:100%;height:200px;" controls></video>
                                @else
                                    <a href="{{ asset('storage/adjuntos/' . $adjunto->ruta) }}" target="_BLANK">
                                        <img src="{{ asset('storage/adjuntos/' . $adjunto->ruta) }}"
                                            alt="{{ $adjunto->ruta }}" style="width:100%;height:200px;">
                                    </a>
                                @endif
                            </div>
                            <div class="card-footer">
                                {{ $adjunto->descripcion }}
                            </div>
                        </div>
                    </div>
                @empty
                    <center>No se encontraron medios</center>
                @endforelse
            </div>
        </div>
    </div>
    @include('seguimientos.create')
    @include('adjuntos.create')
    @include('tickets.tomar_ticket')
    @include('tickets.finalizar_ticket')
@endsection
@section('custom_scripts')
    <script>
        function createSeguimiento() {
            $("#create_seguimientos_modal").modal('show');
        }

        function createAdjunto() {
            $("#create_adjuntos_modal").modal('show');
        }
        @if (Auth::user()->hasRole('Técnico') && $ticket->estatus->id == 1)
            function tomarTicket(id) {
                $("#tomar_ticket_modal").modal('show');
            }
        @endif
        @if (Auth::user()->hasRole('Técnico') && $ticket->estatus->id == 2)
            function iniciarProceso() {
                alertify.confirm('Aviso', '¿Iniciar proceso?', function() {
                    $("#form_iniciar_proceso").submit();
                }, function() {});
            }
        @endif
        @if (Auth::user()->hasRole('Técnico') && $ticket->estatus->id == 3)
            function cerrarProceso() {
                alertify.confirm('Aviso', 'Cerrar proceso?', function() {
                    $("#form_cerrar_proceso").submit();
                }, function() {});
            }
        @endif
        @if (Auth::user()->id == $ticket->autor->id && $ticket->estatus->id == 4)
            function finalizarTicket() {
                $("#finalizar_ticket_modal").modal('show');
            }
        @endif
    </script>
@endsection
