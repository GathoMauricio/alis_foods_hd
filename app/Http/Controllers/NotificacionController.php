<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class NotificacionController extends Controller
{
    public function enviarEmail($subject, $vista, $data, $emails)
    {
        try {
            Mail::send("emails." . $vista, $data, function ($mail) use ($subject, $emails) {
                $mail->subject($subject);
                $mail->from('alisfoods@helpdesk.com', env('APP_NAME'));
                $mail->to($emails);
            });
        } catch (\Exception $e) {
            \Log::debug($e->getMessage());
            //\Log::debug("Error al enviar notificación email: " . $emails . " tipo: " . $subject . " Data: " . $data);
        }
    }
}
