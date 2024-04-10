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
                    @if (Auth::user()->hasRole('Administrador'))
                        <a href="javascript:void(0)" onclick="actualizarEstatus()">Actualizar estatus</a>
                    @endif
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
                        @if (Auth::user()->hasRole('Técnico'))
                            <a href="javascript:void(0)" onclick="tomarTicket()">Tomar ticket</a>
                            <form action="{{ route('tomar_ticket') }}" id="form_tomar_ticket" method="POST"
                                style="display: none;">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                                <input type="hidden" name="tecnico_id" value="{{ Auth::user()->id }}">
                            </form>
                        @endif
                    @endif
                    @if (Auth::user()->hasRole('Administrador'))
                        <a href="javascript:void(0)" onclick="asignarTicket()">Asignar ticket</a>
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
                <a href="javascript:void(0)" onclick="createSeguimiento();" class="btn btn-primary" title="Nuevo"><i
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
            <div style="float: right;">
                <a href="javascript:void(0)" onclick="createAdjunto();" class="btn btn-primary" title="Nuevo"><i
                        class="icon icon-plus"></i></a>
            </div>
            Adjuntos
        </h3>
        <div class="container">
            <div class="row">
                @forelse ($ticket->adjuntos as $adjunto)
                    <div class="col-md-3 text-center">
                        <div class="card">
                            {{--  @can('eliminar_medio_residencias')
                                <div class="card-header">
                                    <div style="float: right;">
                                        <a href="javascript:void(0);" onclick="deleteMedio({{ $medio->id }});"
                                            class="btn btn-danger" title="Eliminar"><i class="icon icon-bin"></i></a>
                                        <form action="{{ route('delete_media_residencias', $medio->id) }}"
                                            id="form_delete_medio_{{ $medio->id }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </div>
                            @endcan  --}}
                            <div class="card-body">
                                <img src="{{ asset('storage/adjuntos/' . $adjunto->ruta) }}" alt="{{ $adjunto->ruta }}"
                                    style="width:100%;height:200px;">
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
    @include('tickets.asignar_ticket')
    @include('tickets.actualizar_estatus')
@endsection
@section('custom_scripts')
    <script>
        function createSeguimiento() {
            $("#create_seguimientos_modal").modal('show');
        }

        function createAdjunto() {
            $("#create_adjuntos_modal").modal('show');
        }
        @if (Auth::user()->hasRole('Técnico'))
            function tomarTicket(id) {
                alertify.confirm('Aviso', '¿Tomar este ticket?', function() {
                    $("#form_tomar_ticket").submit();
                }, function() {});
            }
        @endif
        @if (Auth::user()->hasRole('Administrador'))
            function asignarTicket() {
                $("#asignar_ticket_modal").modal('show');
            }
        @endif
        @if (Auth::user()->hasRole('Administrador'))
            function actualizarEstatus() {
                $("#actualizar_estatus_modal").modal('show');
            }
        @endif
    </script>
@endsection
