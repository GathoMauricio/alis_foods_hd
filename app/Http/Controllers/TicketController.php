<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Categoria;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::where('estatus_id', '<', 4);

        if (Auth::user()->hasRole('Gerente')) {
            $tickets = $tickets->where('autor_id', Auth::user()->id);
        }

        if (Auth::user()->hasRole('Técnico')) {
            $tickets = $tickets
                ->leftjoin('sintomas', 'tickets.sintoma_id', 'sintomas.id')
                ->leftjoin('servicios', 'sintomas.servicio_id', 'servicios.id')
                ->leftjoin('subcategorias', 'servicios.subcategoria_id', 'subcategorias.id')
                ->leftjoin('categorias', 'subcategorias.categoria_id', 'categorias.id')
                ->where('categorias.id', Auth::user()->categoria_id);
        }

        if (Auth::user()->hasRole('Administrador') && Auth::user()->hasRole('Técnico')) {
            $tickets = Ticket::where('estatus_id', '<', 4);
        }
        $tickets = $tickets->orderBy('tickets.created_at', 'DESC')->paginate(15);
        return view('tickets.index', compact('tickets'));
    }

    public function show($id)
    {
        $ticket = Ticket::findOrFail($id);
        return view('tickets.show', compact('ticket'));
    }

    public function create()
    {
        $categorias = Categoria::orderBy('nombre')->get();
        return view('tickets.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'categoria' => 'required',
            'subcategoria' => 'required',
            'servicio' => 'required',
            'sintoma_id' => 'required',
            'descripcion' => 'required',
        ], [
            'categoria.required' => 'Este campo es obligatorio',
            'subcategoria.required' => 'Este campo es obligatorio',
            'servicio.required' => 'Este campo es obligatorio',
            'sintoma_id.required' => 'Este campo es obligatorio',
            'descripcion.required' => 'Este campo es obligatorio',
        ]);

        $ticket = Ticket::create([
            'estatus_id' => 1,
            'sintoma_id' => $request->sintoma_id,
            'autor_id' => Auth::user()->id,
            'tecnico_id' => null,
            'folio' => $this->generaFolio(),
            'descripcion' => $request->descripcion,
            'sla' => null,
            'proceso_at' => null,
            'cerrado_at' => null
        ]);

        if ($ticket) {
            return response()->json([
                'error' => 0,
                'mensaje' => 'Registro creado',
            ]);
        } else {
            return response()->json([
                'error' => 1,
                'mensaje' => 'Error durante el proceso',
            ]);
        }
    }

    private function generaFolio()
    {
        $ultimo = Ticket::orderBy('id', 'DESC')->first();
        if ($ultimo)
            return 'TK-' . ($ultimo->id + 1);
        else
            return 'TK-1';
    }
}
