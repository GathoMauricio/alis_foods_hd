<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\User;
use App\Models\TicketEstatus;

class DistritalSucursalController extends Controller
{
    public function index()
    {
        $distrital_sucursales_ids = \Auth::user()->distrital_sucursales->pluck('sucursal_id')->toArray();

        $tickets = Ticket::select('tickets.*')->where('tickets.estatus_id', '<', 5)
            ->where(function ($q) use ($distrital_sucursales_ids) {
                foreach ($distrital_sucursales_ids as $sucursal_id) {
                    $q->orWhere('sucursales.id', $sucursal_id);
                }
            })
            ->leftJoin('users', 'tickets.autor_id', 'users.id')
            ->leftJoin('sucursales', 'users.sucursal_id', 'sucursales.id')
            ->orderBy('tickets.id', 'DESC')
            ->paginate(15);
        return view('distrital.index', compact('tickets'));
    }

    public function show($id)
    {
        $ticket = Ticket::findOrFail($id);
        $tecnicos = User::where('categoria_id', $ticket->sintoma->servicio->subcategoria->categoria->id)->orderBy('name')->get();
        $estatuses = TicketEstatus::get();
        return view('distrital.show', compact('ticket', 'tecnicos', 'estatuses'));
    }

    public function historico()
    {
        $distrital_sucursales_ids = \Auth::user()->distrital_sucursales->pluck('sucursal_id')->toArray();

        $tickets = Ticket::select('tickets.*')->where('tickets.estatus_id', '>=', 5)
            ->where(function ($q) use ($distrital_sucursales_ids) {
                foreach ($distrital_sucursales_ids as $sucursal_id) {
                    $q->orWhere('sucursales.id', $sucursal_id);
                }
            })
            ->leftJoin('users', 'tickets.autor_id', 'users.id')
            ->leftJoin('sucursales', 'users.sucursal_id', 'sucursales.id')
            ->orderBy('tickets.id', 'DESC')
            ->paginate(15);
        return view('distrital.historico', compact('tickets'));
    }
}
