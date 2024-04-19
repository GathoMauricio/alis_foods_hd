@extends('layouts.app')

@section('content')
    <div class="container p-3" style="background-color: white;border: solid 5px #f4f6f9;">
        <h3>
            <div style="float: right;">
                <a href="javascript::void(0)" onclick="nuevaCategoria();" class="btn btn-primary" title="Nuevo">
                    Nueva categoría
                </a>
            </div>
            Categorías
        </h3>
        <br>
        <div class="row">
            @foreach ($categorias as $categoria)
                <div class="card col-md-6">
                    <div class="card-header p-3">
                        <h5>{{ $categoria->nombre }}</h5>
                        <h6>
                            Subcategorías
                            <br>
                            <a href="javascript:void();" onclick="nuevaSubcategoria({{ $categoria->id }});">
                                Agregar
                            </a>
                        </h6>
                    </div>
                    <ul>
                        @forelse ($categoria->subcategorias as $subcategoria)
                            <li>
                                <a href="{{ route('servicios', $subcategoria->id) }}">{{ $subcategoria->nombre }}
                                    ({{ count($subcategoria->servicios) }})
                                </a>
                            </li>
                        @empty
                            <li>No hay registros</li>
                        @endforelse
                    </ul>
                </div>
            @endforeach
        </div>
    </div>
    @include('categorias.nueva_categoria')
    @include('categorias.nueva_subcategoria')
@endsection
@section('custom_scripts')
    <script>
        function nuevaCategoria() {
            $("#nueva_categoria_modal").modal('show');
        }

        function nuevaSubcategoria(categoria_id) {
            $("#txt_categoria_id").val(categoria_id);
            $("#nueva_subcategoria_modal").modal('show');
        }
    </script>
@endsection
