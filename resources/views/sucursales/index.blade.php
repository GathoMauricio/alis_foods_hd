@extends('layouts.app')

@section('content')
    <div class="container p-3" style="background-color: white;border: solid 5px #f4f6f9;">
        <h3>
            @can('crear_sucursales')
                <div style="float: right;">
                    <a href="{{ route('crear_sucursales') }}" class="btn btn-primary" title="Nuevo"><i
                            class="icon icon-user-plus"></i></a>
                </div>
            @endcan
            Sucursales
        </h3>
        <div style="width:300px;float:right;">
            <br>
            <select onchange="detalle(this.value)" class="form-select select2">
                <option value>Buscar</option>
                @foreach ($sucursales->get() as $sucursal)
                    <option value="{{ $sucursal->id }}">{{ $sucursal->nombre }}</option>
                @endforeach
            </select>
            <br><br>
        </div>
        {{ $sucursales->paginate(15)->links('pagination::bootstrap-4') }}
        <table class="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sucursales->paginate(15) as $sucursal)
                    <tr>
                        <td>{{ $sucursal->nombre }}</td>
                        <td>{{ $sucursal->descripcion }}</td>
                        <td>
                            @can('detalle_sucursales')
                                <a href="{{ route('detalle_sucursales', $sucursal->id) }}" class="btn btn-info"
                                    title="Ver"><i class="icon-eye"></i></a>
                            @endcan
                            @can('editar_sucursales')
                                <a href="{{ route('editar_sucursales', $sucursal->id) }}" class="btn btn-warning"
                                    title="Editar"><i class="icon-pencil"></i></a>
                            @endcan
                            @can('eliminar_sucursales')
                                <a href="javascript:void(0)" onclick="eliminar({{ $sucursal->id }});" class="btn btn-danger"
                                    title="Eliminar"><i class="icon-bin"></i></a>
                                <form action="{{ route('eliminar_sucursales', $sucursal->id) }}"
                                    id="form_eliminar_{{ $sucursal->id }}" method="POST"> @csrf @method('DELETE') </form>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
@section('custom_scripts')
    <script>
        function detalle(id) {
            if (id.length > 0)
                window.location = "{{ route('detalle_sucursales') }}/" + id;
        }

        function eliminar(id) {
            alertify.confirm('Aviso', '¿Realmente desea eliminar este registro?', function() {
                $("#form_eliminar_" + id).submit();
            }, function() {});
        }
    </script>
@endsection
