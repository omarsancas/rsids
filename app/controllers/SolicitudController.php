<?php

class SolicitudController extends BaseController {


    /**
     * Obtiene de la BD los catálogos para formar la vista del formulario generar solicitud
     * @return mixed
     */
    public function mostrarSolicitud()
    {

        $aplicaciones = Aplicacion::lists('apli_nombre', 'apli_id_aplicacion');
        $dependencias_catalogo = Dependencia::lists('depe_nombre', 'depe_id_dependencia');
        $campotrabajo = CampoTrabajo::lists('catr_nombre_campo', 'catr_id_campo_trabajo');
        $grado = Grado::lists('grad_nombre', 'grad_id_grado');


        return View::make('registro.solicitud')->with('dependencias_catalogo', $dependencias_catalogo)
                                                ->with('aplicaciones', $aplicaciones)
                                                ->with('grado', $grado)
                                                ->with('campos', $campotrabajo);


    }


    /**
     * Inserta en la BD los datos de la solicitud de registros
     * @return mixed
     */
    public function generarSolicitud()
    {
        $datos = Input::all();


        $rules = array(
            'nombre'               => 'required',
            'apellidoPaterno'      => 'required',
            'telefono'             => 'required|numeric',
            'extension'            => 'required|numeric',
            'horasCPU'             => 'required|numeric|max:5000000',
            'disco'                => 'required|numeric',
            'memoria'              => 'required|numeric',
            'lineaesp'             => 'required',
            'modelocomp'           => 'required',
            'numproc'              => 'required|numeric',
            'email'                => 'required|email',
            'documentodescriptivo' => 'required|mimes:pdf|max:8000', //para activar esta característica de validación de laravel se necesita aumentar el tamaño en el php.ini en upload_file de acuerdo a sus necesidades
            'constancias'          => 'required|mimes:pdf|max:8000',
            'curriculum'           => 'required|mimes:pdf|max:8000',


        );


        $mensajes = array(
            'required' => ' El campo :attribute es obligatorio',
            'mimes'    => 'El archivo :attribute archivo debe de ser pdf',
            'max'      => 'El archivo :attribute no debe de pasar los 8MB',
            'horasCPU.max'=> 'Las horas cpu no deben sobrepasar las 5000000 de horas',
            'numeric' => ' El campo :attribute solo debe contener números'

        );

        // do the validation ----------------------------------
        // validate against the inputs from our form
        $validator = Validator::make(Input::all(), $rules, $mensajes);


        // check if the validator failed -----------------------;
        if ($validator->fails())
        {


            $messages = $validator->messages();

            // redirect our user back to the form with the errors from the validator
            return Redirect::to('solicitud')
                ->withErrors($validator)->withInput(Input::except('curriculum', 'constancias', 'documentodescriptivo'));
        } else
        {


            $datos = new SolicitudAbstracta;
            $datos->soab_nombres = Input::get('nombre');
            $datos->soab_ap_paterno = Input::get('apellidoPaterno');
            $datos->soab_ap_materno = Input::get('apellidoMaterno');
            $datos->soab_id_estado_solicitud = 1;
            $datos->soab_id_tipo_solicitud = 1;
            $datos->soab_sexo = Input::get('sexo');
            $datos->soab_prog_paralela = Input::get('progparalela');
            $datos->soab_num_proc_trab = Input::get('numproc');
            $datos->soab_duracion = Input::get('duracion');
            $datos->soab_nombre_proyecto = Input::get('nombreproyecto');
            $datos->SOAB_ID_DEPENDENCIA = Input::get('dependencias');
            $datos->soab_id_campo_trabajo = Input::get('campos');
            $datos->soab_id_grado = Input::get('grado');
            $datos->soab_hrs_cpu = Input::get('horasCPU');
            $datos->soab_esp_hd = Input::get('disco');
            $datos->soab_mem_ram = Input::get('memoria');
            $datos->soab_lin_especializacion = Input::get('lineaesp');
            $datos->soab_mod_computacional = Input::get('modelocomp');
            $datos->save();


            $aplicaciones = Input::get('aplicaciones');
            $datos->aplicaciones()->sync($aplicaciones);



            $mediocomunicacion = new MedioComunicacion;
            $mediocomunicacion->meco_telefono1 = Input::get('telefono');
            $mediocomunicacion->meco_extension = Input::get('extension');
            $mediocomunicacion->meco_telefono2 = Input::get('telefono2');
            $mediocomunicacion->meco_correo = Input::get('email');
            $mediocomunicacion->save();
            $datos->soab_id_medio_comunicacion = $mediocomunicacion->MECO_ID_MEDIO_COMUNICACION;
            $datos->save();


            $otrocampo = new OtroCampo();
            $otrocampo->otca_nombre = Input::get('otrocampo');
            $otrocampo->save();
            $datos->soab_id_otro_campo = $otrocampo->OTCA_ID_OTRO_CAMPO;
            $datos->save();


            $dataapp = Input::get('otraapp');

            foreach ((array_slice($dataapp, 1)) as $otraapData)
            {
                $otraap = new OtraAplicacion($otraapData);
                $datos->otraaplicacion()->save($otraap);
            }


            $datoscuentacol = Input::get('solcol');
            $datosMecoCuentasCol = Input::get('meco');

            $cuentacol = array_slice($datoscuentacol, 1);
            $mecocuentascol = array_slice($datosMecoCuentasCol, 1);


            foreach ((array_map(null, $cuentacol, $mecocuentascol)) as $solcolData)
            {

                list($v1, $v2) = $solcolData;
                $solcol = new Cuentacol($v1);
                $datos->cuentascol()->save($solcol);
                $mecoCol = new MedioComunicacion($v2);
                $mecoCol->save();
                $solcol->soco_id_medio_comunicacion = $mecoCol->MECO_ID_MEDIO_COMUNICACION;
                $solcol->save();
            }


            /*$queries = DB::getQueryLog();
            var_dump($queries);*/

            $destinationPath = public_path() . '/uploads/'. $datos->SOAB_ID_SOLICITUD_ABSTRACTA. '_'.'Solicitud'. '_'. time();

            $result = File::makeDirectory($destinationPath);

            if($result)
            {
                $datos->soab_ruta_archivos = $destinationPath;
                $datos->save();
            }



            /** @var $archivocurriculum TYPE_NAME */
            $archivocurriculum = $datos->SOAB_ID_SOLICITUD_ABSTRACTA .'_'. 'CV' . '.' . Input::file('curriculum')->getClientOriginalExtension();
            $upload_success = Input::file('curriculum')->move($destinationPath, $archivocurriculum);


            // If the uploads fail due to file system, you can try doing public_path().'/uploads'
            $archivodesc = $datos->SOAB_ID_SOLICITUD_ABSTRACTA .'_'. 'DOCDESC' . '.'. Input::file('documentodescriptivo')->getClientOriginalExtension();
            $upload_success2 = Input::file('documentodescriptivo')->move($destinationPath, $archivodesc);


            // If the uploads fail due to file system, you can try doing public_path().'/uploads'
            $archivocons = $datos->SOAB_ID_SOLICITUD_ABSTRACTA .'_'. 'CONSTANCIA' .  '.' . Input::file('constancias')->getClientOriginalExtension();
            $upload_success3 = Input::file('constancias')->move($destinationPath, $archivocons);


            if ($upload_success && $upload_success2 && $upload_success3 )
            {
                $datos->soab_curriculum = $destinationPath .'/'. $archivocurriculum;
                $datos->soab_desc_proyecto = $destinationPath .'/'. $archivodesc;
                $datos->soab_con_adscripcion = $destinationPath .'/'. $archivocons;
                $datos->save();

                return Response::json('success', 200);
            } else
            {
                return Response::json('error', 400);
            }


        }


    }//fin del método generarSolicitud

