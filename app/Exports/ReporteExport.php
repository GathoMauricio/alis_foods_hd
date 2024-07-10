<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;

class ReporteExport implements FromView
{
    private $inicio;
    private $final;

    public function __construct($inicio, $final)
    {
        $this->inicio = $inicio;
        $this->final = $final;
    }

    public function view(): View
    {
        if (Auth::user()->hasRole('Gerente')) {
            $tickets = Ticket::where('autor_id', Auth::user()->id)
                ->whereBetween('created_at', [$this->inicio . " 00:00:00", $this->final . " 23:59:59"])
                ->orderBy('id', 'DESC')->get();
        }

        if (Auth::user()->hasRole('Técnico')) {
            $tickets = Ticket::select('tickets.*')
                ->leftjoin('sintomas', 'tickets.sintoma_id', 'sintomas.id')
                ->leftjoin('servicios', 'sintomas.servicio_id', 'servicios.id')
                ->leftjoin('subcategorias', 'servicios.subcategoria_id', 'subcategorias.id')
                ->leftjoin('categorias', 'subcategorias.categoria_id', 'categorias.id')
                ->where('tickets.tecnico_id', Auth::user()->id)
                ->whereBetween('tickets.created_at', [$this->inicio . " 00:00:00", $this->final . " 23:59:59"])
                ->orderBy('tickets.id', 'DESC')
                ->get();
        }

        if (Auth::user()->hasRole('Administrador')) {
            $tickets = Ticket::whereBetween('created_at', [$this->inicio . " 00:00:00", $this->final . " 23:59:59"])
                ->orderBy('id', 'DESC')->get();
        }

        if (Auth::user()->hasRole('Administrador') && Auth::user()->hasRole('Técnico')) {
            $tickets = Ticket::select('tickets.*')
                ->leftjoin('sintomas', 'tickets.sintoma_id', 'sintomas.id')
                ->leftjoin('servicios', 'sintomas.servicio_id', 'servicios.id')
                ->leftjoin('subcategorias', 'servicios.subcategoria_id', 'subcategorias.id')
                ->leftjoin('categorias', 'subcategorias.categoria_id', 'categorias.id')
                ->where('categorias.id', Auth::user()->categoria_id)
                ->whereBetween('tickets.created_at', [$this->inicio . " 00:00:00", $this->final . " 23:59:59"])
                ->orderBy('tickets.id', 'DESC')
                ->get();
        }

        if (Auth::user()->hasRole('Super usuario')) {
            $tickets = Ticket::whereBetween('created_at', [$this->inicio . " 00:00:00", $this->final . " 23:59:59"])
                ->orderBy('id', 'DESC')->get();
        }

        return view('exports.reporte', ['tickets' => $tickets]);
    }
}
