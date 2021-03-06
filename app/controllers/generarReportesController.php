<?php
/**
 *
 * User: Omar
 * Date: 3/11/14
 * Time: 07:35 PM
 * Clase que implementa todos los métodos del caso de uso generar reportes
 */



class GenerarReportesController extends BaseController
{
    /**
    *Regresa la vista principal para de generar reportes
    * return @mixed
    */
    public function mostrarGenerarReporteMensualProyecto()
    {
        return View::make('generarreportes/contabilidadmensualproyectos');
    }
    /**
     *Regresa la vista principal para de generar reportes por periodo
     *
     * return @mixed
     */
    public function mostrarGenerarReportePeriodoProyecto()
    {
        return View::make('generarreportes/contabilidadporperiodoproyectos');
    }
    /**
    *Obtiene la contabilidad de los recursos utilizados en un periodo mensual determinado
    *
    *Input:
     * $mes @integer: número del mes
     * $anio @integer: año
    * Output:
    * $reportesproyectos @object contiene un conjunto de proyectos y los datos de la contabilidad como numero de jobs y numero de horas CPU
    * $totalproyectos @object contiene cálculo total de los recursos utilizados por los proyectos activos
    *
    */
    public function generarReporteMensualProyecto()
    {
        $mes =  Input::get('mes');
        $anio = Input::get('anio');
        $reportesproyectos = DB::table('contabilidad')
            ->select(DB::raw('sum(contabilidad.cont_num_jobs) AS totaljobs, usua_id_usuario ,proy_id_proyecto, proy_nombre, sum(contabilidad.cont_hrs_nodo) AS totalnodo,
            proy_hrs_aprobadas, CONCAT(FORMAT(IF(proy_hrs_aprobadas=0,0,(sum(contabilidad.cont_hrs_nodo)*100.0)/proy_hrs_aprobadas),2)) AS porcentajeproyecto'))
            ->join('usuario', 'contabilidad.cont_id_usuario', '=', 'usuario.usua_id_usuario')
            ->join('usuario_x_proyecto', 'usuario.usua_id_usuario', '=', 'usuario_x_proyecto.uspr_id_usuario')
            ->join('proyecto', 'usuario_x_proyecto.uspr_id_proyecto', '=', 'proyecto.proy_id_proyecto')
            ->where(DB::raw('MONTH(cont_fecha)'), '=', $mes)
            ->where(DB::raw('YEAR(cont_fecha)'), '=', $anio)
            ->groupBy('proyecto.proy_id_proyecto')
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

    /**
     *Muestra una vista con el desglose de la contabilidad de un proyecto específico
     * Parámetros:
     * @param $id
     * @param $mes
     * @param $anio
     * @return
     * @internal param $ @int
     *
     *Output:
     * $reportesproyectodatos @object contiene los datos de los recursos de un proyecto en específico
     * $reportesproyectos @object contiene los datos de los recursos del uso de todas las cuentas relacionadas a un proyecto
     */
    public function mostrarReporteProyectoEspecifico($id,$mes,$anio)
    {

        $reportesproyectodatos = DB::table('contabilidad')
            ->select(DB::raw('sum(contabilidad.cont_num_jobs) AS totaljobs, usua_id_usuario ,proy_id_proyecto,depe_nombre,soab_nombres,soab_ap_paterno, soab_ap_materno,
             proy_nombre, proy_hrs_aprobadas, sum(contabilidad.cont_hrs_nodo) AS totalnodo,
            proy_hrs_aprobadas, CONCAT(FORMAT(IF(proy_hrs_aprobadas=0,0,(sum(contabilidad.cont_hrs_nodo)*100.0)/proy_hrs_aprobadas),2)) AS porcentajeproyecto'))
            ->join('usuario', 'contabilidad.cont_id_usuario', '=', 'usuario.usua_id_usuario')
            ->join('usuario_x_proyecto', 'usuario.usua_id_usuario', '=', 'usuario_x_proyecto.uspr_id_usuario')
            ->join('proyecto', 'usuario_x_proyecto.uspr_id_proyecto', '=', 'proyecto.proy_id_proyecto')
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
            ->join('usuario_x_proyecto', 'usuario.usua_id_usuario', '=', 'usuario_x_proyecto.uspr_id_usuario')
            ->join('proyecto', 'usuario_x_proyecto.uspr_id_proyecto', '=', 'proyecto.proy_id_proyecto')
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


    /**
    * Obtiene la contabilidad de los recursos utilizados en un periodo mensual determinado
    *
    *Input:
    * $mes @integer es el mes
    * $anio @integer es el año
    * Output:
    * $reportesproyectodatos @object conjunto de proyectos que contienen los datos de un periodo de tiempo especifico
    * $reportesproyectos @object contiene cálculo total de los recursos utilizados por los proyectos activos
    */
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
            ->join('usuario_x_proyecto', 'usuario.usua_id_usuario', '=', 'usuario_x_proyecto.uspr_id_usuario')
            ->join('proyecto', 'usuario_x_proyecto.uspr_id_proyecto', '=', 'proyecto.proy_id_proyecto')
            ->whereBetween(DB::raw('MONTH(cont_fecha)'),array( $mes, $mes2))
            ->whereBetween(DB::raw('YEAR(cont_fecha)'),array( $anio, $anio2))
            ->groupBy('proyecto.proy_id_proyecto')
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

    /**
     *Muestra una vista con el desglose de la contabilidad de un proyecto específico
     * Parámetros:
     * @param $id
     * @param $mes
     * @param $anio
     * @param $mes2
     * @param $anio2
     * @return mixed
    @internal param $ @int
     *
     *Output:
     * $reportesproyectodatos @object contiene los datos de los recursos de un proyecto en específico
     * $reportesproyectos @object contiene los datos de los recursos del uso de todas las cuentas relacionadas a un proyecto
     */
    public function mostrarReportePorPeriodoProyectoEspecifico($id,$mes,$anio,$mes2,$anio2)
    {
        $reportesproyectodatos = DB::table('contabilidad')
            ->select(DB::raw('sum(contabilidad.cont_num_jobs) AS totaljobs, usua_id_usuario ,proy_id_proyecto,depe_nombre,soab_nombres,soab_ap_paterno, soab_ap_materno,
                              proy_nombre, proy_hrs_aprobadas, sum(contabilidad.cont_hrs_nodo) AS totalnodo,
                              proy_hrs_aprobadas, CONCAT(FORMAT(IF(proy_hrs_aprobadas=0,0,(sum(contabilidad.cont_hrs_nodo)*100.0)/proy_hrs_aprobadas),2)) AS porcentajeproyecto'))
            ->join('usuario', 'contabilidad.cont_id_usuario', '=', 'usuario.usua_id_usuario')
            ->join('usuario_x_proyecto', 'usuario.usua_id_usuario', '=', 'usuario_x_proyecto.uspr_id_usuario')
            ->join('proyecto', 'usuario_x_proyecto.uspr_id_proyecto', '=', 'proyecto.proy_id_proyecto')
            ->join('solicitud_abstracta', 'proyecto.proy_id_solicitud_abstracta', '=', 'solicitud_abstracta.soab_id_solicitud_abstracta')
            ->join('dependencia', 'solicitud_abstracta.soab_id_dependencia', '=', 'dependencia.depe_id_dependencia')
            ->where('proyecto.proy_id_proyecto','=',$id )
            ->whereBetween(DB::raw('MONTH(cont_fecha)'),array( $mes, $mes2))
            ->whereBetween(DB::raw('YEAR(cont_fecha)'),array( $anio, $anio2))
            ->groupBy('proyecto.proy_id_proyecto')
            ->first();

        $reportesproyectos = DB::table('contabilidad')
            ->select(DB::raw('sum(contabilidad.cont_num_jobs) AS totaljobs, usua_id_usuario ,proy_id_proyecto, proy_nombre ,sum(contabilidad.cont_hrs_nodo) AS totalnodo,
            proy_hrs_aprobadas, CONCAT(FORMAT(IF(proy_hrs_aprobadas=0,0,(sum(contabilidad.cont_hrs_nodo)*100.0)/proy_hrs_aprobadas),2)) AS porcentajeproyecto'))
            ->join('usuario', 'contabilidad.cont_id_usuario', '=', 'usuario.usua_id_usuario')
            ->join('usuario_x_proyecto', 'usuario.usua_id_usuario', '=', 'usuario_x_proyecto.uspr_id_usuario')
            ->join('proyecto', 'usuario_x_proyecto.uspr_id_proyecto', '=', 'proyecto.proy_id_proyecto')
            ->where('proyecto.proy_id_proyecto','=',$id )
            ->whereBetween(DB::raw('MONTH(cont_fecha)'),array( $mes, $mes2))
            ->whereBetween(DB::raw('YEAR(cont_fecha)'),array( $anio, $anio2))
            ->groupBy('usuario.usua_id_usuario')
            ->get();


        return View::make('generarreportes/reporteproyectoperiodoespecifico')
            ->with('reportesproyectos',$reportesproyectos)
            ->with('reportesproyectodatos',$reportesproyectodatos)
            ->with('mes',$mes)
            ->with('anio',$anio);

    }
    /**
     * Regresa la vista principal para de generar reportes mensuales por dependencia
     * return @mixed
     */
    public function mostrarGenerarReporteMensualDependencia()
    {
        return View::make('generarreportes/contabilidadmensualdependencias');
    }
    /**
     * Regresa la vista principal para de generar reportes por periodo de tiempo por dependencia
     * return @mixed
     */
    public function mostrarGenerarReportePeriodoDependencia()
    {
        return View::make('generarreportes/contabilidadporperiododependencias');
    }
    /**
    * Obtiene el total de recursos utilizados mensualmente por dependencia
    *
    *Input:
    * $mes @int es el mes
    * $anio @int es el anio
    *
    * Output:
    * $reportesdependencias @object contiene la contabilidad total de cada dependencia
    *
    */
    public function generarReporteMensualDependencia()
    {
        $mes =  Input::get('mes');
        $anio = Input::get('anio');
        $reportesdependencias = DB::table('contabilidad')
            ->select(DB::raw('sum(contabilidad.cont_num_jobs) AS totaljobs,depe_nombre,sum(contabilidad.cont_hrs_nodo) AS totalnodo
            ,CONCAT(FORMAT(IF(proy_hrs_aprobadas=0,0,(sum(contabilidad.cont_hrs_nodo)*100.0)/proy_hrs_aprobadas),2)) AS porcentajeproyecto,
            depe_id_tipo_dependencia,depe_acronimo,depe_id_dependencia'))
            ->join('usuario', 'contabilidad.cont_id_usuario', '=', 'usuario.usua_id_usuario')
            ->join('usuario_x_proyecto', 'usuario.usua_id_usuario', '=', 'usuario_x_proyecto.uspr_id_usuario')
            ->join('proyecto', 'usuario_x_proyecto.uspr_id_proyecto', '=', 'proyecto.proy_id_proyecto')
            ->join('solicitud_abstracta', 'proyecto.proy_id_solicitud_abstracta', '=', 'solicitud_abstracta.soab_id_solicitud_abstracta')
            ->join('dependencia', 'solicitud_abstracta.soab_id_dependencia', '=', 'dependencia.depe_id_dependencia')
            ->where(DB::raw('MONTH(cont_fecha)'), '=', $mes)
            ->where(DB::raw('YEAR(cont_fecha)'), '=', $anio)
            ->groupBy('dependencia.depe_id_dependencia')
            ->get();


        return View::make('generarreportes/reportemensualdependencias')
                   ->with('reportesdependencias',$reportesdependencias)
                   ->with('mes',$mes)
                   ->with('anio',$anio);
    }

    /**
     * Obtiene el total de recursos utilizados en un periodo de tiempo por dependencia
     *
     *Input:
     * $mes @int mes inicial
     * $anio @int año inicial
     * $mes2 @int
     * $anio2 @int
     *
     * Output:
     * $reportesdependencias @object contiene la contabilidad total de cada dependencia en un periodo de tiempo determinado
     *
     */
    public function generarReportePeriodoDependencia()
    {
        $mes =  Input::get('mes');
        $anio = Input::get('anio');

        $mes2 =  Input::get('mes2');
        $anio2 = Input::get('anio2');

        $reportesdependencias = DB::table('contabilidad')
            ->select(DB::raw('sum(contabilidad.cont_num_jobs) AS totaljobs,depe_nombre,sum(contabilidad.cont_hrs_nodo) AS totalnodo
            ,CONCAT(FORMAT(IF(proy_hrs_aprobadas=0,0,(sum(contabilidad.cont_hrs_nodo)*100.0)/proy_hrs_aprobadas),2)) AS porcentajeproyecto,
            depe_id_tipo_dependencia,depe_acronimo,depe_id_dependencia'))
            ->join('usuario', 'contabilidad.cont_id_usuario', '=', 'usuario.usua_id_usuario')
            ->join('usuario_x_proyecto', 'usuario.usua_id_usuario', '=', 'usuario_x_proyecto.uspr_id_usuario')
            ->join('proyecto', 'usuario_x_proyecto.uspr_id_proyecto', '=', 'proyecto.proy_id_proyecto')
            ->join('solicitud_abstracta', 'proyecto.proy_id_solicitud_abstracta', '=', 'solicitud_abstracta.soab_id_solicitud_abstracta')
            ->join('dependencia', 'solicitud_abstracta.soab_id_dependencia', '=', 'dependencia.depe_id_dependencia')
            ->whereBetween(DB::raw('MONTH(cont_fecha)'),array( $mes, $mes2))
            ->whereBetween(DB::raw('YEAR(cont_fecha)'),array( $anio, $anio2))
            ->groupBy('dependencia.depe_id_dependencia')
            ->get();


        return View::make('generarreportes/reporteperiododependencias')
            ->with('reportesdependencias',$reportesdependencias)
            ->with('mes',$mes)
            ->with('anio',$anio)
            ->with('mes2',$mes2)
            ->with('anio2',$anio2);
    }

//Funcion pendiente de implementar
    public function generarPdfMensualPorProyectos($mes,$anio)
    {

        $reportesproyectos = DB::table('contabilidad')
            ->select(DB::raw('sum(contabilidad.cont_num_jobs) AS totaljobs, usua_id_usuario ,proy_id_proyecto, proy_nombre, sum(contabilidad.cont_hrs_nodo) AS totalnodo,
            proy_hrs_aprobadas, CONCAT(FORMAT(IF(proy_hrs_aprobadas=0,0,(sum(contabilidad.cont_hrs_nodo)*100.0)/proy_hrs_aprobadas),2)) AS porcentajeproyecto'))
            ->join('usuario', 'contabilidad.cont_id_usuario', '=', 'usuario.usua_id_usuario')
            ->join('proyecto', 'usuario.usua_id_proyecto', '=', 'proyecto.proy_id_proyecto')
            ->where(DB::raw('MONTH(cont_fecha)'), '=', $mes)
            ->where(DB::raw('YEAR(cont_fecha)'), '=', $anio)
            ->groupBy('proyecto.proy_id_proyecto')
            ->get();

        $totalproyectos = DB::table('contabilidad')
            ->select(DB::raw('sum(contabilidad.cont_num_jobs) AS totaljobs, sum(contabilidad.cont_hrs_nodo) AS totalnodo'))
            ->where(DB::raw('MONTH(cont_fecha)'), '=', $mes)
            ->where(DB::raw('YEAR(cont_fecha)'), '=', $anio)
            ->first();

        $html = View::make('generarreportes.reportes.layoutreportemensualporproyectos')
            ->with('reportesproyectos', $reportesproyectos)
            ->with('totalproyectos',$totalproyectos)
            ->with('mes',$mes)
            ->with('anio',$anio)
            ->render();

        return PDF::load($html, 'A4', 'portrait')->show();
    }

}