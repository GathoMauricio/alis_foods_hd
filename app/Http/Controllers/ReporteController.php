<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\ReporteExport;

class ReporteController extends Controller
{
    public function index()
    {
        return view('reportes.index');
    }

    public function generarReporte(Request $request)
    {
        return \Excel::download(new ReporteExport($request->inicio, $request->final), 'reporte_AlisFoods_' . $request->inicio . '_' . $request->final . '.xlsx');
    }
}
