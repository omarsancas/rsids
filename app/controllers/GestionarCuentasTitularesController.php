<?php

/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 5/11/14
 * Time: 10:49 PM
 */
class GestionarCuentasTitularesController extends BaseController {

    public function mostrarModificarCuentaTitular()
    {
        return View::make('gestionarcuentastitulares/modificarcuentatitularvista');
    }

    public function modificarCuentaTitular()
    {
        $querynombre = Input::get('nombreusuario');

        $usuarios = $this->obtenerCuentasTitulares($querynombre);

        return View::make('gestionarcuentastitulares/modificarcuentatitular')->with('usuarios', $usuarios);
    }

    public function modificarCuentaTitularEspecifica($id, $id_usuario)
    {

        $dependencias_catalogo = Dependencia::lists('depe_nombre', 'depe_id_dependencia');
        $grado = Grado::lists('grad_nombre', 'grad_id_grado');

        $datoscuentatitular = DB::table('usuario')
            ->join('usuario_x_proyecto', 'usuario.usua_id_usuario', '=', 'usuario_x_proyecto.uspr_id_usuario')
            ->join('proyecto', 'usuario_x_proyecto.uspr_id_proyecto', '=', 'proyecto.proy_id_proyecto')
            ->join('tipo_usuario', 'usuario.usua_id_tipo_usuario', '=', 'tipo_usuario.tius_id_tipo_usuario')
            ->join('solicitud_abstracta', 'proyecto.proy_id_solicitud_abstracta', '=', 'solicitud_abstracta.soab_id_solicitud_abstracta')
            ->join('medio_comunicacion', 'solicitud_abstracta.soab_id_medio_comunicacion', '=', 'medio_comunicacion.meco_id_medio_comunicacion')
            ->where('proy_id_proyecto', '=', $id)
            ->groupBy('proy_id_proyecto')
            ->first();

        return View::make('gestionarcuentastitulares/modificarguardarcuentatitular')
            ->with('datoscuentatitular', $datoscuentatitular)
            ->with('grado', $grado)
            ->with('dependencias_catalogo', $dependencias_catalogo)
            ->with('id_usuario',$id_usuario);
    }

