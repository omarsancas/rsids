<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 10/09/14
 * Time: 01:00 PM
 */

class AplicacionController extends BaseController {

    public function ver()
    {

        return View::make('registro/apps');
    }


    public function registrer()
    {



        $datos=Input::get('aplicaciones');

        dd($datos);

        /*
        $datos = new Proyecto;


        $datos->soab_nombres = Input::get('nombre');
        $datos->soab_ap_paterno =Input::get('apellidoPaterno');
        $datos->soab_ap_materno = Input::get('apellidoMaterno');
        $datos->soab_sexo = Input::get('sexo');
        $datos->SOAB_ID_DEPENDENCIA = Input::get('dependencias');
        $datos->soab_hrs_cpu = Input::get('horasCPU');
        $datos->soab_esp_hd = Input::get('disco');
        $datos->soab_mem_ram = Input::get('memoria');
        $datos->save();

        $proyecto = Proyecto::find(4);
        $proyecto->aplicaciones()->sync(array(Input::get('aplicaciones')));


        $rules = [

            'nombre' => 'required',
            'apellidoPaterno' => 'required',
            'apellidoMaterno' => 'required',
            'sexo' => 'required'

        ];

        //$validation = Validator::make($datos,$rules);



		$file = Input::file('pdf1');



     		$destinationPath    = 'uploads/images/'; // The destination were you store the image.
   			$filename           = $file->getClientOriginalName(); // Original file name that the end user used for it.
		   //$mime_type          = $file->getMimeType(); // Gets this example image/png
		   	$extension          = $file->getClientOriginalExtension(); // The original extension that the user used
		   	$upload_success     = $file->move($destinationPath, $filename); // Now we move the file to its new home.

		   	$datos->archivoTrabAcademico = $upload_success;





        */

    }



    public function create() {

        // queries the clients db table, orders by client_name and lists client_name and id


        //$dependencias_catalogo = DB::table('dependencias')->orderBy('nombre_dependencia', 'asc')->lists('nombre_dependencia','id_dependencia');
        $dependencias_catalogo =Dependencia::lists('depe_nombre','depe_id_dependencia');
        $aplicaciones =Aplicacion::lists('apli_nombre','apli_id_aplicacion');
        return View::make('registro.apps')->with('dependencias_catalogo',$dependencias_catalogo)->with('aplicaciones',$aplicaciones);


    }












} 