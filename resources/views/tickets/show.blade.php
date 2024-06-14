@extends('layouts.app')

@section('content')
    <div class="container p-3" style="background-color: white;border: solid 5px #f4f6f9;">
        <h3>
            <div style="float:right">
                @if (Auth::user()->hasRole('Técnico') && $ticket->estatus_id == 1)
                    <a href="javascript:void(0)" onclick="tomarTicket()" class="btn btn-primary" style="width: 100%">
                        Tomar ticket
                    </a>
                @endif
                @if (Auth::user()->hasRole('Técnico') &&
                        ($ticket->estatus_id == 2 || $ticket->estatus_id == 6) &&
                        $ticket->tecnico_id == Auth::user()->id)
                    <a href="javascript:void(0)" onclick="iniciarProceso()" class="btn btn-primary" style="width: 100%">
                        Iniciar proceso
                    </a>
                    <form action="{{ route('estatus_ticket') }}" id="form_iniciar_proceso" method="POST"
                        style="display:none">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                        <input type="hidden" name="estatus_id" value="3">
                    </form>
                @endif
                @if (Auth::user()->hasRole('Técnico') && $ticket->estatus_id == 3 && $ticket->tecnico_id == Auth::user()->id)
                    <a href="javascript:void(0)" onclick="cerrarProceso()" class="btn btn-primary" style="width: 100%">
                        Cerrar proceso
                    </a>
                    <form action="{{ route('estatus_ticket') }}" id="form_cerrar_proceso" method="POST"
                        style="display:none">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                        <input type="hidden" name="estatus_id" value="4">
                    </form>
                @endif
                @if (
                    (Auth::user()->id == $ticket->autor->id && $ticket->estatus_id == 4) ||
                        ($ticket->estatus_id == 4 && Auth::user()->hasRole('Administrador')))
                    <a href="javascript:void(0)" onclick="finalizarTicket()" class="btn btn-primary" style="width: 100%">
                        Finalizar ticket
                    </a>
                @endif

            </div>
            Detalle ticket {{ $ticket->folio }}
        </h3>
        <div style="float:right;">
            @if (Auth::user()->hasRole('Administrador') || Auth::user()->hasRole('Gerente'))
                <br>
                <br>
                <div
                    style="box-shadow: 3px 4px 5px 0px rgba(0,0,0,0.75);
                        -webkit-box-shadow: 3px 4px 5px 0px rgba(0,0,0,0.75);
                        -moz-box-shadow: 3px 4px 5px 0px rgba(0,0,0,0.75);padding:5px;">
                    <label>Asignar ticket a:</label>
                    <br>
                    <form action="{{ route('asignar_ticket') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">

                        <select name="tecnico_id" class="select2" style="width:100%;" required>
                            <option value>Técnico</option>
                            @foreach ($tecnicos as $tecnico)
                                @if ($ticket->tecnico_id == $tecnico->id)
                                    <option value="{{ $tecnico->id }}" selected>{{ $tecnico->name }}
                                        {{ $tecnico->apaterno }}
                                        {{ $tecnico->amaterno }}</option>
                                @else
                                    <option value="{{ $tecnico->id }}">{{ $tecnico->name }} {{ $tecnico->apaterno }}
                                        {{ $tecnico->amaterno }}</option>
                                @endif
                            @endforeach
                        </select>
                        <br>

                        <select name="estatus_id" class="select2" style="width:100%;" required>
                            <option value>Estatus</option>
                            @foreach ($estatuses as $estatus)
                                @if ($ticket->estatus_id == $estatus->id)
                                    <option value="{{ $estatus->id }}" selected>{{ $estatus->nombre }}</option>
                                @else
                                    <option value="{{ $estatus->id }}">{{ $estatus->nombre }}</option>
                                @endif
                            @endforeach
                        </select>
                        <br>
                        <input type="submit" class="btn btn-primary" style="width: 100%" value="Asignar">
                    </form>

                </div>
            @endif
        </div>
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
            @if ($ticket->estatus_id < 5)
                <div style="float: right;">
                    <a href="javascript:void(0)" onclick="createSeguimiento();" class="btn btn-primary" title="Nuevo"><i
                            class="icon icon-plus"></i></a>
                </div>
            @endif
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
                            <td>
                                @if ($seguimiento->autor_id == Auth::user()->id || Auth::user()->hasRole('Administrador'))
                                    <a href="javascript:void(0);" onclick="deleteSeguimiento({{ $seguimiento->id }});"
                                        class="btn btn-danger" title="Eliminar"><i class="icon icon-bin"></i></a>
                                    <form action="{{ route('delete_seguimientos_ticket', $seguimiento->id) }}"
                                        id="form_delete_seguimiento_{{ $seguimiento->id }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                @endif
                            </td>
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
            @if ($ticket->estatus_id < 5)
                <div style="float: right;">
                    <a href="javascript:void(0)" onclick="createAdjunto();" class="btn btn-primary" title="Nuevo"><i
                            class="icon icon-plus"></i></a>
                </div>
            @endif
            Adjuntos <small style="font-size: 12px;">(image/jpg, image/jpeg, image/png, video/mp4)</small>

        </h3>
        <div class="container">
            <div class="row">
                @forelse ($ticket->adjuntos as $adjunto)
                    <div class="col-md-3 text-center">
                        <div class="card">

                            <div class="card-header">

                                @if ($adjunto->autor_id == Auth::user()->id || Auth::user()->hasRole('Administrador'))
                                    <div style="float: right;">
                                        <a href="javascript:void(0);" onclick="deleteAdjunto({{ $adjunto->id }});"
                                            class="btn btn-danger" title="Eliminar"><i class="icon icon-bin"></i></a>
                                        <form action="{{ route('delete_adjuntos_ticket', $adjunto->id) }}"
                                            id="form_delete_adjunto_{{ $adjunto->id }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                @endif

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
        @if (Auth::user()->hasRole('Técnico') && ($ticket->estatus->id == 2 || $ticket->estatus->id == 6))
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
        function deleteAdjunto(adjunto_id) {
            alertify.confirm('Aviso', 'Eliminar?', function() {
                $("#form_delete_adjunto_" + adjunto_id).submit();
            }, function() {});
        }

        function deleteSeguimiento(seguimiento_id) {
            alertify.confirm('Aviso', 'Eliminar?', function() {
                $("#form_delete_seguimiento_" + seguimiento_id).submit();
            }, function() {});
        }
    </script>
@endsection
