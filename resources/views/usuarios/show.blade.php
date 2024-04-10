@extends('layouts.app')

@section('content')
    <div class="container p-3" style="background-color: white;border: solid 5px #f4f6f9;">
        <h3>
            <div style="float:right;">
                @can('editar_usuarios')
                    <a href="{{ route('editar_usuarios', $usuario->id) }}" class="btn btn-warning" title="Editar"><i
                            class="icon-pencil"></i></a>
                @endcan
                @can('eliminar_usuarios')
                    <a href="javascript:void(0)" onclick="eliminar({{ $usuario->id }});" class="btn btn-danger"
                        title="Eliminar"><i class="icon-bin"></i></a>
                    <form action="{{ route('eliminar_usuarios', $usuario->id) }}" id="form_eliminar_{{ $usuario->id }}"
                        method="POST"> @csrf @method('DELETE') </form>
                @endcan
            </div>
            Detalle usuario
        </h3>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    Nombre:
                </div>
                <div class="col-md-6">
                    {{ $usuario->name }} {{ $usuario->apaterno }} {{ $usuario->amaterno }}
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    Teléfono:
                </div>
                <div class="col-md-6">
                    {{ $usuario->telefono }}
                    @if ($usuario->telefono_emergencia)
                        <br>
                        {{ $usuario->telefono_emergencia }}
                    @endif
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    Email:
                </div>
                <div class="col-md-6">
                    {{ $usuario->email }}
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    Rol(es):
                </div>
                <div class="col-md-6">
                    @foreach ($usuario->roles as $rol)
                        {{ $rol->name }}<br>
                    @endforeach
                </div>
            </div>
            <br>
        </div>
        {{--  Mostrar info dependiendo si tiene el rol asignado  --}}
        {{--  {{ $usuario }}
        <br><br>
        {{ $usuario->roles }}  --}}
    </div>
@endsection
@section('custom_scripts')
    <script>
        function eliminar(id) {
            alertify.confirm('Aviso', '¿Realmente desea eliminar este registro?', function() {
                $("#form_eliminar_" + id).submit();
            }, function() {});
        }
    </script>
@endsection
