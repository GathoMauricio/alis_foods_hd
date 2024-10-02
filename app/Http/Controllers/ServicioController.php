<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subcategoria;
use App\Models\Servicio;
use App\Models\Sintoma;

class ServicioController extends Controller
{
    public function index($id)
    {
        $subcategoria = Subcategoria::find($id);
        $servicios = Servicio::where('subcategoria_id', $id)->orderBy('nombre')->get();
        return view('servicios.index', compact('subcategoria', 'servicios'));
    }

    public function storeServicio(Request $request)
    {
        $request->validate(['subcategoria_id' => 'required', 'nombre' => 'required']);
        $registro = Servicio::create(['subcategoria_id' => $request->subcategoria_id, 'nombre' => $request->nombre]);
        if ($registro) {
            return redirect()->back()->with('message', 'Registro creado');
        }
    }

    public function storeSintoma(Request $request)
    {
        $request->validate(['servicio_id' => 'required', 'nombre' => 'required']);
        $registro = Sintoma::create(['servicio_id' => $request->servicio_id, 'nombre' => $request->nombre]);
        if ($registro) {
            return redirect()->back()->with('message', 'Registro creado');
        }
    }

    public function updateSintoma(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'tiempo_respuesta' => 'required',
            'tiempo_solucion' => 'required',
        ]);

        $sintoma = Sintoma::find($request->sintoma_id);

        if ($sintoma->update($request->all())) {
            return redirect()->back()->with('message', 'Registro actualizado');
        }
    }

    public function updateSubcategoria(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
        ]);

        $subcategoria = Subcategoria::find($request->subcategoria_id);

        if ($subcategoria->update($request->all())) {
            return redirect()->back()->with('message', 'Registro actualizado');
        }
    }
}