    public function modificarGuardarCuentaTitularEspecifica()
    {
        $id = Input::get('id');
        $solicitudabstracta = SolicitudAbstracta::find($id);
        $solicitudabstracta->soab_nombres = Input::get('nombre');
        $solicitudabstracta->soab_ap_paterno = Input::get('apellidoPaterno');
        $solicitudabstracta->soab_ap_materno = Input::get('apellidoMaterno');
        $solicitudabstracta->soab_sexo = Input::get('sexo');
        $solicitudabstracta->SOAB_ID_DEPENDENCIA = Input::get('dependencias');
        $solicitudabstracta->soab_id_grado = Input::get('grado');
        $solicitudabstracta->save();

        $idmeco = $solicitudabstracta->SOAB_ID_MEDIO_COMUNICACION;
        $mediocomunicacion = MedioComunicacion::find($idmeco);
        $mediocomunicacion->meco_telefono1 = Input::get('telefono');
        $mediocomunicacion->meco_extension = Input::get('extension');
        $mediocomunicacion->meco_telefono2 = Input::get('telefono2');
        $mediocomunicacion->meco_correo = Input::get('email');
        $mediocomunicacion->save();

        if (Input::hasFile('curriculum'))
        {
            $archivo = $solicitudabstracta->SOAB_CURRICULUM;
            File::delete($archivo);
            $destinationPath = $solicitudabstracta->soab_ruta_archivos;
            /** @var $filename1 TYPE_NAME */
            $filename1 = $solicitudabstracta->SOAB_ID_SOLICITUD_ABSTRACTA . '_' . 'CV' . '.' . Input::file('curriculum')->getClientOriginalExtension();
            $upload_success1 = Input::file('curriculum')->move($destinationPath, $filename1);
            if ($upload_success1)
            {
                $solicitudabstracta->soab_curriculum = $destinationPath . '/' . $filename1;
                $solicitudabstracta->save();
            }
        }


        if (Input::hasFile('docdesc'))
        {
            $archivo = $solicitudabstracta->SOAB_DESC_PROYECTO;
            File::delete($archivo);
            $destinationPath = $solicitudabstracta->soab_ruta_archivos;
            /** @var $filename1 TYPE_NAME */
            $filename2 = $solicitudabstracta->SOAB_ID_SOLICITUD_ABSTRACTA . '_' . 'DOCDESC' . '.' . Input::file('documentodescriptivo')->getClientOriginalExtension();
            $upload_success2 = Input::file('documentodescriptivo')->move($destinationPath, $filename2);
            if ($upload_success2)
            {
                $solicitudabstracta->soab_desc_proyecto = $destinationPath . '/' . $filename2;
                $solicitudabstracta->save();
            }
        }


        if (Input::hasFile('constancias'))
        {
            $archivo = $solicitudabstracta->SOAB_CON_ADSCRIPCION;
            File::delete($archivo);
            $destinationPath = $solicitudabstracta->soab_ruta_archivos;
            /** @var $filename1 TYPE_NAME */
            $filename3 = $solicitudabstracta->SOAB_ID_SOLICITUD_ABSTRACTA . '_' . 'CONSTANCIA' . '.' . Input::file('constancias')->getClientOriginalExtension();
            $upload_success3 = Input::file('constancias')->move($destinationPath, $filename3);

            if ($upload_success3)
            {
                $solicitudabstracta->soab_con_adscripcion = $destinationPath . '/' . $filename3;
                $solicitudabstracta->save();
            }
        }

        $idusuario = Input::get('idusuario');
        $usrnombre = SolicitudAbstracta::find($id);
        $nombre = $usrnombre->SOAB_NOMBRES;
        $appaterno = $usrnombre->SOAB_AP_PATERNO;
        $apmaterno = $usrnombre->SOAB_AP_MATERNO;
        $usua_nombre_concatenado = $nombre . ' '. $appaterno  .' '. $apmaterno;

        $usuario = Usuario::find($idusuario);
        $usuario->usua_nom_completo = $usua_nombre_concatenado;
        $usuario->save();

        Session::flash('message', '¡La cuenta titular se ha modificado exitosamente!');

        return Redirect::to('gestionarproyectos/modificarcuentatitularvista');


    }



    public function mostrarConsultarCuentaTitular()
    {
        return View::make('gestionarcuentastitulares/consultarcuentatitularvista');
    }


    public function consultarCuentaTitular()
    {
        $querynombre = Input::get('nombreusuario');
        $usuarios = $this->obtenerCuentasTitulares($querynombre);
        return View::make('gestionarcuentastitulares/consultarcuentatitular')->with('usuarios', $usuarios);
    }