    /**
     * Obtiene los datos para la vista eliminar solicitud
     * @return mixed
     */
    public function eliminarSolicitud()
    {
        $solicitudes = DB::table('solicitud_abstracta')
            ->join('tipo_solicitud', 'solicitud_abstracta.soab_id_tipo_solicitud', '=', 'tipo_solicitud.tiso_id_tipo_solicitud')
            ->where('solicitud_abstracta.soab_id_estado_solicitud', '=', 1)
            ->get();

        return View::make('gestionarsolicitudderecursos.eliminarsolicitud')->with('solicitudes', $solicitudes);
    }


    /**
     * Elimina de la BD un conjunto de solicitudes seleccionada por el usuario
     * @return mixed
     */
    public function eliminar()
    {
        $solicitudes = Input::get('check_box');
        SolicitudAbstracta::destroy($solicitudes);
        Session::flash('message', '¡Las solicitudes seleccionadas, se han borrado exitosamente!');

        return Redirect::to('gestionarsolicitudderecursos/eliminarsolicitud');
    }


    /**
     *
     * Obtiene los datos de la BD y genera la vista de modificar solicitud
     * @return mixed
     */
    public function modificarSolicitud()
    {

        $solicitudes = DB::table('solicitud_abstracta')
            ->join('tipo_solicitud', 'solicitud_abstracta.soab_id_tipo_solicitud', '=', 'tipo_solicitud.tiso_id_tipo_solicitud')
            ->where(DB::raw('YEAR(soab_fec_registro)'), '=',  DB::raw('YEAR(CURDATE())'))
            ->where('soab_id_estado_solicitud','=',1)
            ->get();

        return View::make('gestionarsolicitudderecursos.modificarsolicitud')->with('solicitudes', $solicitudes);
    }


