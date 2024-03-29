@extends('layouts.app')

@section('content')
    <div class="container p-3" style="background-color: white;border: solid 5px #f4f6f9;">
        <h3>
            Editar sucursal
        </h3>
        <form action="{{ route('update_sucursales', $sucursal->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" name="nombre" value="{{ old('nombre', $sucursal->nombre) }}"
                                placeholder="Nombre" class="form-control">
                            @error('nombre')
                                <span style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="descripcion">Descripcion</label>
                            <textarea name="descripcion"placeholder="Nombre" class="form-control">{{ old('descripcion', $sucursal->descripcion) }}</textarea>
                            @error('descripcion')
                                <span style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group p-2">
                            <input type="submit" class="btn btn-primary" value="Guardar cambios" style="float:right;">
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
@endsection
@section('custom_scripts')
@endsection
