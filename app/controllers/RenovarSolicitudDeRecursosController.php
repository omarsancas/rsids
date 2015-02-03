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

    public function renovarSolicitudDeRecursos()
    {
       $id = Input::get('id');
        $solicitudabstracta = SolicitudAbstracta::find($id);

        $solicitudabstracta->soab_nombres = Input::get('nombre');
        $solicitudabstracta->soab_ap_paterno = Input::get('apellidoPaterno');
        $solicitudabstracta->soab_ap_materno = Input::get('apellidoMaterno');
        $solicitudabstracta->soab_id_estado_solicitud = 1;
        $solicitudabstracta->soab_id_tipo_solicitud = 2;
        $solicitudabstracta->soab_es_proyecto = 0;
        $solicitudabstracta->soab_sexo = Input::get('sexo');
        $solicitudabstracta->soab_prog_paralela = Input::get('progparalela');
        $solicitudabstracta->soab_num_proc_trab = Input::get('numproc');
        $solicitudabstracta->soab_duracion = Input::get('duracion');
        $solicitudabstracta->soab_nombre_proyecto = Input::get('nombreproyecto');
        $solicitudabstracta->SOAB_ID_DEPENDENCIA = Input::get('dependencias');
        $solicitudabstracta->soab_id_campo_trabajo = Input::get('campos');
        $solicitudabstracta->soab_id_grado = Input::get('grado');
        $solicitudabstracta->soab_hrs_cpu = Input::get('horasCPU');
        $solicitudabstracta->soab_esp_hd = Input::get('disco');
        $solicitudabstracta->soab_mem_ram = Input::get('memoria');
        $solicitudabstracta->soab_lin_especializacion = Input::get('lineaesp');
        $solicitudabstracta->soab_mod_computacional = Input::get('modelocomp');
        $solicitudabstracta->save();

        $idmeco = $solicitudabstracta->SOAB_ID_MEDIO_COMUNICACION;
        $mediocomunicacion = MedioComunicacion::find($idmeco);
        $mediocomunicacion->meco_telefono1 = Input::get('telefono');
        $mediocomunicacion->meco_extension = Input::get('extension');
        $mediocomunicacion->meco_telefono2 = Input::get('telefono2');
        $mediocomunicacion->meco_correo = Input::get('email');
        $mediocomunicacion->save();


        $idotrocampo = $solicitudabstracta->SOAB_ID_OTRO_CAMPO;
        $otrocampo = OtroCampo::find($idotrocampo);
        $otrocampo->otca_nombre = Input::get('otrocampo');
        $otrocampo->save();


        $aplicaciones = Input::get('aplicaciones');
        $solicitudabstracta->aplicaciones()->sync($aplicaciones);

        $this->guardarArchivos($solicitudabstracta);





        $datoscuentacol = Input::get('solcol');
        $datosMecoCuentasCol = Input::get('meco');




        $cuentacol = array_slice($datoscuentacol, 1);
        $mecocuentascol = array_slice($datosMecoCuentasCol, 1);

        if(is_array($datoscuentacol)){

        foreach ((array_map(null, $cuentacol, $mecocuentascol)) as $solcolData)
        {

            list($v1, $v2) = $solcolData;
            $solcol = new Cuentacol($v1);
            $solicitudabstracta->cuentascol()->save($solcol);
            $mecoCol = new MedioComunicacion($v2);
            $mecoCol->save();
            $solcol->soco_id_medio_comunicacion = $mecoCol->MECO_ID_MEDIO_COMUNICACION;
            $solcol->save();
        }

        }



        foreach (Input::get('cuentascol', array()) as $id => $estadousuario)
        {
            $usuario = Usuario::find($id);
            $usuario->usua_id_estado_usuario = $estadousuario;
            $usuario->save();
        }

        /*
        $solicitudrenovacion = new SolicitudRenovacion;
        $solicitudrenovacion->sore_argumentacion = Input::get('argumentacion');
        $solicitudrenovacion->save();



        $solicitudabstracta->soab_id_solicitud_renovacion = $solicitudrenovacion->SORE_ID_SOLICITUD_RENOVACION;
        $solicitudabstracta->save();

        */
        $destinationPath = $solicitudabstracta->SOAB_RUTA_ARCHIVOS;



        if(Input::hasFile('archivos')){

            $file = Input::file('archivos');
            $tipoarchivo = Input::get('tipoarchivo');// your file upload input field in the form should be named 'file'
            //$uploadsuccess = true;


            /*
            // Declare the rules for the form validation.
            $rules = array('archivos'  => 'mimes:pdf');
            $data = array('archivos' => Input::file('archivos'));


            // Validate the inputs.
            $validation = Validator::make($data, $rules)-;



            if ($validation->fails())
            {
                return Response::json('error', 400);
            }

            */

            $filearr = array_slice($file, 1);
            $tipoarchivoarr = array_slice($tipoarchivo,1);

            if(is_array($filearr))
            {
                foreach(array_map(null, $filearr, $tipoarchivoarr) as $mapdata) {

                    list($part,$parttipo) = $mapdata;

                    $filename = $part->getClientOriginalName();
                    $part->move($destinationPath, $filename);

                    $archivos_renovacion = new ArchivoRenovacion;
                    $archivos_renovacion->arre_ruta_archivo = $destinationPath . '/' . $filename;
                    $archivos_renovacion->arre_id_solicitud_renovacion = 0;
                    $archivos_renovacion->arre_tip_archivo = $parttipo;
                    $archivos_renovacion->save();


                }

            }
            else //single file
            {
                $filename = $file->getClientOriginalName();
                $uploadsuccess = Input::file('archivos')->move($destinationPath, $filename);

                if( $uploadsuccess ) {
                    return Response::json('success', 200);
                } else {
                    return Response::json('error', 400);
                }
            }



        } else {

            return Response::json('error', 400);
        }



    }

    public function ampliacionDeRecursosVista()
    {
        return View::make('');
    }

    public function ampliarRecursos()
    {

    }


} 