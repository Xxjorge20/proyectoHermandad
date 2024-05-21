<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CorreoController extends Controller
{
    /**
         * Envía un correo electrónico utilizando los datos proporcionados en el formulario.
         *
         * @param \Illuminate\Http\Request $request El objeto de solicitud que contiene los datos del formulario.
         * @return \Illuminate\Http\RedirectResponse Redirecciona de vuelta con un mensaje de éxito o error.
         */

        public function enviarCorreo(Request $request)
        {
            // Validar los datos del formulario
            $request->validate([
                'destinatario' => 'required|email',
                'asunto' => 'required',
                'mensaje' => 'required',
            ]);

            // Obtener los datos del formulario
            $destinatario = $request->input('destinatario');
            $asunto = $request->input('asunto');
            $mensaje = $request->input('mensaje');

            // Obtengo el correo de la hermandad del archivo env
            $correoHermandad = env('MAIL_FROM_ADDRESS');

            try {

                // Envio el correo electronico del formulario de contacto a la hermandad
                Mail::raw($mensaje, function ($message) use ($destinatario, $asunto, $correoHermandad){
                    $message->from($destinatario);
                    $message->sender($destinatario);
                    $message->to($correoHermandad);
                    $message->subject($asunto);
                });

                // Redirigir de vuelta con un mensaje de éxito
                return redirect()->back()->with('success', 'Correo electrónico enviado con éxito.');
            } catch (\Exception $e) {
                // Manejar errores de envío de correo electrónico
                return redirect()->back()->with('error', 'Error al enviar el correo electrónico: ' . $e->getMessage());
            }
        }

}
