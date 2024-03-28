@extends('layouts.app')

@section('content')
    <div class="container p-3" style="background-color: white;border: solid 5px #f4f6f9;">
        <h3>
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
@endsection
