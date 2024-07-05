<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subcategoria;
use App\Models\Servicio;
use App\Models\Sintoma;
use App\Models\Sugerencia;

class AxiosController extends Controller
{
    public function cargarSubcategorias(Request $request)
    {
        $subcategorias = Subcategoria::where('categoria_id', $request->categoria_id)->get();
        return response()->json($subcategorias);
    }

    public function cargarServicios(Request $request)
    {
        $servicios = Servicio::where('subcategoria_id', $request->subcategoria_id)->get();
        return response()->json($servicios);
    }

    public function cargarSintomas(Request $request)
    {
        $sintomas = Sintoma::where('servicio_id', $request->servicio_id)->get();
        return response()->json($sintomas);
    }

    public function cargarSugerencia(Request $request)
    {
        $sugerencias = Sugerencia::where('sintoma_id', $request->sintoma_id)->get();
        return response()->json(['sugerencias' => $sugerencias]);
    }

    public function cargarSintoma(Request $request)
    {
        $sintoma = Sintoma::find($request->sintoma_id);
        return response()->json($sintoma);
    }
}
