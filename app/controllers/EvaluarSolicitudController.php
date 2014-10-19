<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 15/10/14
 * Time: 11:13 AM
 */

class EvaluarSolicitudController extends BaseController{

    public function modificarSolicitud()
    {

        $solicitudes = DB::table('solicitud_abstracta')
            ->join('tipo_solicitud', 'solicitud_abstracta.soab_id_tipo_solicitud', '=', 'tipo_solicitud.tiso_id_tipo_solicitud')
            ->where('solicitud_abstracta.soab_id_estado_solicitud', '=' , 0)
            ->get();

        return View::make('evaluarsolicitudderecursos/evaluarsolicitud')->with('solicitudes',$solicitudes);
    }


    public function aceptar($id)
    {
        $solicitudabstracta =  SolicitudAbstracta::find($id);
        $solicitudabstracta->soab_id_estado_solicitud = 1;
        $solicitudabstracta->soab_es_proyecto = 1;
        $solicitudabstracta->save();

        $esproyecto = new Proyecto;
        $esproyecto->proy_id_solicitud_abstracta = $solicitudabstracta->SOAB_ID_SOLICITUD_ABSTRACTA;
        $esproyecto->save();

        $usuario = new Usuario;
        $nombre = strtolower($solicitudabstracta->SOAB_NOMBRES);
        $apellido = strtolower($solicitudabstracta->SOAB_AP_PATERNO);



        $nombre = "$nombre$apellido";
        $login = str_replace(' ', '', $nombre);
        $usuario->usua_login = $login;
        $usuario->usua_id_tipo_usuario = 2;
        $usuario->save();

        $cuentascolaboradoras = DB::table('solicitud_cta_colaboradora')
                   ->where('solicitud_cta_colaboradora.soco_id_solicitud_abstracta', '=', $id)
                   ->get();

        foreach($cuentascolaboradoras as $cuentacolaboradora)
        {
            $usuario = new Usuario;
            $nombre = strtolower($cuentacolaboradora->SOCO_NOMBRES);
            $apellido = strtolower($cuentacolaboradora->SOCO_AP_PATERNO);
            $nombre = "$nombre$apellido";
            $login = str_replace(' ', '', $nombre);
            $usuario->usua_login = $login;
            $usuario->usua_id_tipo_usuario = 3;
            $usuario->save();

        }




        Session::flash('message', '¡La solicitud se ha aceptado exitosamente!');
        return Redirect::to('evaluarsolicitudderecursos/evaluarsolicitud');

    }

} 