<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 4/11/14
 * Time: 09:46 PM
 */

class GestionarProyectosController extends BaseController{

    public function mostrarConsultarProyectos()
    {
        return View::make('gestionarproyectos/consultarproyectosvista');
    }

    public function consultarProyectos()
    {
        $querynombre = Input::get('q');
        $queryestado = Input::get('estado');


        $proyectos = Proyecto::where('proy_nombre', 'LIKE', "%$querynombre%")
            ->where('proy_id_estado_proyecto' ,'=', $queryestado)
            ->groupBy('proy_id_proyecto')
            ->get();


        return View::make('gestionarproyectos/consultarproyecto')
                   ->with('proyectos',$proyectos);
    }

    public function consultarProyectoEspecifico($id)
    {

        $reportesproyectodatos = DB::table('contabilidad')
            ->select(DB::raw('sum(contabilidad.cont_num_jobs) AS totaljobs, usua_id_usuario ,proy_id_proyecto,soab_nombres,soab_ap_paterno, soab_ap_materno,
             proy_nombre, proy_hrs_aprobadas, proy_fec_ini_recu, sum(contabilidad.cont_hrs_nodo) AS totalnodo, proy_hrs_aprobadas,espr_tipo_estado,
             CONCAT(FORMAT(IF(proy_hrs_aprobadas=0,0,(sum(contabilidad.cont_hrs_nodo)*100.0)/proy_hrs_aprobadas),2)) AS porcentajeproyecto'))
            ->join('usuario', 'contabilidad.cont_id_usuario', '=', 'usuario.usua_id_usuario')
            ->join('proyecto', 'usuario.usua_id_proyecto', '=', 'proyecto.proy_id_proyecto')
            ->join('estado_proyecto', 'proyecto.proy_id_estado_proyecto', '=', 'estado_proyecto.espr_id_estado_proyecto')
            ->join('solicitud_abstracta', 'proyecto.proy_id_solicitud_abstracta', '=', 'solicitud_abstracta.soab_id_solicitud_abstracta')
            ->join('dependencia', 'solicitud_abstracta.soab_id_dependencia', '=', 'dependencia.depe_id_dependencia')
            ->where('proyecto.proy_id_proyecto','=',$id )
            ->groupBy('proyecto.proy_id_proyecto')
            ->first();

        $reportesproyectos = DB::table('contabilidad')
            ->select(DB::raw('sum(contabilidad.cont_num_jobs) AS totaljobs, usua_id_usuario ,proy_id_proyecto, proy_nombre ,sum(contabilidad.cont_hrs_nodo) AS totalnodo,
            proy_hrs_aprobadas, CONCAT(FORMAT(IF(proy_hrs_aprobadas=0,0,(sum(contabilidad.cont_hrs_nodo)*100.0)/proy_hrs_aprobadas),2)) AS porcentajeproyecto'))
            ->join('usuario', 'contabilidad.cont_id_usuario', '=', 'usuario.usua_id_usuario')
            ->join('proyecto', 'usuario.usua_id_proyecto', '=', 'proyecto.proy_id_proyecto')
            ->where('proyecto.proy_id_proyecto','=',$id )
            ->groupBy('usuario.usua_id_usuario')
            ->get();


        return View::make('gestionarproyectos/consultarproyectoespecifico')
            ->with('reportesproyectos',$reportesproyectos)
            ->with('reportesproyectodatos',$reportesproyectodatos);


    }



} 