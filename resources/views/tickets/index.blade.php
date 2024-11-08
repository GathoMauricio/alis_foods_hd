@extends('layouts.app')

@section('content')
    <div class="container p-3" style="background-color: white;border: solid 5px #f4f6f9;">
        <h3>
            @can('crear_tickets')
                <div style="float: right;">
                    {{--  <a href="{{ route('crear_tickets') }}" class="btn btn-primary" title="Nuevo"><i class="icon icon-plus"></i></a>  --}}
                    @foreach ($categorias as $categoria)
                        <a href="{{ route('crear_tickets', $categoria->id) }}" class="btn btn-primary"
                            title="Nuevo ticket de tipo {{ $categoria->nombre }}">{{ $categoria->nombre }}</a>
                    @endforeach
                </div>
            @endcan
            Tickets
        </h3>
        {{--  {{ $tickets->links('pagination::bootstrap-4') }}  --}}
        <form id="form_buscador">
            <div class="container">
                <div style="float:right;">
                    <table>
                        <tr>
                            <td>
                                <select id="cbo_usuario_buscador" class="form-control">
                                    <option value>--Seleccione una opcion--</option>
                                    @foreach ($usuarios as $usuario)
                                        <option value="{{ $usuario->id }}">{{ $usuario->name }} {{ $usuario->apaterno }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <button type="submit" class="btn btn-primary">Buscar</button>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </form>
        <table class="table">
            <thead>
                <tr>
                    <th>Folio</th>
                    <th>Estatus</th>
                    <th>Autor</th>
                    <th>Técnico</th>
                    <th>Categoría</th>
                    <th>Síntoma</th>
                    <th>Descripción</th>
                    <th>Fecha</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $countTickets = 0;
                @endphp
                @foreach ($tickets as $ticket)
                    {{--  @if (is_null($ticket->tecnico_id) || $ticket->tecnico_id == Auth::user()->id || Auth::user()->hasRole('Administrador'))  --}}
                    @php
                        $countTickets++;
                    @endphp
                    <tr>
                        <th style="font-size:14;">{{ $ticket->folio }}</th>
                        <td style="font-size:12px;">{{ $ticket->estatus->nombre }}</td>
                        <td style="font-size:12px;">
                            {{ $ticket->autor->name }} {{ $ticket->autor->amaterno }} {{ $ticket->autor->apaterno }}
                            <br>
                            <strong>{{ $ticket->autor->sucursal->nombre }}</strong>
                        </td>
                        <td style="font-size:12px;">
                            @if ($ticket->tecnico->id)
                                {{ $ticket->tecnico->name }} {{ $ticket->tecnico->amaterno }}
                                {{ $ticket->tecnico->apaterno }}
                                <br>
                                <strong>({{ $ticket->tecnico->categoria->nombre }})</strong>
                            @else
                                No disponible
                            @endif
                        </td>
                        <td style="font-size:12px;">{{ $ticket->sintoma->servicio->subcategoria->categoria->nombre }}
                        </td>
                        <td style="font-size:12px;">{{ $ticket->sintoma->nombre }}</td>
                        <td style="font-size:12px;">{{ $ticket->descripcion }}</td>
                        <td style="font-size:12px;">{{ $ticket->created_at }}</td>
                        <td>
                            <a href="{{ route('show_tickets', $ticket['id']) }}">Detalles</a>
                        </td>
                        {{--  @endif  --}}
                    </tr>
                @endforeach
                @if ($countTickets <= 0)
                    <tr>
                        <th colspan="9" class="text-center">Sin registros</th>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
@endsection
