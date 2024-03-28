@extends('layouts.app')

@section('content')
    <div class="container">
        <br><br><br>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header" style="font-weight: bold;">
                        INGRESE SUS CREDENCIALES A CONTINIACIÓN
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">
                                    EMAIL
                                </label>
                                <div class="col-md-6">
                                    <input id="email" type="email" placeholder="correo@mail.com"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">
                                    PASSWORD
                                </label>
                                <div class="col-md-6">
                                    <input id="password" type="password" placeholder="**********"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 offset-md-12">
                                    {{--  <a class="btn btn-link" href="#">
                                        Olvidé mi password
                                    </a>  --}}
                                    <button type="submit" class="btn btn-primary" style="float:right;">
                                        ACCEDER
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
