<?php

class SolicitudController extends BaseController {


    /**
     * Obtiene de la BD los catálogos para formar la vista del formulario generar solicitud
     * @return mixed
     */
    public function mostrarSolicitud()
    {

        // queries the clients db table, orders by client_name and lists client_name and id

        $aplicaciones = Aplicacion::lists('apli_nombre', 'apli_id_aplicacion');
        $dependencias_catalogo = Dependencia::lists('depe_nombre', 'depe_id_dependencia');
        $campotrabajo = CampoTrabajo::lists('catr_nombre_campo', 'catr_id_campo_trabajo');
        $grado = Grado::lists('grad_nombre', 'grad_id_grado');


        return View::make('registro.solicitud')->with('dependencias_catalogo', $dependencias_catalogo)->with('aplicaciones', $aplicaciones)->with('grado', $grado)->with('campos', $campotrabajo);


    }


    /**
     * Inserta en la BD los datos de la solicitud de registros
     * @return mixed
     */
    public function generarSolicitud()
    {
        $datos = Input::all();


        $rules = array(
            'nombre'               => 'required|alpha',
            'apellidoPaterno'      => 'required|alpha',
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
                ->withErrors($validator)->withInput(Input::except('curriculum', 'constancias', 'documentodescriptivo'));;
        } else
        {


            $datos = new SolicitudAbstracta;
            $datos->soab_nombres = Input::get('nombre');
            $datos->soab_ap_paterno = Input::get('apellidoPaterno');
            $datos->soab_ap_materno = Input::get('apellidoMaterno');
            $datos->soab_id_estado_solicitud = 0;
            $datos->soab_id_tipo_solicitud = 0;
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
            $otraappDatos = array_slice($dataapp, 1);


            foreach ((array_slice($dataapp, 1)) as $otraapData)
            {
                $otraap = new OtraAplicacion($otraapData);
                $datos->otraaplicacion()->save($otraap);
            }


            $datoscuentacol = Input::get('solcol');
            //var_dump($datoscuentacol);
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


            $file = Input::file('curriculum');
            $destinationPath = public_path() . '/uploads';
            // If the uploads fail due to file system, you can try doing public_path().'/uploads'
            /** @var $filename1 TYPE_NAME */
            $filename1 = str_random(6) . time() . '.' . Input::file('curriculum')->getClientOriginalExtension();
            $upload_success = Input::file('curriculum')->move($destinationPath, $filename1);

            $file1 = Input::file('documentodescriptivo');
            // If the uploads fail due to file system, you can try doing public_path().'/uploads'
            $filename2 = str_random(6) . time() . '.' . Input::file('documentodescriptivo')->getClientOriginalExtension();
            $upload_success2 = Input::file('documentodescriptivo')->move($destinationPath, $filename2);

            $file2 = Input::file('constancias');
            // If the uploads fail due to file system, you can try doing public_path().'/uploads'
            $filename3 = str_random(6) . time() . '.' . Input::file('constancias')->getClientOriginalExtension();
            $upload_success3 = Input::file('constancias')->move($destinationPath, $filename3);


            if ($upload_success)
            {
                $datos->soab_curriculum = 'uploads/' . $filename1;
                $datos->soab_desc_proyecto = 'uploads/' . $filename2;
                $datos->soab_con_adscripcion = 'uploads/' . $filename3;
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
        Session::flash('message', '¡Las solicitudes se han borrado exitosamente!');

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
            ->get();

        return View::make('gestionarsolicitudderecursos.modificarsolicitud')->with('solicitudes', $solicitudes);
    }


    /**
     * Obtiene los datos de la BD y genera la vista de consultar solicitud
     * @return mixed
     */
    public function consultarSolicitud()
    {

        $solicitudes = DB::table('solicitud_abstracta')
            ->join('tipo_solicitud', 'solicitud_abstracta.soab_id_tipo_solicitud', '=', 'tipo_solicitud.tiso_id_tipo_solicitud')
            ->get();

        return View::make('gestionarsolicitudderecursos.consultarsolicitud')->with('solicitudes', $solicitudes);
    }


    /**
     * Obtiene los datos de la solicitud y regresa la vista con los datos de la solicitud seleccionada para su actualización
     * @param $id
     * @return mixed
     */
    public function editarSolicitud($id)
    {

        $solicitudabstracta = SolicitudAbstracta::find($id);
        //dd($solicitudabstracta->SOAB_ID_SOLICITUD_RENOVACION);
        /*Esta funcion de empty es para que cuando se implemente la solicitud de renovacion se pueda cambiar de vista*/
        if(empty($solicitudabstracta->SOAB_ID_SOLICITUD_RENOVACION))
        {

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

        $otrocampo = DB::table('otro_campo')
            ->join('solicitud_abstracta', 'solicitud_abstracta.soab_id_otro_campo', '=', 'otro_campo.otca_id_otro_campo')
            ->where('solicitud_abstracta.soab_id_solicitud_abstracta', '=', $id)
            ->first();

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
    }

    /**
     * Obtiene los datos de la solicitud y regresa la vista con los datos de la solicitud seleccionada para consultar la solicitud
     * @param $id
     * @return mixed
     */
    public function consultarSolicitudVista($id)
    {

        $solicitudabstracta = SolicitudAbstracta::find($id);
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

        $otrocampo = DB::table('otro_campo')
            ->join('solicitud_abstracta', 'solicitud_abstracta.soab_id_otro_campo', '=', 'otro_campo.otca_id_otro_campo')
            ->where('solicitud_abstracta.soab_id_solicitud_abstracta', '=', $id)
            ->first();

        // Show form
        return View::make('gestionarsolicitudderecursos.consultarsolicitudvista', $this->data)
            ->with('cuentascol', $solicitud)->with('solicitudabstracta', $solicitudabstracta)
            ->with('grado', $grado)
            ->with('dependencias_catalogo', $dependencias_catalogo)
            ->with('otrocampo', $otrocampo)
            ->with('otraapp', $otraapp)
            ->with('campotrabajo', $campotrabajo)
            ->with('meco', $meco);
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
        $solicitudabstracta->soab_id_estado_solicitud = 0;
        $solicitudabstracta->soab_id_tipo_solicitud = 0;
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


        $datoscuentacol = Input::get('solcol');
        $datosotraapp = Input::get('otraapp');


        if (Input::hasFile('curriculum'))
        {
            $archivo = $solicitudabstracta->SOAB_CURRICULUM;
            File::delete(public_path(). '/' . $archivo );
            $destinationPath = public_path() . '/uploads';
            /** @var $filename1 TYPE_NAME */
            $filename1 = str_random(6) . time() . '.' . Input::file('curriculum')->getClientOriginalExtension();
            $upload_success = Input::file('curriculum')->move($destinationPath, $filename1);


            if ($upload_success)
            {
                $solicitudabstracta->soab_curriculum = 'uploads/' . $filename1;
                $solicitudabstracta->save();
            }
        }


        if (Input::hasFile('docdesc'))
        {
            $archivo = $solicitudabstracta->SOAB_DESC_PROYECTO;
            File::delete(public_path(). '/' . $archivo );
            $destinationPath = public_path() . '/uploads';
            /** @var $filename1 TYPE_NAME */
            $filename2 = str_random(6) . time() . '.' . Input::file('docdesc')->getClientOriginalExtension();
            $upload_success = Input::file('docdesc')->move($destinationPath, $filename2);


            if ($upload_success)
            {
                $solicitudabstracta->soab_desc_proyecto = 'uploads/' . $filename2;
                $solicitudabstracta->save();
            }
        }


        if (Input::hasFile('constancias'))
        {
            $archivo = $solicitudabstracta->SOAB_CON_ADSCRIPCION;
            File::delete(public_path(). '/' . $archivo );
            $destinationPath = public_path() . '/uploads';
            /** @var $filename1 TYPE_NAME */
            $filename3 = str_random(6) . time() . '.' . Input::file('constancias')->getClientOriginalExtension();
            $upload_success = Input::file('constancias')->move($destinationPath, $filename3);


            if ($upload_success)
            {
                $solicitudabstracta->soab_con_adscripcion = 'uploads/' . $filename3;
                $solicitudabstracta->save();
            }
        }

        //var_dump($datosotraapp);
        //$datosOtraApp = array_slice($datosotraapp,1);
        //$datosMecoCuentasCol = Input::get('meco');

        //$cuentacol = $datoscuentacol;
        //$mecocuentascol = array_slice($datosMecoCuentasCol,1);

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
        $solicitudes = DB::table('solicitud_abstracta')
            ->join('dependencia', 'solicitud_abstracta.soab_id_dependencia', '=', 'dependencia.depe_id_dependencia')
            ->join('grado', 'solicitud_abstracta.soab_id_grado', '=', 'grado.grad_id_grado')
            ->where('solicitud_abstracta.soab_id_solicitud_abstracta', '=', $id)
            ->first();


        $html = View::make('gestionarsolicitudderecursos.generarcarta')->with('solicitudes', $solicitudes)->render();

        return PDF::load($html, 'A4', 'portrait')->show();
    }


    /**
     * Regresa la vista de las solicitudes para generar cartas
     * @return mixed
     */
    public function mostrarSolicitudes()
    {

        $solicitudes = DB::table('solicitud_abstracta')
            ->join('tipo_solicitud', 'solicitud_abstracta.soab_id_tipo_solicitud', '=', 'tipo_solicitud.tiso_id_tipo_solicitud')
            ->where('solicitud_abstracta.soab_id_estado_solicitud', '=', 1)
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
            ->join('tipo_solicitud', 'solicitud_abstracta.soab_id_tipo_solicitud', '=', 'tipo_solicitud.tiso_id_tipo_solicitud')
            ->where('solicitud_abstracta.soab_id_estado_solicitud', '=', 1)
            ->get();

        return View::make('gestionarsolicitudderecursos.notificaraprobacion')->with('solicitudes', $solicitudes);
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
            ->join('medio_comunicacion', 'solicitud_abstracta.soab_id_medio_comunicacion', '=', 'medio_comunicacion.meco_id_medio_comunicacion')
            ->join('grado', 'solicitud_abstracta.soab_id_grado', '=', 'grado.grad_id_grado')
            ->where('solicitud_abstracta.soab_id_solicitud_abstracta', '=', $id)
            ->first();

        $correelectronico = $solicitudes->MECO_CORREO;


        $html = View::make('gestionarsolicitudderecursos.generarcarta')->with('solicitudes', $solicitudes)->render();


        $outputName = str_random(10); // str_random is a [Laravel helper](http://laravel.com/docs/helpers#strings)
        $pdfPath = public_path() . '/' . $outputName . '.pdf';
        File::put($pdfPath, PDF::load($html, 'A4', 'portrait')->output());

        $data = ['msg' => 'hola'];
        Mail::send('emails.welcome', $data, function ($message) use ($pdfPath, $correelectronico)
        {
            $message->from('moroccosc@gmail.com', 'Laravel');
            $message->to($correelectronico);
            $message->attach($pdfPath);
        });
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
        $file = public_path() . '/' . $rutaarchivo;
        return Response::download($file);

        //return Redirect::to('');

    }


    public function mostrarDocumentoDesc($id)
    {

        $solicitud = SolicitudAbstracta::find($id);
        $rutaarchivo = $solicitud->SOAB_DESC_PROYECTO;
        $file = public_path() . '/' . $rutaarchivo;
        return Response::download($file);

        //return Redirect::to('');

    }


    public function mostrarConstancia($id)
    {

        $solicitud = SolicitudAbstracta::find($id);
        $rutaarchivo = $solicitud->SOAB_CON_ADSCRIPCION;
        $file = public_path() . '/' . $rutaarchivo;
        return Response::download($file);

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


}
	
	






