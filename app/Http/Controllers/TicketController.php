<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Categoria;
use App\Models\Subcategoria;
use App\Models\User;
use App\Models\TicketEstatus;
use App\Models\Adjunto;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{

    public function index($sucursal = null)
    {
        if (Auth::user()->distrital == 'SI') {
            return redirect('distrital');
        }

        if (Auth::user()->hasRole('Gerente')) {
            $tickets = Ticket::where('estatus_id', '!=', 5)->where('autor_id', Auth::user()->id);
            if ($sucursal) {
                $tickets = $tickets->where('autor_id', $sucursal);
            }
            $tickest = $tickets->orderBy('id', 'DESC')->paginate(15);
        }

        if (Auth::user()->hasRole('Administrador') || Auth::user()->hasRole('Técnico')) {
            $tickets = Ticket::select('tickets.*')
                ->leftjoin('sintomas', 'tickets.sintoma_id', 'sintomas.id')
                ->leftjoin('servicios', 'sintomas.servicio_id', 'servicios.id')
                ->leftjoin('subcategorias', 'servicios.subcategoria_id', 'subcategorias.id')
                ->leftjoin('categorias', 'subcategorias.categoria_id', 'categorias.id')
                ->where('tickets.estatus_id', '!=', 5)
                ->where('categorias.id', Auth::user()->categoria_id);
            if ($sucursal) {
                $tickets = $tickets->where('tickets.autor_id', $sucursal);
            }
            $tickets = $tickets->orderBy('id', 'DESC')->paginate(15);
        }

        if (Auth::user()->hasRole('Super usuario')) {
            $tickets = Ticket::where('estatus_id', '!=', 5);
            if ($sucursal) {
                $tickets = $tickets->where('autor_id', $sucursal);
            }
            $tickets = $tickets->orderBy('id', 'DESC')->paginate(15);
        }

        $categorias = Categoria::orderBy('nombre')->get();
        $usuarios = User::orderBy('name')->whereNotNull('sucursal_id')->get();
        return view('tickets.index', compact('tickets', 'categorias', 'usuarios'));
    }

    public function historico($sucursal = null)
    {
        if (Auth::user()->hasRole('Gerente')) {
            $tickets = Ticket::where('estatus_id',  5)->where('autor_id', Auth::user()->id);
            if ($sucursal) {
                $tickets = $tickets->where('autor_id', $sucursal);
            }
            $tickets = $tickets->orderBy('id', 'DESC')->paginate(15);
        }

        if (Auth::user()->hasRole('Administrador') || Auth::user()->hasRole('Técnico')) {
            $tickets = Ticket::select('tickets.*')->where('estatus_id',  5)
                ->leftjoin('sintomas', 'tickets.sintoma_id', 'sintomas.id')
                ->leftjoin('servicios', 'sintomas.servicio_id', 'servicios.id')
                ->leftjoin('subcategorias', 'servicios.subcategoria_id', 'subcategorias.id')
                ->leftjoin('categorias', 'subcategorias.categoria_id', 'categorias.id')
                ->where('categorias.id', Auth::user()->categoria_id);
            if ($sucursal) {
                $tickets = $tickets->where('autor_id', $sucursal);
            }
            $tickets = $tickets->orderBy('tickets.id', 'DESC')
                ->paginate(15);
        }

        if (Auth::user()->hasRole('Super usuario')) {
            $tickets = Ticket::where('estatus_id',  5);
            if ($sucursal) {
                $tickets = $tickets->where('autor_id', $sucursal);
            }
            $tickets = $tickets->orderBy('id', 'DESC')->paginate(15);
        }

        $usuarios = User::orderBy('name')->whereNotNull('sucursal_id')->get();

        return view('tickets.historico', compact('tickets', 'usuarios'));
    }

    public function show($id)
    {
        $ticket = Ticket::findOrFail($id);
        $tecnicos = User::where('categoria_id', $ticket->sintoma->servicio->subcategoria->categoria->id)
            ->orderBy('name')->get();
        $estatuses = TicketEstatus::get();
        return view('tickets.show', compact('ticket', 'tecnicos', 'estatuses'));
    }

    public function create($id)
    {
        //$categorias = Categoria::orderBy('nombre')->get();
        $categoria = Categoria::findOrFail($id);
        $subcategorias = Subcategoria::where('categoria_id', $id)->orderBy('nombre')->get();
        return view('tickets.create', compact('categoria', 'subcategorias'));
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


        if ($request->file('file_ruta')) {
            $max_size = (int)ini_get('upload_max_filesize') * 10240;

            $rutas = $request->file('file_ruta');
            $contador = 0;
            foreach ($rutas as $ruta) {
                $ruta_completa = $ruta->store('public/adjuntos');
                $partes = explode('/', $ruta_completa);
                $nombre_imagen = $partes[2];

                Adjunto::create([
                    'autor_id' => \Auth::user()->id,
                    'ticket_id' => $ticket->id,
                    'ruta' => $nombre_imagen,
                    'descripcion' => $request->file_descripcion[$contador],
                    'mimetype' => $ruta->getClientMimeType(),
                ]);
                $contador++;
            }
        }



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

            $not->enviarEmail("Nuevo ticket " . $ticket->folio, "notificacion", $data, $emails);

            // return response()->json([
            //     'error' => 0,
            //     'mensaje' => 'Registro creado',
            //     'ticket_id' => $ticket->id,
            // ]);

            return redirect()->route('show_tickets', $ticket->id)->with('message', 'El ticket se creó con éxito.');
        } else {
            // return response()->json([
            //     'error' => 1,
            //     'mensaje' => 'Error durante el proceso',
            // ]);
            return redirect()->route('show_tickets', $ticket->id)->with('message', 'Error al crear el ticket.');
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
                $ticket->tipo_finalizado = "Por el gerente";
                $ticket->finalizado_at = date('Y-m-d H:i:s');
                $ticket->save();
            }

            $emails = [];
            if ($request->estatus_id < 5) {
                foreach (User::get() as $user) {
                    if ($user->hasRole('Administrador') || $user->id == $ticket->autor_id) {
                        $emails[] = $user->email;
                    }
                }
            } else {
                foreach (User::get() as $user) {
                    if ($user->hasRole('Administrador') || $user->id == $ticket->tecnico_id) {
                        $emails[] = $user->email;
                    }
                }
            }

            $not = new NotificacionController();
            $data = [
                'tipo_notificacion' => 'cambio_estatus',
                'ticket' => $ticket,
            ];
            $not->enviarEmail("Cambio de estatus " . $ticket->folio, "notificacion", $data, $emails);

            return redirect()->route('show_tickets', $request->ticket_id)->with('message', 'El ticket ha sido actualizado');
        }
    }
    public function asignarTicket(Request $request)
    {
        $ticket = Ticket::findOrFail($request->ticket_id);
        $ticket->tecnico_id = $request->tecnico_id;
        $ticket->estatus_id = $request->estatus_id;
        if ($ticket->save()) {
            return redirect()->route('show_tickets', $request->ticket_id)->with('message', 'El ticket ha sido actualizado');
        }
    }
}
