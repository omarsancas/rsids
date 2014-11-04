<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 3/11/14
 * Time: 07:35 PM
 */

class GenerarReportesController extends BaseController {

    public function mostrarGenerarReporteMensualProyecto()
    {
        return View::make('generarreportes/contabilidadmensualproyectos');
    }

    public function mostrarGenerarReportePeriodoProyecto()
    {
        return View::make('generarreportes/contabilidadporperiodoproyectos');
    }

    public function generarReporteMensualProyecto()
    {
        $mes =  Input::get('mes');
        $anio = Input::get('anio');
        $reportesproyectos = DB::table('contabilidad')
            ->select(DB::raw('sum(contabilidad.cont_num_jobs) AS totaljobs, usua_id_usuario ,proy_id_proyecto, proy_nombre, sum(contabilidad.cont_hrs_nodo) AS totalnodo,
            proy_hrs_aprobadas, CONCAT(FORMAT(IF(proy_hrs_aprobadas=0,0,(sum(contabilidad.cont_hrs_nodo)*100.0)/proy_hrs_aprobadas),2)) AS porcentajeproyecto'))
            ->join('usuario', 'contabilidad.cont_id_usuario', '=', 'usuario.usua_id_usuario')
            ->join('proyecto', 'usuario.usua_id_proyecto', '=', 'proyecto.proy_id_proyecto')
            ->where(DB::raw('MONTH(cont_fecha)'), '=', $mes)
            ->where(DB::raw('YEAR(cont_fecha)'), '=', $anio)
            ->groupBy('usuario.usua_id_proyecto')
            ->get();

        $totalproyectos = DB::table('contabilidad')
            ->select(DB::raw('sum(contabilidad.cont_num_jobs) AS totaljobs, sum(contabilidad.cont_hrs_nodo) AS totalnodo'))
            ->where(DB::raw('MONTH(cont_fecha)'), '=', $mes)
            ->where(DB::raw('YEAR(cont_fecha)'), '=', $anio)
            ->first();


        return View::make('generarreportes/reportemensualproyectos')
                   ->with('reportesproyectos',$reportesproyectos)
                   ->with('mes',$mes)
                   ->with('anio',$anio)
                   ->with('totalproyectos',$totalproyectos);
    }

    public function mostrarReporteProyectoEspecifico($id,$mes,$anio)
    {

        $reportesproyectodatos = DB::table('contabilidad')
            ->select(DB::raw('sum(contabilidad.cont_num_jobs) AS totaljobs, usua_id_usuario ,proy_id_proyecto,depe_nombre,soab_nombres,soab_ap_paterno, soab_ap_materno,
             proy_nombre, proy_hrs_aprobadas, sum(contabilidad.cont_hrs_nodo) AS totalnodo,
            proy_hrs_aprobadas, CONCAT(FORMAT(IF(proy_hrs_aprobadas=0,0,(sum(contabilidad.cont_hrs_nodo)*100.0)/proy_hrs_aprobadas),2)) AS porcentajeproyecto'))
            ->join('usuario', 'contabilidad.cont_id_usuario', '=', 'usuario.usua_id_usuario')
            ->join('proyecto', 'usuario.usua_id_proyecto', '=', 'proyecto.proy_id_proyecto')
            ->join('solicitud_abstracta', 'proyecto.proy_id_solicitud_abstracta', '=', 'solicitud_abstracta.soab_id_solicitud_abstracta')
            ->join('dependencia', 'solicitud_abstracta.soab_id_dependencia', '=', 'dependencia.depe_id_dependencia')
            ->where('proyecto.proy_id_proyecto','=',$id )
            ->where(DB::raw('MONTH(cont_fecha)'), '=', $mes)
            ->where(DB::raw('YEAR(cont_fecha)'), '=', $anio)
            ->groupBy('proyecto.proy_id_proyecto')
            ->first();

        $reportesproyectos = DB::table('contabilidad')
            ->select(DB::raw('sum(contabilidad.cont_num_jobs) AS totaljobs, usua_id_usuario ,proy_id_proyecto, proy_nombre ,sum(contabilidad.cont_hrs_nodo) AS totalnodo,
            proy_hrs_aprobadas, CONCAT(FORMAT(IF(proy_hrs_aprobadas=0,0,(sum(contabilidad.cont_hrs_nodo)*100.0)/proy_hrs_aprobadas),2)) AS porcentajeproyecto'))
            ->join('usuario', 'contabilidad.cont_id_usuario', '=', 'usuario.usua_id_usuario')
            ->join('proyecto', 'usuario.usua_id_proyecto', '=', 'proyecto.proy_id_proyecto')
            ->where('proyecto.proy_id_proyecto','=',$id )
            ->where(DB::raw('MONTH(cont_fecha)'), '=', $mes)
            ->where(DB::raw('YEAR(cont_fecha)'), '=', $anio)
            ->groupBy('usuario.usua_id_usuario')
            ->get();


        return View::make('generarreportes/reporteproyectoespecifico')
                   ->with('reportesproyectos',$reportesproyectos)
                   ->with('reportesproyectodatos',$reportesproyectodatos)
                   ->with('mes',$mes)
                   ->with('anio',$anio);


    }



    public function generarReportePeriodoProyecto()
    {
        $mes =  Input::get('mes');
        $anio = Input::get('anio');

        $mes2 =  Input::get('mes2');
        $anio2 = Input::get('anio2');

        $reportesproyectos = DB::table('contabilidad')
            ->select(DB::raw('sum(contabilidad.cont_num_jobs) AS totaljobs, usua_id_usuario ,proy_id_proyecto, proy_nombre, sum(contabilidad.cont_hrs_nodo) AS totalnodo,
            proy_hrs_aprobadas, CONCAT(FORMAT(IF(proy_hrs_aprobadas=0,0,(sum(contabilidad.cont_hrs_nodo)*100.0)/proy_hrs_aprobadas),2)) AS porcentajeproyecto'))
            ->join('usuario', 'contabilidad.cont_id_usuario', '=', 'usuario.usua_id_usuario')
            ->join('proyecto', 'usuario.usua_id_proyecto', '=', 'proyecto.proy_id_proyecto')
            ->whereBetween(DB::raw('MONTH(cont_fecha)'),array( $mes, $mes2))
            ->whereBetween(DB::raw('YEAR(cont_fecha)'),array( $anio, $anio2))
            ->groupBy('usuario.usua_id_proyecto')
            ->get();

        $totalproyectos = DB::table('contabilidad')
            ->select(DB::raw('sum(contabilidad.cont_num_jobs) AS totaljobs, sum(contabilidad.cont_hrs_nodo) AS totalnodo'))
            ->whereBetween(DB::raw('MONTH(cont_fecha)'),array( $mes, $mes2))
            ->whereBetween(DB::raw('YEAR(cont_fecha)'),array( $anio, $anio2))
            ->first();


        return View::make('generarreportes/reporteperiodoproyectos')
            ->with('reportesproyectos',$reportesproyectos)
            ->with('mes',$mes)
            ->with('anio',$anio)
            ->with('mes2',$mes2)
            ->with('anio2',$anio2)
            ->with('totalproyectos',$totalproyectos);
    }
} 