    /**
     * Obtiene los datos de la BD y genera la vista de consultar solicitud
     * @return mixed
     */
    public function consultarSolicitud()
    {

        $solicitudes = $this->obtenerSolicitudes();

        return View::make('gestionarsolicitudderecursos.consultarsolicitud')->with('solicitudes', $solicitudes);
    }


    /**
     * Obtiene los datos de la solicitud y regresa la vista con los datos de la solicitud seleccionada para su actualización
     * @param $id
     * @return mixed
     */
    public function editarSolicitud($id)
    {

        list($solicitudabstracta, $dependencias_catalogo, $grado, $campotrabajo, $meco, $solicitud, $otraapp, $otrocampo) = $this->obtenerListaSolicitudes($id);

        // Show form
        return View::make('gestionarsolicitudderecursos.editarsolicitud', $this->data)
            ->with('cuentascol', $solicitud)->with('solicitudabstracta', $solicitudabstracta)
            ->with('grado', $grado)
            ->with('dependencias_catalogo', $dependencias_catalogo)
            ->with('otrocampo', $otrocampo)
            ->with('otraapp', $otraapp)
            ->with('campotrabajo', $campotrabajo)
            ->with('meco', $meco);

    }

    /**
     * Obtiene los datos de la solicitud y regresa la vista con los datos de la solicitud seleccionada para consultar la solicitud
     * @param $id
     * @return mixed
     */
    public function consultarSolicitudVista($id)
    {

        list($solicitudabstracta,
            $dependencias_catalogo,
            $grado,
            $campotrabajo,
            $meco,
            $solicitud,
            $otraapp,
            $otrocampo) = $this->obtenerListaSolicitudes($id);




        $renovacion = DB::table('solicitud_abstracta')
            ->join('solicitud_renovacion', 'solicitud_renovacion.sore_id_solicitud_renovacion', '=', 'solicitud_abstracta.soab_id_solicitud_renovacion')
            ->join('archivos_renovacion','archivos_renovacion.arre_id_solicitud_renovacion','=','solicitud_renovacion.sore_id_solicitud_renovacion')
            ->where('solicitud_abstracta.soab_id_solicitud_abstracta', '=', $id)
            ->first();


        $archivosrenovacion = DB::table('solicitud_abstracta')
            ->join('solicitud_renovacion', 'solicitud_renovacion.sore_id_solicitud_renovacion', '=', 'solicitud_abstracta.soab_id_solicitud_renovacion')
            ->join('archivos_renovacion','archivos_renovacion.arre_id_solicitud_renovacion','=','solicitud_renovacion.sore_id_solicitud_renovacion')
            ->where('solicitud_abstracta.soab_id_solicitud_abstracta', '=', $id)
            ->get();


        $datosrenovacion = DB::table('usuario')
            ->join('usuario_x_proyecto', 'usuario.usua_id_usuario', '=', 'usuario_x_proyecto.uspr_id_usuario')
            ->join('proyecto', 'usuario_x_proyecto.uspr_id_proyecto', '=', 'proyecto.proy_id_proyecto')
            ->join('solicitud_abstracta', 'proyecto.proy_id_solicitud_abstracta', '=', 'solicitud_abstracta.soab_id_solicitud_abstracta')
            ->join('medio_comunicacion', 'solicitud_abstracta.soab_id_medio_comunicacion', '=', 'medio_comunicacion.meco_id_medio_comunicacion')
            ->join('dependencia', 'solicitud_abstracta.soab_id_dependencia', '=', 'dependencia.depe_id_dependencia')
            ->where('solicitud_abstracta.soab_id_solicitud_abstracta' , '=', $id)
            ->first();


        $cuentascolnuevas = DB::table('solicitud_cta_colaboradora')
            ->join('medio_comunicacion', 'solicitud_cta_colaboradora.soco_id_medio_comunicacion', '=', 'medio_comunicacion.meco_id_medio_comunicacion')
            ->where('solicitud_cta_colaboradora.soco_id_solicitud_abstracta', '=', $id)
            ->where('solicitud_cta_colaboradora.soco_id_estado_colaboradora', '=', 1)
            ->get();




        $idproyecto = $datosrenovacion->PROY_ID_PROYECTO;

        $estadousuario = EstadoUsuario::lists('esus_estado_nombre','esus_id_estado_usuario');


        $cuentascolaboradoras = DB::table('usuario')
            ->join('usuario_x_proyecto', 'usuario.usua_id_usuario', '=', 'usuario_x_proyecto.uspr_id_usuario')
            ->where('usuario_x_proyecto.uspr_id_proyecto','=', $idproyecto)
            ->where('usuario.usua_id_tipo_usuario','=',3)
            ->get();

        $flag = $solicitudabstracta->SOAB_ID_SOLICITUD_RENOVACION;


        if ($flag === NULL)
        {
            return View::make('gestionarsolicitudderecursos.consultarsolicitudvista', $this->data)
                ->with('cuentascol', $solicitud)
                ->with('solicitudabstracta', $solicitudabstracta)
                ->with('grado', $grado)
                ->with('dependencias_catalogo', $dependencias_catalogo)
                ->with('otrocampo', $otrocampo)
                ->with('otraapp', $otraapp)
                ->with('campotrabajo', $campotrabajo)
                ->with('meco', $meco);


            // Show form

        }else{
            return View::make('gestionarsolicitudderecursos.consultarsolicitudrenovacionvista', $this->data)
                ->with('cuentascol', $solicitud)
                ->with('solicitudabstracta', $solicitudabstracta)
                ->with('grado', $grado)
                ->with('dependencias_catalogo', $dependencias_catalogo)
                ->with('otrocampo', $otrocampo)
                ->with('otraapp', $otraapp)
                ->with('campotrabajo', $campotrabajo)
                ->with('meco', $meco)
                ->with('renovacion',$renovacion)
                ->with('archivosrenovacion',$archivosrenovacion)
                ->with('cuentascolaboradoras',$cuentascolaboradoras)
                ->with('estadousuario',$estadousuario)
                ->with('cuentascolnuevas',$cuentascolnuevas);

        }





    }


