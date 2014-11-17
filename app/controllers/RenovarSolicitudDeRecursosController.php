<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 12/11/14
 * Time: 03:00 PM
 */

class RenovarSolicitudDeRecursosController extends BaseController {

    public function renovarSolicitudDeRecursosVista()
    {
        $usuario = Auth::user()->USUA_ID_USUARIO;
        $datosrenovacion = DB::table('usuario')
            ->join('usuario_x_proyecto', 'usuario.usua_id_usuario', '=', 'usuario_x_proyecto.uspr_id_usuario')
            ->join('proyecto', 'usuario_x_proyecto.uspr_id_proyecto', '=', 'proyecto.proy_id_proyecto')
            ->join('solicitud_abstracta', 'proyecto.proy_id_solicitud_abstracta', '=', 'solicitud_abstracta.soab_id_solicitud_abstracta')
            ->join('medio_comunicacion', 'solicitud_abstracta.soab_id_medio_comunicacion', '=', 'medio_comunicacion.meco_id_medio_comunicacion')
            ->join('dependencia', 'solicitud_abstracta.soab_id_dependencia', '=', 'dependencia.depe_id_dependencia')
            ->where('usuario.usua_id_usuario' , '=', $usuario )
            ->first();

         $fecha = $datosrenovacion->PROY_FEC_TERM_RECU;
        $date1 = strtotime($fecha); // your input
        $date2 = strtotime("today"); //today
        if($date1 > $date2) {

             $date = 0;
        }else{

            $date =  1;
        }

        $idsolicitudabastracta = $datosrenovacion->SOAB_ID_SOLICITUD_ABSTRACTA;
        $idproyecto = $datosrenovacion->PROY_ID_PROYECTO;

        $solicitudabstracta = SolicitudAbstracta::find($idsolicitudabastracta);
        $dependencias_catalogo = Dependencia::lists('depe_nombre', 'depe_id_dependencia');
        $grado = Grado::lists('grad_nombre', 'grad_id_grado');
        $campotrabajo = CampoTrabajo::lists('catr_nombre_campo', 'catr_id_campo_trabajo');
        $estadousuario = EstadoUsuario::lists('esus_estado_nombre','esus_id_estado_usuario');
        $this->data['solicitud'] = $solicitudabstracta;
        $this->data['aplicaciones'] = Aplicacion::all();
        $aplicacionesseleccionadas = $solicitudabstracta->aplicaciones()->get()->toArray();
        $aplicacionesseleccionadas = array_pluck($aplicacionesseleccionadas, 'APLI_ID_APLICACION');
        $this->data['aplicacionesseleccionadas'] = $aplicacionesseleccionadas;

        $cuentascolaboradoras = DB::table('usuario')
            ->join('usuario_x_proyecto', 'usuario.usua_id_usuario', '=', 'usuario_x_proyecto.uspr_id_usuario')
            ->where('usuario_x_proyecto.uspr_id_proyecto','=', $idproyecto)
            ->where('usuario.usua_id_tipo_usuario','=',3)
            ->get();


        $otraapp = DB::table('otra_app')
            ->join('solicitud_abstracta', 'solicitud_abstracta.soab_id_solicitud_abstracta', '=', 'otra_app.otap_id_solicitud_abstracta')
            ->where('otra_app.otap_id_solicitud_abstracta', '=', $idsolicitudabastracta)
            ->get();

        $otrocampo = DB::table('otro_campo_trabajo')
            ->join('solicitud_abstracta', 'solicitud_abstracta.soab_id_otro_campo', '=', 'otro_campo_trabajo.otca_id_otro_campo')
            ->where('solicitud_abstracta.soab_id_solicitud_abstracta', '=', $idsolicitudabastracta)
            ->first();


        return View::make('usuariocuentatitular/renovarsolicitudderecursos/renovarsolicitudderecursos',$this->data)
            ->with('datosrenovacion',$datosrenovacion)
            ->with('dependencias_catalogo',$dependencias_catalogo)
            ->with('cuentascolaboradoras',$cuentascolaboradoras)
            ->with('otraapp',$otraapp)
            ->with('otrocampo',$otrocampo)
            ->with('grado',$grado)
            ->with('campotrabajo',$campotrabajo)
            ->with('estadousuario',$estadousuario)
            ->with('date',$date);
    }

} 