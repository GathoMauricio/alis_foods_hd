<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/jpg" href="{{ asset('img/favicon.ico') }}" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/alertify.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font.css') }}" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        html,
        body {
            background: url({{ asset('img/background.png') }}) no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;

        }
    </style>

</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}" style="font-weight: bold;">
                    {{--  <img src="{{ asset('img/logo_nav.png') }}" alt="{{ asset('img/logo_nav.png') }}" height="40">  --}}
                    Alis Foods HelpDesk
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            {{--  @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif  --}}
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-primary"
                                    style="font-weight: bold;" href="#" role="button" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} {{ Auth::user()->apaterno }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('/') }}">
                                        Inicio
                                    </a>
                                    @if (\Auth::user()->distrital == 'SI')
                                        <a class="dropdown-item" href="{{ route('distrital') }}">
                                            Distrital
                                        </a>
                                    @endif
                                    @if (\Auth::user()->distrital == 'SI')
                                        <a class="dropdown-item" href="{{ route('historico_distrital') }}">
                                            Histórico
                                        </a>
                                    @else
                                        <a class="dropdown-item" href="{{ route('historico') }}">
                                            Histórico
                                        </a>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('reportes') }}">
                                        Reportes
                                    </a>
                                    @can('modulo_roles_permisos')
                                        <a class="dropdown-item" href="{{ route('roles_permisos') }}">
                                            Roles y permisos
                                        </a>
                                    @endcan
                                    @can('modulo_usuarios')
                                        <a class="dropdown-item" href="{{ route('usuarios') }}">
                                            Usuarios
                                        </a>
                                    @endcan
                                    @can('modulo_sucursales')
                                        <a class="dropdown-item" href="{{ route('sucursales') }}">
                                            Sucursales
                                        </a>
                                    @endcan
                                    @if (Auth::user()->hasRole('Super usuario') || Auth::user()->hasRole('Administrador'))
                                        <a class="dropdown-item" href="{{ route('categorias') }}">
                                            Síntomas y categorías
                                        </a>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Cerrar sesión
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        @if (Session::has('message'))
            <div class="alert alert-primary" role="alert">
                {{ Session::get('message') }}
            </div>
        @endif
        <main class="py-4">
            @yield('content')
        </main>
        @auth
            <div id="box_roles">
                <ul>
                    @foreach (Auth::user()->roles as $rol)
                        <li>{{ $rol->name }}</li>
                    @endforeach
                </ul>
            </div>
            <style>
                #box_roles {
                    position: fixed;
                    left: 0;
                    bottom: 0;
                    background-color: black;
                    color: white;
                    padding-top: 5px;
                    padding-right: 5px;
                    font-weight: bold;
                    opacity: 40%;
                }
            </style>
        @endauth
    </div>
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('js/alertify.js') }}" defer></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    @yield('custom_scripts')
</body>

</html>