    /**
     * Actualiza la solicitud de recursos seleccionada
     * @return mixed
     */
    public function actualizarSolicitud()
    {
        $id = Input::get('id');
        $solicitudabstracta = SolicitudAbstracta::find($id);
        $solicitudabstracta->soab_nombres = Input::get('nombre');
        $solicitudabstracta->soab_ap_paterno = Input::get('apellidoPaterno');
        $solicitudabstracta->soab_ap_materno = Input::get('apellidoMaterno');
        $solicitudabstracta->soab_sexo = Input::get('sexo');
        $solicitudabstracta->soab_prog_paralela = Input::get('progparalela');
        $solicitudabstracta->soab_num_proc_trab = Input::get('numproc');
        $solicitudabstracta->soab_duracion = Input::get('duracion');
        $solicitudabstracta->soab_nombre_proyecto = Input::get('nombreproyecto');
        $solicitudabstracta->SOAB_ID_DEPENDENCIA = Input::get('dependencias');
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



        if (Input::hasFile('curriculum'))
        {
            $archivo = $solicitudabstracta->SOAB_CURRICULUM;
            File::delete($archivo);
            $destinationPath = $solicitudabstracta->soab_ruta_archivos;
            /** @var $filename1 TYPE_NAME */
            $filename1 = $solicitudabstracta->SOAB_ID_SOLICITUD_ABSTRACTA .'_'. 'CV' . '.' . Input::file('curriculum')->getClientOriginalExtension();
            $upload_success1 = Input::file('curriculum')->move($destinationPath, $filename1);


            if ($upload_success1)
            {
                $solicitudabstracta->soab_curriculum = $destinationPath .'/'. $filename1;
                $solicitudabstracta->save();
            }
        }


        if (Input::hasFile('docdesc'))
        {
            $archivo = $solicitudabstracta->SOAB_DESC_PROYECTO;
            File::delete($archivo);
            $destinationPath = $solicitudabstracta->soab_ruta_archivos;
            /** @var $filename1 TYPE_NAME */
            $filename2 = $solicitudabstracta->SOAB_ID_SOLICITUD_ABSTRACTA .'_'. 'DOCDESC' . '.'. Input::file('documentodescriptivo')->getClientOriginalExtension();
            $upload_success2 = Input::file('documentodescriptivo')->move($destinationPath, $filename2);



            if ($upload_success2)
            {
                $solicitudabstracta->soab_desc_proyecto = $destinationPath .'/'. $filename2;
                $solicitudabstracta->save();
            }
        }


        if (Input::hasFile('constancias'))
        {
            $archivo = $solicitudabstracta->SOAB_CON_ADSCRIPCION;
            File::delete($archivo);
            $destinationPath = $solicitudabstracta->soab_ruta_archivos;
            /** @var $filename1 TYPE_NAME */
            $filename3 = $solicitudabstracta->SOAB_ID_SOLICITUD_ABSTRACTA .'_'. 'CONSTANCIA' .  '.' . Input::file('constancias')->getClientOriginalExtension();
            $upload_success3 = Input::file('constancias')->move($destinationPath, $filename3);

            if ($upload_success3)
            {
                $solicitudabstracta->soab_con_adscripcion = $destinationPath .'/'. $filename3;
                $solicitudabstracta->save();
            }
        }



        foreach (Input::get('otraapp', array()) as $id => $otraappData)
        {

            $otraap = OtraAplicacion::find($id);
            $otraap->update($otraappData);
            $otraap->save();
        }



        foreach (Input::get('solcol', array()) as $id => $solcolData)
        {
            $solcol = Cuentacol::find($id);
            $solcol->update($solcolData);
            $solcol->save();
        }


        foreach (Input::get('meco', array()) as $id => $solcolData)
        {
            $meco = MedioComunicacion::find($id);
            $meco->update($solcolData);
            $meco->save();
        }

        //$solicitudabstracta->cuentascol()->sync($solcol_ids);


        Session::flash('message', '¡La solicitud se ha modificado exitosamente!');

        return Redirect::to('gestionarsolicitudderecursos/modificarsolicitud');
        //$queries = DB::getQueryLog();
        //var_dump($queries);
    }


