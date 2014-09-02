<?php

class SolicitudController extends BaseController{

	public function registro()
	{

		return View::make('registro/solicitud-recursos');
	}


	public function registrar()
	{
		$data = Input::all();


			$datos = new Proyecto;

			
            $datos->nombre = Input::get('nombre');
            $datos->apellidoPaterno =Input::get('apellidoPaterno');
            $datos->apellidoMaterno = Input::get('apellidoMaterno');
            $datos->email =Input::get('email');
            $datos->sexo = Input::get('sexo');            
            $datos->numeroTelefonico = Input::get('telefono');
            $datos->extension = Input::get('extension');
            $datos->dependencia = Input::get('size');
            $datos->horasCPU = Input::get('horasCPU');
            $datos->disco = Input::get('disco');
            $datos->memoria = Input::get('memoria');

		


		$rules = [

			'nombre' => 'required',
			'apellidoPaterno' => 'required',
			'apellidoMaterno' => 'required',
			'sexo' => 'required',
			'telefono' => 'required',
			'extension' => 'required',
			'email' => 'required|email|'

		];

		$validation = \Validator::make($data,$rules);



		$file = Input::file('pdf1');


 
     		$destinationPath    = 'uploads/images/'; // The destination were you store the image.
   			$filename           = $file->getClientOriginalName(); // Original file name that the end user used for it.
		   //$mime_type          = $file->getMimeType(); // Gets this example image/png
		   	$extension          = $file->getClientOriginalExtension(); // The original extension that the user used 
		   	$upload_success     = $file->move($destinationPath, $filename); // Now we move the file to its new home.

		   	$datos->archivoTrabAcademico = $upload_success;

		   	$datos->save();




	}

	

	public function create() {

  // queries the clients db table, orders by client_name and lists client_name and id

  	
  	//$dependencias_catalogo = DB::table('dependencias')->orderBy('nombre_dependencia', 'asc')->lists('nombre_dependencia','id_dependencia');
  	$dependencias_catalogo =Dependencia::lists('nombre_dependencia','id_dependencia');
  	$aplicaciones =Aplicacion::lists('nombre_aplicacion','id_aplicacion');
    return View::make('registro.solicitud-recursos')->with('dependencias_catalogo',$dependencias_catalogo)->with('aplicaciones',$aplicaciones);

    
	}

	
	}
	
	

?>




