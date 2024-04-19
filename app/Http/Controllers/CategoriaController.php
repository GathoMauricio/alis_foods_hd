<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Subcategoria;
use App\Models\Servicio;
use App\Models\Sintoma;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::orderBy('nombre')->get();
        return view('categorias.index', compact('categorias'));
    }

    public function storeCategoria(Request $request)
    {
        $request->validate(['nombre' => 'required']);
        $registro = Categoria::create(['nombre' => $request->nombre]);
        if ($registro) {
            return redirect()->back()->with('message', 'Registro creado');
        }
    }

    public function storeSubcategoria(Request $request)
    {
        $request->validate(['categoria_id' => 'required', 'nombre' => 'required']);
        $registro = Subcategoria::create(['categoria_id' => $request->categoria_id, 'nombre' => $request->nombre]);
        if ($registro) {
            return redirect()->back()->with('message', 'Registro creado');
        }
    }
}