    /**
     * Genera un PDF con la carta seleccionada
     * @param $id
     * @return mixed
     */
    public function generarCartas($id)
    {
        $convocatoria = Convocatoria::find(1);

        $solicitudes = DB::table('solicitud_abstracta')
            ->join('dependencia', 'solicitud_abstracta.soab_id_dependencia', '=', 'dependencia.depe_id_dependencia')
            ->join('proyecto','solicitud_abstracta.soab_id_solicitud_abstracta','=','proyecto.proy_id_solicitud_abstracta')
            ->join('tipo_proyecto','proyecto.proy_id_tipo_proyecto', '=', 'tipo_proyecto.tipr_id_tipo_proyecto')
            ->join('grado', 'solicitud_abstracta.soab_id_grado', '=', 'grado.grad_id_grado')
            ->where('solicitud_abstracta.soab_id_solicitud_abstracta', '=', $id)
            ->first();

        if($solicitudes->SOAB_SEXO == 'm')
        {
            if($solicitudes->SOAB_ID_GRADO == 1){

                $titulo = 'Lic.';
            }else if($solicitudes->SOAB_ID_GRADO == 2){

                $titulo = 'Mtro.';

            }else{

                $titulo = 'Dr.';
            }

        }else{

            if($solicitudes->SOAB_ID_GRADO == 1){

                $titulo = 'Lic.';
            }else if($solicitudes->SOAB_ID_GRADO == 2){

                $titulo = 'Mtra.';

            }else{

                $titulo = 'Dra.';
            }

        }


        $html = View::make('gestionarsolicitudderecursos.generarcarta')
                ->with('solicitudes', $solicitudes)
                ->with('titulo',$titulo)
                ->with('convocatoria',$convocatoria)
                ->render();

        return PDF::load($html, 'letter', 'portrait')->show();
    }


    /**
     * Regresa la vista de las solicitudes para generar cartas
     * @return mixed
     */
    public function mostrarSolicitudes()
    {

        $solicitudes = DB::table('solicitud_abstracta')
            ->join('tipo_solicitud', 'solicitud_abstracta.soab_id_tipo_solicitud', '=', 'tipo_solicitud.tiso_id_tipo_solicitud')
            ->where('solicitud_abstracta.soab_id_estado_solicitud', '=', 2)
            ->get();

        return View::make('gestionarsolicitudderecursos.generarcartas')->with('solicitudes', $solicitudes);
    }


    /**
     *
     * Genera la vista de las solicitudes aceptadas para ser notificadas
     * @return mixed
     */
    public function mostrarNotificacionSolicitudes()
    {

        $solicitudes = DB::table('solicitud_abstracta')
            ->join('medio_comunicacion','solicitud_abstracta.soab_id_medio_comunicacion','=','medio_comunicacion.meco_id_medio_comunicacion')
            ->join('tipo_solicitud', 'solicitud_abstracta.soab_id_tipo_solicitud', '=', 'tipo_solicitud.tiso_id_tipo_solicitud')
            ->where('solicitud_abstracta.soab_id_estado_solicitud', '=', 2)
            ->where('soab_proy_notificado','=',0)
            ->get();

        return View::make('gestionarsolicitudderecursos.notificaraprobacion')->with('solicitudes', $solicitudes);
    }

