<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sintoma;
use App\Models\Sugerencia;

class SugerenciaController extends Controller
{
    public function index($id)
    {
        $sintoma = Sintoma::find($id);
        $sugerencias = Sugerencia::where('sintoma_id', $id)->get();
        return view('sugerencias.index', compact('sintoma', 'sugerencias'));
    }

    public function storeSugerencia(Request $request)
    {
        $request->validate(['sintoma_id' => 'required', 'nombre' => 'required']);
        $registro = Sugerencia::create(['sintoma_id' => $request->sintoma_id, 'nombre' => $request->nombre]);
        if ($registro) {
            return redirect()->back()->with('message', 'Registro creado');
        }
    }
}
