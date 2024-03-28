@extends('layouts.app')

@section('content')
    <div class="container p-3" style="background-color: white;border: solid 5px #f4f6f9;">
        <h3>
            @can('crear_usuarios')
                <div style="float: right;">
                    <a href="{{ route('crear_usuarios') }}" class="btn btn-primary" title="Nuevo"><i
                            class="icon icon-user-plus"></i></a>
                </div>
            @endcan
            Usuarios
        </h3>
        <div style="width:300px;float:right;">
            <br>
            <select onchange="detalle(this.value)" class="form-select select2">
                <option value>Buscar</option>
                @foreach ($usuarios->get() as $usuario)
                    <option value="{{ $usuario->id }}">{{ $usuario->name }} {{ $usuario->apaterno }}
                        {{ $usuario->amaterno }}</option>
                @endforeach
            </select>
            <br><br>
        </div>
        {{ $usuarios->paginate(15)->links('pagination::bootstrap-4') }}
        <table class="table">
            <thead>
                <tr>
                    <th>&nbsp;</th>
                    <th>Rol(es)</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($usuarios->paginate(15) as $usuario)
                    <tr>
                        <td>
                            <img src="{{ asset('img/perfil.jpg') }}" alt="{{ asset('img/perfil.jpg') }}"
                                style="width:60px;height:60px" class="rounded-circle shadow-4-strong">
                        </td>
                        <td>
                            @foreach ($usuario->roles as $rol)
                                {{ $rol->name }}<br>
                            @endforeach
                        </td>
                        <td>{{ $usuario->name }} {{ $usuario->apaterno }} {{ $usuario->amaterno }}</td>
                        <td>{{ $usuario->email }}</td>
                        <td>
                            {{ $usuario->telefono }}
                            @if ($usuario->telefono_emergencia)
                                <br>{{ $usuario->telefono_emergencia }}
                            @endif
                        </td>
                        <td>
                            @can('detalle_usuarios')
                                <a href="{{ route('detalle_usuarios', $usuario->id) }}" class="btn btn-info" title="Ver"><i
                                        class="icon-eye"></i></a>
                            @endcan
                            @can('editar_usuarios')
                                <a href="{{ route('editar_usuarios', $usuario->id) }}" class="btn btn-warning"
                                    title="Editar"><i class="icon-pencil"></i></a>
                            @endcan
                            @can('eliminar_usuarios')
                                <a href="javascript:void(0)" onclick="eliminar({{ $usuario->id }});" class="btn btn-danger"
                                    title="Eliminar"><i class="icon-bin"></i></a>
                                <form action="{{ route('eliminar_usuarios', $usuario->id) }}"
                                    id="form_eliminar_{{ $usuario->id }}" method="POST"> @csrf @method('DELETE') </form>
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
                window.location = "{{ route('detalle_usuarios') }}/" + id;
        }

        function eliminar(id) {
            alertify.confirm('Aviso', '¿Realmente desea eliminar este registro?', function() {
                $("#form_eliminar_" + id).submit();
            }, function() {});
        }
    </script>
@endsection
