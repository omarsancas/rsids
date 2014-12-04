<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 1/12/14
 * Time: 02:00 PM
 */

class GenerarSolicitudesParaSoporteTecnicoController extends BaseController {

    public function mostrarSolicitud(){

        return View::make('generarsolicitudparasoportetecnico.solicitudsoporte');
    }

    public function enviarSolicitud()
    {
        $nombre = Input::get('nombrecompleto');
        $correoelectronico = Input::get('correoelectronico');
        $asunto = Input::get('asunto');
        $contenido = Input::get('contenido');

        $data = ['nombre' => $nombre, 'correelectronico' => $correoelectronico, 'asunto' => $asunto, 'contenido' => $contenido];
        Mail::send('emails.welcome', $data, function ($message) use ($correoelectronico)
        {
            $message->from('moroccosc@gmail.com', 'Laravel')->subject('Notificacion de rechazo de solicitud de recursos');
            $message->to('super@unam.mx');
        });



    }

} 