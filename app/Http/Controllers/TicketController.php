<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Categoria;
use App\Models\User;
use App\Models\TicketEstatus;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{

    public function index()
    {
        $tickets = Ticket::where('estatus_id', '<', 4);

        // if (Auth::user()->hasRole('Gerente')) {
        //     $tickets = $tickets->where('autor_id', Auth::user()->id);
        // }

        // if (Auth::user()->hasRole('Técnico')) {
        //     $tickets = $tickets
        //         ->leftjoin('sintomas', 'tickets.sintoma_id', 'sintomas.id')
        //         ->leftjoin('servicios', 'sintomas.servicio_id', 'servicios.id')
        //         ->leftjoin('subcategorias', 'servicios.subcategoria_id', 'subcategorias.id')
        //         ->leftjoin('categorias', 'subcategorias.categoria_id', 'categorias.id')
        //         ->where('categorias.id', Auth::user()->categoria_id);
        // }

        // if (Auth::user()->hasRole('Administrador') && Auth::user()->hasRole('Técnico')) {
        //     $tickets = Ticket::where('estatus_id', '<', 4);
        // }

        $tickets = $tickets->orderBy('tickets.created_at', 'DESC')->paginate(15);
        return view('tickets.index', compact('tickets'));
    }

    public function show($id)
    {
        $ticket = Ticket::findOrFail($id);
        $tecnicos = User::where('categoria_id', $ticket->sintoma->servicio->subcategoria->categoria->id)->orderBy('name')->get();
        $estatuses = TicketEstatus::get();
        return view('tickets.show', compact('ticket', 'tecnicos', 'estatuses'));
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

            $emails = [];
            foreach (User::get() as $user) {
                if ($user->hasRole('Administrador') || $user->categoria_id == $ticket->sintoma->servicio->subcategoria->categoria->id) {
                    $emails[] = $user->email;
                }
            }
            $not = new NotificacionController();
            $data = [
                'tipo_notificacion' => 'nuevo_ticket',
                'ticket' => $ticket,
            ];

            $not->enviarEmail("Nuevo ticket", "notificacion", $data, $emails);
            \Log::debug($emails);
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

    public function tomarTicket(Request $request)
    {
        $ticket = Ticket::findOrFail($request->ticket_id);
        if ($ticket->update($request->all())) {
            return redirect()->route('show_tickets', $request->ticket_id)->with('message', 'El ticket ha sido asignado a ' . $ticket->tecnico->name . ' ' . $ticket->tecnico->apaterno . ' ' . $ticket->tecnico->amaterno . '.');
        }
    }

    public function actualizarEstatus(Request $request)
    {
        $ticket = Ticket::findOrFail($request->ticket_id);
        $ticket->estatus_id = $request->estatus_id;
        switch ($request->estatus_id) {
            case 3:
                $ticket->proceso_at = date('Y-m-d H:i:s');
                break;
            case 4:
                $ticket->cerrado_at = date('Y-m-d H:i:s');
                break;
        }
        if ($ticket->save()) {
            return redirect()->route('show_tickets', $request->ticket_id)->with('message', 'El ticket ha cambiado de estatus.');
        }
    }
}
