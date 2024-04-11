<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seguimiento;
use App\Models\User;

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
            $emails = [];
            foreach (User::get() as $user) {
                if ($user->hasRole('Administrador') || $seguimiento->ticket->autor_id == $user->id || $seguimiento->ticket->tecnico_id == $user->id) {
                    $emails[] = $user->email;
                }
            }
            $not = new NotificacionController();
            $data = [
                'tipo_notificacion' => 'nuevo_seguimiento',
                'ticket' => $seguimiento->ticket,
            ];

            $not->enviarEmail("Nuevo seguimiento", "notificacion", $data, $emails);
            //\Log::debug($emails);
            return redirect()->route('show_tickets', $request->ticket_id)->with('message', 'El seguimiento se creó con éxito.');
        }
    }
}
