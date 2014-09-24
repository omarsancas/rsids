<?php

class SolicitudController extends BaseController {

    public function registro()
    {

        return View::make('registro/solicitud');
    }


    public function registrar()
    {
        $datos = Input::all();

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
        $datos->soab_desc_proyecto = Input::get('descproyecto');
        $datos->SOAB_ID_DEPENDENCIA = Input::get('dependencias');
        $datos->soab_id_grado = Input::get('grado');
        $datos->soab_hrs_cpu = Input::get('horasCPU');
        $datos->soab_esp_hd = Input::get('disco');
        $datos->soab_mem_ram = Input::get('memoria');
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

        $lineaespecializacion = new LineaEspecializacion();
        $lineaespecializacion->lies_nombre = Input::get('lineaesp');
        $lineaespecializacion->save();
        $datos->soab_ide_linea_especializacion = $lineaespecializacion->lies_ide_linea_especializacion;
        $datos->save();


        $modelocomputacional = new ModeloComputacional();
        $modelocomputacional->moco_nombre = Input::get('modelocomp');
        $modelocomputacional->save();
        $datos->soab_id_modelo = $modelocomputacional->moco_id_modelo;
        $datos->save();


        $dataapp = Input::get('otraapp');
        foreach ((array_slice($dataapp, 1)) as $otraapData)
        {
            $otraap = new OtraAplicacion($otraapData);
            $datos->otraaplicacion()->save($otraap);
        }


        $data = Input::get('solcol');
        foreach ((array_slice($data, 1)) as $solcolData)
        {

            $solcol = new Cuentacol($solcolData);
            $datos->cuentascol()->save($solcol);
        }


        $rules = [

            'nombre'          => 'required',
            'apellidoPaterno' => 'required',
            'apellidoMaterno' => 'required',
            'sexo'            => 'required'

        ];

        //$validation = Validator::make($datos,$rules);


        $file = Input::file('pdf1');
        $destinationPath = public_path() . '/uploads';

        // If the uploads fail due to file system, you can try doing public_path().'/uploads'
        $filename = str_random(12) . '.' . Input::file('pdf1')->getClientOriginalExtension();
        //$filename = $file->getClientOriginalName();
        //$extension =$file->getClientOriginalExtension();
        $upload_success = Input::file('pdf1')->move($destinationPath, $filename);


        if ($upload_success)
        {
            $datos->soab_curriculum = 'uploads/' . $filename;
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


    public function create()
    {

        // queries the clients db table, orders by client_name and lists client_name and id


        //$dependencias_catalogo = DB::table('dependencias')->orderBy('nombre_dependencia', 'asc')->lists('nombre_dependencia','id_dependencia');
        $dependencias_catalogo = Dependencia::lists('depe_nombre', 'depe_id_dependencia');
        $aplicaciones = Aplicacion::lists('apli_nombre', 'apli_id_aplicacion');
        $grado = Grado::lists('grad_nombre', 'grad_id_grado');


        return View::make('registro.solicitud')->with('dependencias_catalogo', $dependencias_catalogo)->with('aplicaciones', $aplicaciones)->with('grado', $grado);


    }


}
	
	