    public function mostrarNotificacionRechazoSolicitudes()
    {

        $solicitudes = DB::table('solicitud_abstracta')
            ->join('medio_comunicacion','solicitud_abstracta.soab_id_medio_comunicacion','=','medio_comunicacion.meco_id_medio_comunicacion')
            ->join('tipo_solicitud', 'solicitud_abstracta.soab_id_tipo_solicitud', '=', 'tipo_solicitud.tiso_id_tipo_solicitud')
            ->where('solicitud_abstracta.soab_id_estado_solicitud', '=', 3)
            ->where('soab_proy_notificado','=',0)
            ->get();

        return View::make('gestionarsolicitudderecursos.notificarrechazo')->with('solicitudes', $solicitudes);
    }


    /**
     *
     * Notifica al usuario de sus recursos aceptados
     * @param $id
     */
    public function notificarAprobacion($id)
    {
        $solicitudes = DB::table('solicitud_abstracta')
            ->join('dependencia', 'solicitud_abstracta.soab_id_dependencia', '=', 'dependencia.depe_id_dependencia')
            ->join('proyecto', 'proyecto.proy_id_solicitud_abstracta', '=', 'solicitud_abstracta.soab_id_solicitud_abstracta')
            ->join('medio_comunicacion', 'solicitud_abstracta.soab_id_medio_comunicacion', '=', 'medio_comunicacion.meco_id_medio_comunicacion')
            ->join('grado', 'solicitud_abstracta.soab_id_grado', '=', 'grado.grad_id_grado')
            ->where('solicitud_abstracta.soab_id_solicitud_abstracta', '=', $id)
            ->first();

        if($solicitudes->SOAB_SEXO == 'm')
        {
            if($solicitudes->SOAB_ID_GRADO == 1){

                $titulo = 'Lic.';
            }else if($solicitudes->SOAB_ID_GRADO == 2){

                $titulo = 'Mtro.';

            }else{

                $titulo = 'Dr.';
            }

        }else{

            if($solicitudes->SOAB_ID_GRADO == 1){

                $titulo = 'Lic.';
            }else if($solicitudes->SOAB_ID_GRADO == 2){

                $titulo = 'Mtra.';

            }else{

                $titulo = 'Dra.';
            }

        }

        $correelectronico = $solicitudes->MECO_CORREO;
        $ruta_archivo = $solicitudes->SOAB_RUTA_ARCHIVOS;

        $esnotificado = SolicitudAbstracta::find($id);
        $esnotificado->soab_proy_notificado = 1;
        $esnotificado->save();

        $html = View::make('gestionarsolicitudderecursos.generarcarta')->with('solicitudes', $solicitudes)->with('titulo',$titulo)->render();

        $pdf = new \Thujohn\Pdf\Pdf();
        $content = $pdf->load($html, 'letter', 'portrait')->output();
         // str_random is a [Laravel helper](http://laravel.com/docs/helpers#strings)
        $pdfPath = $ruta_archivo . '/' . 'CartadeAprobacion'. $solicitudes->SOAB_ID_SOLICITUD_ABSTRACTA . '.pdf';
        File::put($pdfPath, $content);

        $data = ['msg' => 'hola'];
        Mail::send('emails.welcome', $data, function ($message) use ($pdfPath, $correelectronico)
        {
            $message->from('moroccosc@gmail.com', 'Laravel');
            $message->to($correelectronico);
            $message->attach($pdfPath);
        });

        $cuentasvpn = DB::table('solicitud_abstracta')
            ->select(DB::raw('vplo_login, vplo_password,vplo_nombre'))
            ->join('dependencia', 'solicitud_abstracta.soab_id_dependencia', '=', 'dependencia.depe_id_dependencia')
            ->join('proyecto', 'proyecto.proy_id_solicitud_abstracta', '=', 'solicitud_abstracta.soab_id_solicitud_abstracta')
            ->join('usuario_x_proyecto', 'proyecto.proy_id_proyecto', '=', 'usuario_x_proyecto.uspr_id_proyecto')
            ->join('usuario', 'usuario_x_proyecto.uspr_id_usuario', '=', 'usuario.usua_id_usuario')
            ->join('vpn_login', 'usuario.usua_id_usuario', '=', 'vpn_login.vplo_login')
            ->where('solicitud_abstracta.soab_id_solicitud_abstracta','=', $id)
            ->get();

        $cuentasmaquina = DB::table('solicitud_abstracta')
            ->select(DB::raw('malo_login, malo_password,malo_nombre'))
            ->join('dependencia', 'solicitud_abstracta.soab_id_dependencia', '=', 'dependencia.depe_id_dependencia')
            ->join('proyecto', 'proyecto.proy_id_solicitud_abstracta', '=', 'solicitud_abstracta.soab_id_solicitud_abstracta')
            ->join('usuario_x_proyecto', 'proyecto.proy_id_proyecto', '=', 'usuario_x_proyecto.uspr_id_proyecto')
            ->join('usuario', 'usuario_x_proyecto.uspr_id_usuario', '=', 'usuario.usua_id_usuario')
            ->join('vpn_login', 'usuario.usua_id_usuario', '=', 'vpn_login.vplo_login')
            ->join('maquina_login', 'usuario.usua_id_usuario', '=', 'maquina_login.malo_login')
            ->where('solicitud_abstracta.soab_id_solicitud_abstracta','=', $id)
            ->get();


        $ruta_archivo = $esnotificado->SOAB_RUTA_ARCHIVOS;
        $html = View::make('evaluarsolicitudderecursos.cartademaquinavpn')->with('cuentasmaquina', $cuentasmaquina)->with('cuentasvpn',$cuentasvpn)->with('solicitudes',$solicitudes)->with('titulo',$titulo)->render();

        $pdf1 = new \Thujohn\Pdf\Pdf();
        $content = $pdf1->load($html, 'letter', 'portrait')->output();
        // str_random is a [Laravel helper](http://laravel.com/docs/helpers#strings)
        $pdfPath = $ruta_archivo . '/' . 'CartaDeCuentas'. $esnotificado->SOAB_ID_SOLICITUD_ABSTRACTA . '.pdf';
        File::put($pdfPath, $content);

        Session::flash('message', '¡La solicitud se ha notificado exitosamente!');

        return Redirect::to('gestionarsolicitudderecursos/notificaraprobacion');

    }



