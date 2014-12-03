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

    }

} 