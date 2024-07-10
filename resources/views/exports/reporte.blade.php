<table>
    <thead>
        <tr>
            <th>Fecha</th>
            <th>Folio</th>
            <th>Estatus</th>
            <th>Sucursal</th>
            <th>Categoria</th>
            <th>Subcategoria</th>
            <th>Servicio</th>
            <th>Sintoma</th>
            <th>Gerente</th>
            <th>Técnico</th>
            <th>Descripcion</th>
            <th>Inicio de proceso</th>
            <th>Fecha de cerrado</th>
            <th>Fecha finalizado</th>
            <th>Tipo de finalizado</th>
            <th>Detalle de finalizado</th>
            <th>Detalle proceso de terceros</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tickets as $ticket)
            <tr>
                <td>{{ $ticket->created_at }}</td>
                <td>TK-{{ $ticket->id }}</td>
                <td>{{ $ticket->estatus->nombre }}</td>
                <td>{{ $ticket->autor->sucursal->nombre }}</td>
                <td>{{ $ticket->sintoma->servicio->subcategoria->categoria->nombre }}</td>
                <td>{{ $ticket->sintoma->servicio->subcategoria->nombre }}</td>
                <td>{{ $ticket->sintoma->servicio->nombre }}</td>
                <td>{{ $ticket->sintoma->nombre }}</td>
                <td>{{ $ticket->autor->name }} {{ $ticket->autor->apaterno }} {{ $ticket->autor->amaterno }}</td>
                <td>{{ $ticket->tecnico->name }} {{ $ticket->tecnico->apaterno }} {{ $ticket->tecnico->amaterno }}
                </td>
                <td>{{ $ticket->descripcion }}</td>
                <td>{{ $ticket->proceso_at }}</td>
                <td>{{ $ticket->cerrado_at }}</td>
                <td>{{ $ticket->finalizado_at }}</td>
                <td>{{ $ticket->tipo_finalizado }}</td>
                <td>{{ $ticket->detalle_finalizado }}</td>
                <td>{{ $ticket->detalle_proceso_terceros }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