    public function notificarRechazo($id)
    {
        $solicitudes = DB::table('solicitud_abstracta')
            ->join('dependencia', 'solicitud_abstracta.soab_id_dependencia', '=', 'dependencia.depe_id_dependencia')
            ->join('medio_comunicacion', 'solicitud_abstracta.soab_id_medio_comunicacion', '=', 'medio_comunicacion.meco_id_medio_comunicacion')
            ->join('grado', 'solicitud_abstracta.soab_id_grado', '=', 'grado.grad_id_grado')
            ->where('solicitud_abstracta.soab_id_solicitud_abstracta', '=', $id)
            ->first();

        $correelectronico = $solicitudes->MECO_CORREO;
        $desc_rechazo = $solicitudes->SOAB_DESC_RECHAZO;

        $esnotificado = SolicitudAbstracta::find($id);
        $esnotificado->soab_proy_notificado = 1;
        $esnotificado->save();


        $data = ['msg' => $desc_rechazo];
        Mail::send('emails.welcome', $data, function ($message) use ($correelectronico)
        {
            $message->from('moroccosc@gmail.com', 'Laravel')->subject('Notificacion de rechazo de solicitud de recursos');
            $message->to($correelectronico);
        });


        Session::flash('message', '¡La solicitud se ha notificado exitosamente!');

        return Redirect::to('gestionarsolicitudderecursos/notificarrechazo');
    }


    /**
     *
     * Descarga el achivo curriculum
     * @param $id
     * @return mixed
     */
    public function mostrarCurriculum($id)
    {

        $solicitud = SolicitudAbstracta::find($id);
        $rutaarchivo = $solicitud->SOAB_CURRICULUM;

        return Response::download($rutaarchivo);

        //return Redirect::to('');

    }

    public function mostrarArchivoRenovacion($id)
    {

        $archivo = ArchivoRenovacion::find($id);
        $rutaarchivo = $archivo->ARRE_RUTA_ARCHIVO;

        return Response::download($rutaarchivo);

    }


    public function mostrarArchivos($id)
    {

        $solicitud = SolicitudAbstracta::find($id);
        $rutaarchivo = $solicitud->SOAB_CURRICULUM;

        return Response::download($rutaarchivo);

        //return Redirect::to('');

    }


    public function mostrarDocumentoDesc($id)
    {

        $solicitud = SolicitudAbstracta::find($id);
        $rutaarchivo = $solicitud->SOAB_DESC_PROYECTO;
        return Response::download($rutaarchivo);

        //return Redirect::to('');

    }


    public function mostrarConstancia($id)
    {

        $solicitud = SolicitudAbstracta::find($id);
        $rutaarchivo = $solicitud->SOAB_CON_ADSCRIPCION;

        return Response::download($rutaarchivo);

        //return Redirect::to('');

    }

    public function buscarSolicitud()
    {
        $tipo = Input::get('tiposolicitud');
        $mes = Input::get('mes');
        $estado = Input::get('estadosolicitud');
        $anio = Input::get('anio');

        //dd($estado);


        $solicitudes = DB::table('solicitud_abstracta')
            ->join('tipo_solicitud', 'solicitud_abstracta.soab_id_tipo_solicitud', '=', 'tipo_solicitud.tiso_id_tipo_solicitud')
            ->join('estado_solicitud', 'solicitud_abstracta.soab_id_estado_solicitud', '=', 'estado_solicitud.esso_id_esado_solicitud')
            ->where(DB::raw('MONTH(soab_fec_registro)'), '=', $mes)
            ->where('estado_solicitud.esso_id_esado_solicitud', '=', $estado)
            ->where('tipo_solicitud.tiso_id_tipo_solicitud', '=', $tipo)
            ->where(DB::raw('YEAR(soab_fec_registro)'), '=', $anio )
            ->get();

        return View::make('gestionarsolicitudderecursos.consultarsolicitud')->with('solicitudes', $solicitudes);


    }

