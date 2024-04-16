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
        if (Auth::user()->hasRole('Gerente')) {
            $tickets = Ticket::where('estatus_id', '<', 5)->where('autor_id', Auth::user()->id)->orderBy('id', 'DESC')->paginate(15);
        }

        if (Auth::user()->hasRole('Técnico')) {
            $tickets = Ticket::where('estatus_id', '<', 5)
                ->leftjoin('sintomas', 'tickets.sintoma_id', 'sintomas.id')
                ->leftjoin('servicios', 'sintomas.servicio_id', 'servicios.id')
                ->leftjoin('subcategorias', 'servicios.subcategoria_id', 'subcategorias.id')
                ->leftjoin('categorias', 'subcategorias.categoria_id', 'categorias.id')
                ->where('categorias.id', Auth::user()->categoria_id)->orderBy('tickets.id', 'DESC')->paginate(15);;
        }

        if (Auth::user()->hasRole('Administrador')) {
            $tickets = Ticket::where('estatus_id', '<', 5)->orderBy('id', 'DESC')->paginate(15);
        }

        if (Auth::user()->hasRole('Super usuario')) {
            $tickets = Ticket::where('estatus_id', '<', 5)->orderBy('id', 'DESC')->paginate(15);
        }

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

            return response()->json([
                'error' => 0,
                'mensaje' => 'Registro creado',
                'ticket_id' => $ticket->id,
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


    public function estatusTicket(Request $request)
    {
        $ticket = Ticket::findOrFail($request->ticket_id);
        //Si el estatus llega en proceso con terceros, se guarda tambien el detalle pero no se guarda el timestamp
        if ($ticket->update($request->all())) {
            //Si el eststus llega directamente en proceso se guarda el timestamp
            if ($request->estatus_id == 3) {
                $ticket->proceso_at = date('Y-m-d H:i:s');
                $ticket->save();
            }
            if ($request->estatus_id == 4) {
                $ticket->cerrado_at = date('Y-m-d H:i:s');
                $ticket->save();
            }
            if ($request->estatus_id == 5) {
                $ticket->finalizado_at = date('Y-m-d H:i:s');
                $ticket->save();
            }

            //Enviar email al gerente(author) y admins
            return redirect()->route('show_tickets', $request->ticket_id)->with('message', 'El ticket ha sido actualizado');
        }
    }
}