    public function consultarCuentaTitualEspecifica($idproyecto)
    {
        $proyecto = DB::table('contabilidad')
            ->select(DB::raw('sum(contabilidad.cont_num_jobs) AS totaljobs, usua_id_usuario ,proy_id_proyecto, proy_nombre, sum(contabilidad.cont_hrs_nodo) AS totalnodo,
            proy_hrs_aprobadas,depe_nombre, meco_correo, soab_lin_especializacion,  catr_nombre_campo, grad_nombre, meco_telefono1, usua_nom_completo ,CONCAT(FORMAT(IF(proy_hrs_aprobadas=0,0,(sum(contabilidad.cont_hrs_nodo)*100.0)/proy_hrs_aprobadas),2)) AS porcentajeproyecto'))
            ->join('usuario', 'contabilidad.cont_id_usuario', '=', 'usuario.usua_id_usuario')
            ->join('usuario_x_proyecto', 'usuario.usua_id_usuario', '=', 'usuario_x_proyecto.uspr_id_usuario')
            ->join('proyecto', 'usuario_x_proyecto.uspr_id_proyecto', '=', 'proyecto.proy_id_proyecto')
            ->join('estado_proyecto', 'proyecto.proy_id_estado_proyecto', '=', 'estado_proyecto.espr_id_estado_proyecto')
            ->join('solicitud_abstracta', 'proyecto.proy_id_solicitud_abstracta', '=', 'solicitud_abstracta.soab_id_solicitud_abstracta')
            ->join('campo_trabajo', 'solicitud_abstracta.soab_id_campo_trabajo', '=',  'campo_trabajo.catr_id_campo_trabajo')
            ->join('grado', 'solicitud_abstracta.soab_id_grado', '=', 'grado.grad_id_grado')
            ->join('medio_comunicacion', 'solicitud_abstracta.soab_id_medio_comunicacion', '=', 'medio_comunicacion.meco_id_medio_comunicacion')
            ->join('dependencia', 'solicitud_abstracta.soab_id_dependencia', '=', 'dependencia.depe_id_dependencia')
            ->where('proyecto.proy_id_proyecto', '=', $idproyecto)
            ->groupBy('proyecto.proy_id_proyecto')
            ->first();

            $proyectosincontabilidad = DB::table('usuario')
            ->join('usuario_x_proyecto', 'usuario.usua_id_usuario', '=', 'usuario_x_proyecto.uspr_id_usuario')
            ->join('proyecto', 'usuario_x_proyecto.uspr_id_proyecto', '=', 'proyecto.proy_id_proyecto')
            ->join('estado_proyecto', 'proyecto.proy_id_estado_proyecto', '=', 'estado_proyecto.espr_id_estado_proyecto')
            ->join('solicitud_abstracta', 'proyecto.proy_id_solicitud_abstracta', '=', 'solicitud_abstracta.soab_id_solicitud_abstracta')
            ->join('campo_trabajo', 'solicitud_abstracta.soab_id_campo_trabajo', '=',  'campo_trabajo.catr_id_campo_trabajo')
            ->join('grado', 'solicitud_abstracta.soab_id_grado', '=', 'grado.grad_id_grado')
            ->join('medio_comunicacion', 'solicitud_abstracta.soab_id_medio_comunicacion', '=', 'medio_comunicacion.meco_id_medio_comunicacion')
            ->join('dependencia', 'solicitud_abstracta.soab_id_dependencia', '=', 'dependencia.depe_id_dependencia')
            ->where('proyecto.proy_id_proyecto', '=', $idproyecto)
            ->groupBy('proyecto.proy_id_proyecto')
            ->first();



        $usuariosproyecto = DB::table('contabilidad')
            ->select(DB::raw('sum(contabilidad.cont_num_jobs) AS totaljobs, usua_id_usuario ,proy_id_proyecto, proy_nombre ,sum(contabilidad.cont_hrs_nodo) AS totalnodo,
            proy_hrs_aprobadas,usua_nom_completo, CONCAT(FORMAT(IF(proy_hrs_aprobadas=0,0,(sum(contabilidad.cont_hrs_nodo)*100.0)/proy_hrs_aprobadas),2)) AS porcentajeproyecto'))
            ->join('usuario', 'contabilidad.cont_id_usuario', '=', 'usuario.usua_id_usuario')
            ->join('usuario_x_proyecto', 'usuario.usua_id_usuario', '=', 'usuario_x_proyecto.uspr_id_usuario')
            ->join('proyecto', 'usuario_x_proyecto.uspr_id_proyecto', '=', 'proyecto.proy_id_proyecto')
            ->where('proyecto.proy_id_proyecto','=',$idproyecto )
            ->groupBy('usuario.usua_id_usuario')
            ->get();

        if($proyecto == NULL){
            return View::make('gestionarcuentastitulares/consultarcuentatitularespecificasincontabilidad')
                ->with('proyectosincontabilidad',$proyectosincontabilidad)->with('usuariosproyecto',$usuariosproyecto);
        } else{
            return View::make('gestionarcuentastitulares/consultarcuentatitularespecifica')
                ->with('proyecto',$proyecto)->with('usuariosproyecto',$usuariosproyecto);
        }




    }

}