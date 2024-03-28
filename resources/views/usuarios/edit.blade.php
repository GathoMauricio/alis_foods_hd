@extends('layouts.app')

@section('content')
    <div class="container p-3" style="background-color: white;border: solid 5px #f4f6f9;">
        <h3>
            Editar usuario
        </h3>
        <form action="{{ route('update_usuarios', $usuario->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="roles">Rol(es)</label>
                            <select name="roles[]" class="select2 form-control" multiple>
                                @foreach ($roles as $rol)
                                    <option value="{{ $rol->name }}"
                                        @if (is_array(old('roles')) && in_array($rol->name, old('roles'))) selected
                                        @elseif(in_array($rol->name, $usuario->roles->pluck('name')->toArray()))
                                        selected @endif>
                                        {{ $rol->name }}</option>
                                @endforeach
                            </select>
                            @error('roles')
                                <span style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" name="name" value="{{ old('name', $usuario->name) }}"
                                placeholder="Nombre" class="form-control">
                            @error('name')
                                <span style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="apaterno">A. Paterno</label>
                            <input type="text" name="apaterno" value="{{ old('apaterno', $usuario->apaterno) }}"
                                placeholder="A. Paterno" class="form-control">
                            @error('apaterno')
                                <span style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="amaterno">A. Materno</label>
                            <input type="text" name="amaterno" value="{{ old('amaterno', $usuario->amaterno) }}"
                                placeholder="A. Materno" class="form-control">
                            @error('amaterno')
                                <span style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" value="{{ $usuario->email }}" placeholder="Email"
                                class="form-control" readonly>
                            @error('email')
                                <span style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="telefono">Teléfono</label>
                            <input type="text" name="telefono" value="{{ old('telefono', $usuario->telefono) }}"
                                placeholder="Teléfono" class="form-control">
                            @error('telefono')
                                <span style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="telefono_emergencia">Teléfono de emergencia</label>
                            <input type="text" name="telefono_emergencia"
                                value="{{ old('telefono_emergencia', $usuario->telefono_emergencia) }}"
                                placeholder="Teléfono de emergencia" class="form-control">
                            @error('telefono_emergencia')
                                <span style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password">Contraseña</label>
                            <input type="password" name="password" placeholder="Contraseña" class="form-control">
                            @error('password')
                                <span style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password_confirmation">Repetir contraseña</label>
                            <input type="password" name="password_confirmation" placeholder="Repetir contraseña"
                                class="form-control">
                            @error('password_confirmation')
                                <span style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <br>
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
