<?php
/**
 *
 * User: Omar
 * Date: 1/12/14
 * Time: 02:00 PM
 *
 * Clase que implementa todos los métodos del caso de uso generar solicitudes para soporte técnico
 */

class GenerarSolicitudesParaSoporteTecnicoController extends BaseController {
    /**
     *Regresa el formulario con la solicitud de reportes
     * return @mixed
     */
    public function mostrarSolicitud(){

        return View::make('generarsolicitudparasoportetecnico.solicitudsoporte');
    }

    /**
    * Envia la solicitud por Correo Implementando la clase Mail
    *
    * Input:
    * $nombre @string nombre completo
    * $correoelectronico @string correo electronico
    * $asunto @string asunto
    * $contenido @string contenido
    * Output:
    * @mixed
    */

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