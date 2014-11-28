<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 4/11/14
 * Time: 05:54 PM
 */

class ConsultarRecursosDisponiblesController extends BaseController {

    public function recursosDisponiblesProyectos()
    {
        return View::make('consultarrecursosdisponibles/recursosdisponiblesproyectos');
    }

    public function mostrarRecursosDisponiblesProyectos()
    {

        $porcentaje = Input::get('porcentaje');
        //si es menor a 50
        if($porcentaje == 1)
        {
            $recursosdisponiblesproyectos = $this->obtenerRecursosDisponiblesProyectos();
            return View::make('consultarrecursosdisponibles/mostrarrecursosdisponiblesproyectos')
                        ->with('recursosdisponiblesproyectos',$recursosdisponiblesproyectos);

        }elseif($porcentaje == 2 ){//si es mayor o igual que 50 y menor o igual a 80
            $recursosdisponiblesproyectos = $this->obtenerRecursosDisponiblesProyectos();
            return View::make('consultarrecursosdisponibles/mostrarrecursosdisponiblesproyectoscincuenta')
                ->with('recursosdisponiblesproyectos',$recursosdisponiblesproyectos);
        }elseif($porcentaje  == 3)//si es mayor que 85
        {
            $recursosdisponiblesproyectos = $this->obtenerRecursosDisponiblesProyectos();
            return View::make('consultarrecursosdisponibles/mostrarrecursosdisponiblesproyectosochentaycinco')
                ->with('recursosdisponiblesproyectos',$recursosdisponiblesproyectos);
        }
    }

