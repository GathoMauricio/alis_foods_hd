@extends('layouts.app')

@section('content')
    <div class="container p-3" style="background-color: white;border: solid 5px #f4f6f9;">
        <h3>
            Detalle sucursal
        </h3>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    Nombre:
                </div>
                <div class="col-md-6">
                    {{ $sucursal->nombre }}
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    Descripción:
                </div>
                <div class="col-md-6">
                    {{ $sucursal->descripcion }}
                </div>
            </div>
            <br>
        </div>
    </div>
@endsection
@section('custom_scripts')
@endsection
