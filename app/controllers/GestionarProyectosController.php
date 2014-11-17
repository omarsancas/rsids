<?php

/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 4/11/14
 * Time: 09:46 PM
 */
class GestionarProyectosController extends BaseController {

    public function mostrarConsultarProyectos()
    {
        return View::make('gestionarproyectos/consultarproyectosvista');
    }

    public function consultarProyectos()
    {
        $usuarios = $this->obtenerProyectos();

        return View::make('gestionarproyectos/consultarproyecto')
            ->with('proyectos', $usuarios);
    }

    public function consultarProyectoEspecifico($id)
    {

        $reportesproyectodatos = DB::table('contabilidad')
            ->select(DB::raw('sum(contabilidad.cont_num_jobs) AS totaljobs, usua_id_usuario ,proy_id_proyecto,soab_nombres,soab_ap_paterno, soab_ap_materno,
             proy_nombre, proy_hrs_aprobadas, proy_fec_ini_recu, sum(contabilidad.cont_hrs_nodo) AS totalnodo, proy_hrs_aprobadas,espr_tipo_estado,
             CONCAT(FORMAT(IF(proy_hrs_aprobadas=0,0,(sum(contabilidad.cont_hrs_nodo)*100.0)/proy_hrs_aprobadas),2)) AS porcentajeproyecto'))
            ->join('usuario', 'contabilidad.cont_id_usuario', '=', 'usuario.usua_id_usuario')
            ->join('usuario_x_proyecto', 'usuario.usua_id_usuario', '=', 'usuario_x_proyecto.uspr_id_usuario')
            ->join('proyecto', 'usuario_x_proyecto.uspr_id_proyecto', '=', 'proyecto.proy_id_proyecto')
            ->join('estado_proyecto', 'proyecto.proy_id_estado_proyecto', '=', 'estado_proyecto.espr_id_estado_proyecto')
            ->join('solicitud_abstracta', 'proyecto.proy_id_solicitud_abstracta', '=', 'solicitud_abstracta.soab_id_solicitud_abstracta')
            ->join('dependencia', 'solicitud_abstracta.soab_id_dependencia', '=', 'dependencia.depe_id_dependencia')
            ->where('proyecto.proy_id_proyecto', '=', $id)
            ->groupBy('proyecto.proy_id_proyecto')
            ->first();

        $reportesproyectos = DB::table('contabilidad')
            ->select(DB::raw('sum(contabilidad.cont_num_jobs) AS totaljobs, usua_id_usuario ,proy_id_proyecto, proy_nombre ,sum(contabilidad.cont_hrs_nodo) AS totalnodo,
            proy_hrs_aprobadas, CONCAT(FORMAT(IF(proy_hrs_aprobadas=0,0,(sum(contabilidad.cont_hrs_nodo)*100.0)/proy_hrs_aprobadas),2)) AS porcentajeproyecto'))
            ->join('usuario', 'contabilidad.cont_id_usuario', '=', 'usuario.usua_id_usuario')
            ->join('usuario_x_proyecto', 'usuario.usua_id_usuario', '=', 'usuario_x_proyecto.uspr_id_usuario')
            ->join('proyecto', 'usuario_x_proyecto.uspr_id_proyecto', '=', 'proyecto.proy_id_proyecto')
            ->where('proyecto.proy_id_proyecto', '=', $id)
            ->groupBy('usuario.usua_id_usuario')
            ->get();


        return View::make('gestionarproyectos/consultarproyectoespecifico')
            ->with('reportesproyectos', $reportesproyectos)
            ->with('reportesproyectodatos', $reportesproyectodatos);


    }

    public function mostrarModificarProyectos()
    {
        return View::make('gestionarproyectos/modificarproyectosvista');
    }


    public function modificarProyectos()
    {
        $usuarios = $this->obtenerProyectos();


        return View::make('gestionarproyectos/modificarproyecto')
            ->with('proyectos', $usuarios);
    }

    public function modificarProyectoEspecifico($id)
    {
        $proyecto = Proyecto::findOrFail($id);

        return View::make('gestionarproyectos/modificarproyectoespecifico')->with('proyecto', $proyecto);
    }

    public function modificarGuardarProyectoEspecifico()
    {
        $id = Input::get('id');
        $proyecto = Proyecto::find($id);
        $proyecto->proy_nombre = Input::get('nombreproyecto');
        $proyecto->proy_fec_ini_recu = Input::get('fechaini');
        $proyecto->proy_fec_term_recu = Input::get('fechaterm');
        $proyecto->proy_fecha_registro = Input::get('fechaterm');
        $proyecto->save();


        Session::flash('message', '¡El proyecto se ha modificado exitosamente!');


        return Redirect::to('gestionarproyectos/modificarproyectosvista');
    }


    public function mostrarCambiarEstadoProyectos()
    {
        return View::make('gestionarproyectos/cambiarestadoproyectovista');
    }


    public function cambiarEstadoProyectos()
    {
        $usuarios = $this->obtenerProyectos();

        return View::make('gestionarproyectos/cambiarestadoproyecto')
            ->with('proyectos', $usuarios);
    }

    public function cambiarEstadoProyectoEspecifico($id)
    {
        $proyecto = Proyecto::findOrFail($id);
        $estadoproyecto = EstadoProyecto::lists('espr_tipo_estado', 'espr_id_estado_proyecto');

        return View::make('gestionarproyectos/cambiarestadoproyectoespecifico')->with('proyecto', $proyecto)->with('estadoproyecto', $estadoproyecto);
    }

    public function guardarCambiarEstadoProyectoEspecifico()
    {
        $id = Input::get('id');
        $proyecto = Proyecto::find($id);
        $proyecto->proy_id_estado_proyecto = Input::get('estadoproyecto');
        $proyecto->save();
        Session::flash('message', '¡El proyecto se ha modificado exitosamente!');

        return Redirect::to('gestionarproyectos/cambiarestadoproyectovista');
    }

    public function mostrarBuscarUsuarios()
    {
        return View::make('gestionarproyectos/buscarusuariosvista');
    }


    public function buscarUsuarios()
    {
        $querynombre = Input::get('q');
        $queryusuariotipo = Input::get('tipousuario');

        if ($queryusuariotipo == 2)
        {
            $usuarios = $this->obtenerCuentasTitulares($querynombre);

            return View::make('gestionarproyectos/buscarusuarios')->with('usuarios',$usuarios);

        } elseif ($queryusuariotipo == 3)
        {
            $usuarios = DB::table('usuario')
                ->join('usuario_x_proyecto', 'usuario.usua_id_usuario', '=', 'usuario_x_proyecto.uspr_id_usuario')
                ->join('proyecto', 'usuario_x_proyecto.uspr_id_proyecto', '=', 'proyecto.proy_id_proyecto')
                ->join('tipo_usuario','usuario.usua_id_tipo_usuario','=','tipo_usuario.tius_id_tipo_usuario')
                ->where('usua_nom_completo','LIKE',"%$querynombre%")
                ->where('usua_id_tipo_usuario', '=', 3)
                ->get();

            return View::make('gestionarproyectos/buscarusuarios')->with('usuarios',$usuarios);

        } elseif ($queryusuariotipo == 4)
        {
            $usuarios = DB::table('usuario')
                ->join('usuario_x_proyecto', 'usuario.usua_id_usuario', '=', 'usuario_x_proyecto.uspr_id_usuario')
                ->join('proyecto', 'usuario_x_proyecto.uspr_id_proyecto', '=', 'proyecto.proy_id_proyecto')
                ->join('tipo_usuario', 'usuario.usua_id_tipo_usuario', '=', 'tipo_usuario.tius_id_tipo_usuario')
                ->where('usua_nom_completo', 'LIKE', "%$querynombre%")
                ->get();


            return View::make('gestionarproyectos/buscarusuarios')->with('usuarios',$usuarios);
        }


    }

    public function mostrarUsuarioConProyecto($idproyecto, $idusuario)
    {
        $usuarioproyecto = DB::table('contabilidad')
            ->select(DB::raw('sum(contabilidad.cont_num_jobs) AS totaljobs, usua_id_usuario ,usua_nom_completo,proy_id_proyecto, proy_nombre, sum(contabilidad.cont_hrs_nodo) AS totalnodo,
            proy_hrs_aprobadas, CONCAT(FORMAT(IF(proy_hrs_aprobadas=0,0,(sum(contabilidad.cont_hrs_nodo)*100.0)/proy_hrs_aprobadas),2)) AS porcentajeproyecto'))
            ->join('usuario', 'contabilidad.cont_id_usuario', '=', 'usuario.usua_id_usuario')
            ->join('usuario_x_proyecto', 'usuario.usua_id_usuario', '=', 'usuario_x_proyecto.uspr_id_usuario')
            ->join('proyecto', 'usuario_x_proyecto.uspr_id_proyecto', '=', 'proyecto.proy_id_proyecto')
            ->where('proyecto.proy_id_proyecto' ,'=',$idproyecto)
            ->where('usuario.usua_id_usuario' ,'=',$idusuario)
            ->groupBy('usuario.usua_id_usuario')
            ->first();

            return View::make('gestionarproyectos/mostrarusuarioconproyecto')->with('usuarioproyecto',$usuarioproyecto);
    }



    /**
     * @return mixed
     */
    public function obtenerProyectos()
    {
        $querynombre = Input::get('q');
        $queryestado = Input::get('estado');


        $usuarios = Proyecto::where('proy_nombre', 'LIKE', "%$querynombre%")
            ->where('proy_id_estado_proyecto', '=', $queryestado)
            ->groupBy('proy_id_proyecto')
            ->get();

        return $usuarios;
    }


}