    public function obtenerRecursosDisponiblesProyectos()
    {
        $reportesproyectos = DB::table('contabilidad')
            ->select(DB::raw('sum(contabilidad.cont_num_jobs) AS totaljobs, usua_id_usuario ,proy_id_proyecto, proy_nombre, sum(contabilidad.cont_hrs_nodo) AS totalnodo,
            proy_hrs_aprobadas, CONCAT(FORMAT(IF(proy_hrs_aprobadas=0,0,(sum(contabilidad.cont_hrs_nodo)*100.0)/proy_hrs_aprobadas),2)) AS porcentajeproyecto,
            soab_nombres, soab_ap_paterno, soab_ap_materno, depe_nombre, proy_fec_term_recu'))
            ->join('usuario', 'contabilidad.cont_id_usuario', '=', 'usuario.usua_id_usuario')
            ->join('usuario_x_proyecto', 'usuario.usua_id_usuario', '=', 'usuario_x_proyecto.uspr_id_usuario')
            ->join('proyecto', 'usuario_x_proyecto.uspr_id_proyecto', '=', 'proyecto.proy_id_proyecto')
            ->join('solicitud_abstracta', 'proyecto.proy_id_solicitud_abstracta', '=', 'solicitud_abstracta.soab_id_solicitud_abstracta')
            ->join('dependencia', 'solicitud_abstracta.soab_id_dependencia', '=', 'dependencia.depe_id_dependencia')
            ->where('proyecto.proy_id_estado_proyecto', '=', 1)
            ->groupBy('proyecto.proy_id_proyecto')
            ->get();

        return $reportesproyectos;
    }

    public function mostrarConsumoRecursosMiztli()
    {

        $anio = date("Y");
        $mes = date("m");

        $reportesproyectos = DB::table('contabilidad')
            ->select(DB::raw('sum(contabilidad.cont_num_jobs) AS totaljobs, usua_id_usuario ,proy_id_proyecto, proy_nombre, sum(contabilidad.cont_hrs_nodo) AS totalnodo,
            proy_hrs_aprobadas, CONCAT(FORMAT(IF(proy_hrs_aprobadas=0,0,(sum(contabilidad.cont_hrs_nodo)*100.0)/proy_hrs_aprobadas),2)) AS porcentajeproyecto,
            soab_nombres, soab_ap_paterno, soab_ap_materno, depe_nombre, proy_fec_term_recu'))
            ->join('usuario', 'contabilidad.cont_id_usuario', '=', 'usuario.usua_id_usuario')
            ->join('usuario_x_proyecto', 'usuario.usua_id_usuario', '=', 'usuario_x_proyecto.uspr_id_usuario')
            ->join('proyecto', 'usuario_x_proyecto.uspr_id_proyecto', '=', 'proyecto.proy_id_proyecto')
            ->join('solicitud_abstracta', 'proyecto.proy_id_solicitud_abstracta', '=', 'solicitud_abstracta.soab_id_solicitud_abstracta')
            ->join('dependencia', 'solicitud_abstracta.soab_id_dependencia', '=', 'dependencia.depe_id_dependencia')
            ->where('proyecto.proy_id_estado_proyecto', '=', 1)
            ->where(DB::raw('MONTH(cont_fecha)'), '=', $mes)
            ->where(DB::raw('YEAR(cont_fecha)'), '=', $anio)
            ->groupBy('proyecto.proy_id_proyecto')
            ->get();


        return View::make('consultarrecursosdisponibles/consumorecursosmiztli')->with('reportesproyectos',$reportesproyectos);
    }

    public function mostrarConsumoRecursosMiztliPorPeriodo()
    {

        $mes =  Input::get('mes');
        $anio = Input::get('anio');

        $mes2 =  Input::get('mes2');
        $anio2 = Input::get('anio2');

        $reportesproyectos = DB::table('contabilidad')
            ->select(DB::raw('sum(contabilidad.cont_num_jobs) AS totaljobs, usua_id_usuario ,proy_id_proyecto, proy_nombre, sum(contabilidad.cont_hrs_nodo) AS totalnodo,
            proy_hrs_aprobadas, CONCAT(FORMAT(IF(proy_hrs_aprobadas=0,0,(sum(contabilidad.cont_hrs_nodo)*100.0)/proy_hrs_aprobadas),2)) AS porcentajeproyecto,
            soab_nombres, soab_ap_paterno, soab_ap_materno, depe_nombre, proy_fec_term_recu'))
            ->join('usuario', 'contabilidad.cont_id_usuario', '=', 'usuario.usua_id_usuario')
            ->join('usuario_x_proyecto', 'usuario.usua_id_usuario', '=', 'usuario_x_proyecto.uspr_id_usuario')
            ->join('proyecto', 'usuario_x_proyecto.uspr_id_proyecto', '=', 'proyecto.proy_id_proyecto')
            ->join('solicitud_abstracta', 'proyecto.proy_id_solicitud_abstracta', '=', 'solicitud_abstracta.soab_id_solicitud_abstracta')
            ->join('dependencia', 'solicitud_abstracta.soab_id_dependencia', '=', 'dependencia.depe_id_dependencia')
            ->where('proyecto.proy_id_estado_proyecto', '=', 1)
            ->whereBetween(DB::raw('MONTH(cont_fecha)'),array( $mes, $mes2))
            ->whereBetween(DB::raw('YEAR(cont_fecha)'),array( $anio, $anio2))
            ->groupBy('proyecto.proy_id_proyecto')
            ->get();
        //var_dump($reportesproyectos);

        return View::make('consultarrecursosdisponibles/consumorecursosmiztli')->with('reportesproyectos',$reportesproyectos)->withInput(Input::all());
    }


    public function mostrarRecursosDisponiblesUsuarioTitular(){


        $usuario = Auth::user()->USUA_ID_USUARIO;
        $proyectoid = Usuario::find($usuario)->proyectos()->first();
        $proyectoid = $proyectoid->PROY_ID_PROYECTO;
        var_dump($proyectoid);
        $reportesproyectosdatos = DB::table('contabilidad')
            ->select(DB::raw('sum(contabilidad.cont_num_jobs) AS totaljobs, usua_id_usuario ,proy_id_proyecto, proy_nombre, sum(contabilidad.cont_hrs_nodo) AS totalnodo,
            proy_hrs_aprobadas, CONCAT(FORMAT(IF(proy_hrs_aprobadas=0,0,(sum(contabilidad.cont_hrs_nodo)*100.0)/proy_hrs_aprobadas),2)) AS porcentajeproyecto,
            soab_nombres, soab_ap_paterno, soab_ap_materno, depe_nombre, proy_fec_term_recu'))
            ->join('usuario', 'contabilidad.cont_id_usuario', '=', 'usuario.usua_id_usuario')
            ->join('usuario_x_proyecto', 'usuario.usua_id_usuario', '=', 'usuario_x_proyecto.uspr_id_usuario')
            ->join('proyecto', 'usuario_x_proyecto.uspr_id_proyecto', '=', 'proyecto.proy_id_proyecto')
            ->join('solicitud_abstracta', 'proyecto.proy_id_solicitud_abstracta', '=', 'solicitud_abstracta.soab_id_solicitud_abstracta')
            ->join('dependencia', 'solicitud_abstracta.soab_id_dependencia', '=', 'dependencia.depe_id_dependencia')
            ->where('proyecto.proy_id_proyecto', '=',$proyectoid )
            ->groupBy('proyecto.proy_id_proyecto')
            ->first();

            return View::make('usuariocuentatitular/consultarrecursosdisponibles/consultarrecursosdisponiblesusuariotitular')->with('reportesproyectodatos',$reportesproyectosdatos);




    }

}