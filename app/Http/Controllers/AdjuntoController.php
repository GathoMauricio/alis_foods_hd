<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Adjunto;
use App\Models\User;

class AdjuntoController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'ruta' => 'required|mimes:jpg,jpeg,png',
            'descripcion' => 'required'
        ]);

        $ruta_completa = $request->file('ruta')->store('public/adjuntos');
        $partes = explode('/', $ruta_completa);
        $nombre_imagen = $partes[2];

        $adjunto = Adjunto::create([
            'autor_id' => $request->autor_id,
            'ticket_id' => $request->ticket_id,
            'ruta' => $nombre_imagen,
            'descripcion' => $request->descripcion
        ]);

        if ($adjunto) {
            $emails = [];
            foreach (User::get() as $user) {
                if ($user->hasRole('Administrador') || $adjunto->ticket->autor_id == $user->id || $adjunto->ticket->tecnico_id == $user->id) {
                    $emails[] = $user->email;
                }
            }
            $not = new NotificacionController();
            $data = [
                'tipo_notificacion' => 'nuevo_adjunto',
                'ticket' => $adjunto->ticket,
            ];

            $not->enviarEmail("Nuevo adjunto " . $adjunto->ticket->folio, "notificacion", $data, $emails);
            //\Log::debug($emails);
            return redirect()->route('show_tickets', $request->ticket_id)->with('message', 'El adjunto se creó con éxito.');
        }
    }
}
