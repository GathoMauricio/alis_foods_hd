<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seguimiento;

class SeguimientoController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'autor_id' => 'required',
            'ticket_id' => 'required',
            'texto' => 'required',
        ]);

        $seguimiento = Seguimiento::create([
            'autor_id' => $request->autor_id,
            'ticket_id' => $request->ticket_id,
            'texto' => $request->texto,
        ]);

        if ($seguimiento) {
            return redirect()->route('show_tickets', $request->ticket_id)->with('message', 'El seguimiento se creó con éxito.');
        }
    }
}