    public function mostrarConvocatoria()
    {
        $convocatoria = Convocatoria::findOrFail(1);
        return View::make('gestionarsolicitudderecursos.mostrarconvocatoria')->with('convocatoria',$convocatoria);
    }

    public function actualizarConvocatoria()
    {
        $convocatoria = Convocatoria::find(1);
        $convocatoria->convo_anio_convo= Input::get('anioconvocatoria');
        $convocatoria->convo_proy_aprobados =Input::get('numproyaprobados');
        $convocatoria->convo_total_recursos_sol = Input::get('totalrecursosconvo');
        $convocatoria->convo_total_hrs = Input::get('totalhorasconvo');
        $convocatoria->convo_periodo = Input::get('periodoconvo');
        $convocatoria->convo_periodo_comp = Input::get('periodocompconvo');
        $convocatoria->convo_ritmo_mens = Input::get('ritmomens');
        $convocatoria->convo_devolucion = Input::get('fechadevolucion');
        $convocatoria->save();


        Session::flash('message', '¡La convocatoria se ha actualizado exitosamente!');

        return Redirect::to('asignarconvocatoria')->with('convocatoria',$convocatoria);

    }

    /**
     * @return mixed
     */
    public function obtenerSolicitudes()
    {
        $solicitudes = DB::table('solicitud_abstracta')
            ->join('tipo_solicitud', 'solicitud_abstracta.soab_id_tipo_solicitud', '=', 'tipo_solicitud.tiso_id_tipo_solicitud')
            ->get();

        return $solicitudes;
    }

    /**
     * @param $id
     * @return array
     */
    public function obtenerListaSolicitudes($id)
    {
        $solicitudabstracta = SolicitudAbstracta::find($id);
        /*Esta funcion de empty es para que cuando se implemente la solicitud de renovacion se pueda cambiar de vista*/

            $dependencias_catalogo = Dependencia::lists('depe_nombre', 'depe_id_dependencia');
            $grado = Grado::lists('grad_nombre', 'grad_id_grado');
            $campotrabajo = CampoTrabajo::lists('catr_nombre_campo', 'catr_id_campo_trabajo');
            $this->data['solicitud'] = $solicitudabstracta;
            $this->data['aplicaciones'] = Aplicacion::all();
            $aplicacionesseleccionadas = $solicitudabstracta->aplicaciones()->get()->toArray();
            $aplicacionesseleccionadas = array_pluck($aplicacionesseleccionadas, 'APLI_ID_APLICACION');
            $this->data['aplicacionesseleccionadas'] = $aplicacionesseleccionadas;
            $cuentascol = $solicitudabstracta->cuentascol;


            $meco = DB::table('solicitud_abstracta')
                ->join('medio_comunicacion', 'solicitud_abstracta.soab_id_medio_comunicacion', '=', 'medio_comunicacion.meco_id_medio_comunicacion')
                ->where('solicitud_abstracta.soab_id_solicitud_abstracta', '=', $id)
                ->first();


            $solicitud = DB::table('solicitud_cta_colaboradora')
                ->join('medio_comunicacion', 'solicitud_cta_colaboradora.soco_id_medio_comunicacion', '=', 'medio_comunicacion.meco_id_medio_comunicacion')
                ->where('solicitud_cta_colaboradora.soco_id_solicitud_abstracta', '=', $id)
                ->get();

            $otraapp = DB::table('otra_app')
                ->join('solicitud_abstracta', 'solicitud_abstracta.soab_id_solicitud_abstracta', '=', 'otra_app.otap_id_solicitud_abstracta')
                ->where('otra_app.otap_id_solicitud_abstracta', '=', $id)
                ->get();

            $otrocampo = DB::table('otro_campo_trabajo')
                ->join('solicitud_abstracta', 'solicitud_abstracta.soab_id_otro_campo', '=', 'otro_campo_trabajo.otca_id_otro_campo')
                ->where('solicitud_abstracta.soab_id_solicitud_abstracta', '=', $id)
                ->first();

            return array($solicitudabstracta, $dependencias_catalogo, $grado, $campotrabajo, $meco, $solicitud, $otraapp, $otrocampo);



    }


}
	
	






