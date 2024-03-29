<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sucursal;

class SucursalController extends Controller
{
    public function index()
    {
        $sucursales = Sucursal::orderBy('nombre');
        return view('sucursales.index', compact('sucursales'));
    }

    public function create()
    {
        return view('sucursales.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
        ], [
            'nombre.required' => 'Campo obligatorio.'
        ]);

        $sucursal = Sucursal::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion
        ]);

        if ($sucursal) {
            return redirect()->route('sucursales')->with('message', 'La sucursal ' . $sucursal->nombre . ' se creó con éxito.');
        }
    }

    public function show($id)
    {
        $sucursal = Sucursal::findOrFail($id);
        return view('sucursales.show', compact('sucursal'));
    }

    public function edit($id)
    {
        $sucursal = Sucursal::findOrFail($id);
        return view('sucursales.edit', compact('sucursal'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required',
        ], [
            'nombre.required' => 'Campo obligatorio.'
        ]);

        $sucursal = Sucursal::findOrFail($id);

        if ($sucursal->update($request->all())) {
            return redirect()->route('sucursales')->with('message', 'La sucursal ' . $sucursal->nombre . ' se actiualizó con éxito.');
        }
    }

    public function destroy($id)
    {
        $sucursal = Sucursal::findOrFail($id);
        $nombre = $sucursal->nombre;
        if ($sucursal->delete()) {
            return redirect()->route('sucursales')->with('message', 'La sucursal ' . $nombre . ' se eliminó con éxito.');
        }
    }
}
