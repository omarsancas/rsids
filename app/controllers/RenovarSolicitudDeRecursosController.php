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
        $porcentaje = DB::table('contabilidad')
            ->select(DB::raw('sum(contabilidad.cont_num_jobs) AS totaljobs,sum(contabilidad.cont_hrs_nodo) AS totalnodo,
            CONCAT(FORMAT(IF(proy_hrs_aprobadas=0,0,(sum(contabilidad.cont_hrs_nodo)*100.0)/proy_hrs_aprobadas),2)) AS porcentajeproyecto'))
            ->join('usuario', 'contabilidad.cont_id_usuario', '=', 'usuario.usua_id_usuario')
            ->join('proyecto', 'usuario.usua_id_proyecto', '=', 'proyecto.proy_id_proyecto')
            ->where('usuario.usua_id_usuario', '=',$usuario)
            ->groupBy('proyecto.proy_id_proyecto')
            ->first();

        return View::make('usuariocuentatitular/renovarsolicitudderecursos/renovarsolicitudderecursos')->with('porcentaje',$porcentaje);
    }

} 