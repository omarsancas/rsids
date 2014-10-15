<?php

class SolicitudController extends BaseController {

    public function registro()
    {

        return View::make('registro/solicitud');
    }


    public function registrar()
    {
        $datos = Input::all();


        $rules = array(
            'nombre'          => 'required',
            'apellidoPaterno' => 'required',
            'apellidoMaterno' => 'required',
            'email'           => 'required|email',
            'documentodescriptivo' => 'required|mimes:pdf|max:8000',//para activar esta característica de validación de laravel se necesita aumentar el tamaño en el php.ini en upload_file de acuerdo a sus necesidades
            'constancias' => 'required|mimes:pdf|max:8000',
            'curriculum' => 'required|mimes:pdf|max:8000',


        );


        $mensajes = array(
            'required' => ' El :attribute es obligatorio',
            'mimes'    => 'El archivo :attribute archivo debe de ser pdf',
            'max'   => 'El archivo :attribute no debe de pasar los 8MB'


        );

        // do the validation ----------------------------------
        // validate against the inputs from our form
        $validator = Validator::make(Input::all(), $rules, $mensajes);

        $dataapp = Input::get('otraapp');
        foreach ((array_slice($dataapp, 1)) as $otraapData)
        {
            $otraap = new OtraAplicacion($otraapData);
            $datos->otraaplicacion()->save($otraap);
        }




               // check if the validator failed -----------------------;
        if ($validator->fails())
        {




            $messages = $validator->messages();

            // redirect our user back to the form with the errors from the validator
            return Redirect::to('solicitud')
                ->withErrors($validator)->withInput(Input::except('curriculum','constancias','documentodescriptivo'));;
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
            $datos->soab_id_medio_comunicacion = $mediocomunicacion->meco_id_medio_comunicacion;
            $datos->save();




            $otrocampo = new OtroCampo();
            $otrocampo->otca_nombre = Input::get('otrocampo');
            $otrocampo->save();
            $datos->soab_id_otro_campo = $otrocampo->otca_id_otro_campo;
            $datos->save();


            $dataapp = Input::get('otraapp');
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
                $solcol->soco_id_medio_comunicacion = $mecoCol->meco_id_medio_comunicacion;
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


            /*
            $file = Input::file('pdf1');



                 $destinationPath    = 'uploads/images/'; // The destination were you store the image.
                   $filename           = $file->getClientOriginalName(); // Original file name that the end user used for it.
               //$mime_type          = $file->getMimeType(); // Gets this example image/png
                   $extension          = $file->getClientOriginalExtension(); // The original extension that the user used
                   $upload_success     = $file->move($destinationPath, $filename); // Now we move the file to its new home.

                   $datos->archivoTrabAcademico = $upload_success;

            */

        }


    }


    public function create()
    {

        // queries the clients db table, orders by client_name and lists client_name and id


        //$dependencias_catalogo = DB::table('dependencias')->orderBy('nombre_dependencia', 'asc')->lists('nombre_dependencia','id_dependencia');
        $aplicaciones = Aplicacion::lists('apli_nombre', 'apli_id_aplicacion');
        $dependencias_catalogo = Dependencia::lists('depe_nombre', 'depe_id_dependencia');
        $campotrabajo = CampoTrabajo::lists('catr_nombre_campo','catr_id_campo_trabajo');
        $grado = Grado::lists('grad_nombre', 'grad_id_grado');


        return View::make('registro.solicitud')->with('dependencias_catalogo', $dependencias_catalogo)->with('aplicaciones', $aplicaciones)->with('grado', $grado)->with('campos',$campotrabajo);


    }


}
	
	






