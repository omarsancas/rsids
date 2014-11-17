<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 15/10/14
 * Time: 11:13 AM
 */
use League\Csv\Reader;
use \Hackzilla\PasswordGenerator\Generator\ComputerPasswordGenerator;

class EvaluarSolicitudController extends BaseController {

    public function listarSolicitudes()
    {

        $solicitudes = DB::table('solicitud_abstracta')
            ->join('tipo_solicitud', 'solicitud_abstracta.soab_id_tipo_solicitud', '=', 'tipo_solicitud.tiso_id_tipo_solicitud')
            ->where('solicitud_abstracta.soab_id_estado_solicitud', '=', 1)
            //->where('solicitud_abstracta.soab_es_proyecto', '=' , 0)
            ->get();

        return View::make('evaluarsolicitudderecursos/evaluarsolicitud')->with('solicitudes', $solicitudes);
    }


    public function aceptar($id)
    {

        $solicitudabstracta = SolicitudAbstracta::find($id);
        //dd($solicitudabstracta->SOAB_ID_SOLICITUD_RENOVACION);
        /*Esta funcion de empty es para que cuando se implemente la solicitud de renovacion se pueda cambiar de vista*/


        $dependencias_catalogo = Dependencia::lists('depe_nombre', 'depe_id_dependencia');
        $grado = Grado::lists('grad_nombre', 'grad_id_grado');
        $campotrabajo = CampoTrabajo::lists('catr_nombre_campo', 'catr_id_campo_trabajo');
        $tipoproyecto = TipoProyecto::lists('tipr_nombre_tipo_proyecto','tipr_id_tipo_proyecto');
        $anio = Anio::lists('ANIO_ID','ANIO');
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




        // Show form
        return View::make('evaluarsolicitudderecursos.aceptarsolicitud', $this->data)
            ->with('cuentascol', $solicitud)
            ->with('solicitudabstracta', $solicitudabstracta)
            ->with('grado', $grado)
            ->with('numerocuentascol', $cuentascol)
            ->with('dependencias_catalogo', $dependencias_catalogo)
            ->with('otrocampo', $otrocampo)
            ->with('otraapp', $otraapp)
            ->with('campotrabajo', $campotrabajo)
            ->with('meco', $meco)
            ->with('tipoproyecto',$tipoproyecto)
            ->with('anio',$anio);


    }


    public function rechazar($id)
    {
        $solicitudabstracta = SolicitudAbstracta::find($id);

        return View::make('evaluarsolicitudderecursos.rechazarsolicitud')
            ->with('solicitudabstracta', $solicitudabstracta);
    }

    public function rechazarSolicitud()
    {
        $id = Input::get('id');
        $solicitudabstracta = SolicitudAbstracta::find($id);
        $solicitudabstracta->soab_id_estado_solicitud = 3;
        $solicitudabstracta->soab_desc_rechazo = Input::get('descrechazo');
        $solicitudabstracta->save();

        Session::flash('message', '¡La solicitud se ha rechazado exitosamente!');

        return Redirect::to('evaluarsolicitudderecursos/evaluarsolicitud');
    }


    public function prueba()
    {
        $moved = public_path() . '/uploads/contabilidad1.txt';

        //DB::table('wc_program_1')->truncate();

        $csv = new Reader($moved);
        $csv->setOffset(0); //because we don't want to insert the header
        $nbInsert = $csv->each(function ($row) use (&$sth)
        {
            DB::table('contabilidad')->insert(
                array(

                    'cont_id_usuario' => (isset($row[0]) ? $row[0] : ''),
                    'cont_num_jobs'   => (isset($row[1]) ? $row[1] : ''),
                    'cont_hrs_nodo' => (isset($row[2]) ? $row[2] : '')
                ));

            return true;
        });

        return Response::json('success', 200);


    }


    public function actualizarAceptarSolicitud()
    {

        $id = Input::get('id');


        $rules = array(
            'usua_id_usuario'        => 'required|unique:Usuario',


        );

        //validacion para inputs dinámicamente
        //foreach (Input::get('cuentacolaboradora') as $key => $val)(
        //$rules["usua_id_usuario"] = array( "unique:Usuario")
             //   );


        $mensajes = array(
            'required' => ' El campo :attribute es obligatorio',
            'mimes'    => 'El archivo :attribute archivo debe de ser pdf',
            'max'      => 'El archivo :attribute no debe de pasar los 8MB',
            'horasCPU.max'=> 'Las horas cpu no deben sobrepasar las 5000000 de horas',
            'numeric' => ' El campo :attribute solo debe contener números',

        );

        $validator = Validator::make(Input::all(), $rules, $mensajes);

        if ($validator->fails())
        {


            $messages = $validator->messages();

            // redirect our user back to the form with the errors from the validator
            return Redirect::route('aceptar',$id)
                ->withErrors($validator)->withInput(Input::except('curriculum', 'constancias', 'documentodescriptivo'));
        } else
        {


        $solicitudabstracta = SolicitudAbstracta::find($id);
        $solicitudabstracta->soab_nombres = Input::get('nombre');
        $solicitudabstracta->soab_ap_paterno = Input::get('apellidoPaterno');
        $solicitudabstracta->soab_ap_materno = Input::get('apellidoMaterno');
        $solicitudabstracta->soab_id_estado_solicitud = 2;
        $solicitudabstracta->soab_es_proyecto = 1;
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
            $destinationPath = $solicitudabstracta->SOAB_RUTA_ARCHVIVOS;
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
            $destinationPath = $solicitudabstracta->SOAB_RUTA_ARCHVIVOS;
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
            $destinationPath = $solicitudabstracta->SOAB_RUTA_ARCHVIVOS;
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
            $solcol->soco_id_estado_colaboradora = 2;
            $solcol->save();
        }


        foreach (Input::get('meco', array()) as $id => $solcolData)
        {
            $meco = MedioComunicacion::find($id);
            $meco->update($solcolData);
            $meco->save();
        }

        $anio = Input::get('anio');
        $tipoproyecto = Input::get('tipoproyecto');
        if($tipoproyecto == 1)
        {
             $tipoproyectocomp = 'S';
        }else{

            $tipoproyectocomp = 'I';
        }

        $convocatoria =  Input::get('convocatoria');
        $passwordtitular = $this->generarPassword();
        $esproyecto = new Proyecto;
        $esproyecto->proy_id_solicitud_abstracta = $solicitudabstracta->SOAB_ID_SOLICITUD_ABSTRACTA;
        $esproyecto->proy_id_tipo_proyecto = Input::get('tipoproyecto');
        $esproyecto->proy_hrs_aprobadas = Input::get('horasaprobadas');
        $esproyecto->proy_nombre = Input::get('nombreproyecto');
        $esproyecto->proy_id_compuesto = 'SC'.$anio.$convocatoria.'-'.$tipoproyectocomp.'-'.$solicitudabstracta->SOAB_ID_SOLICITUD_ABSTRACTA;
        $esproyecto->proy_id_estado_proyecto = 1;
        $esproyecto->save();

        $idlog = Input::get('id');
        $solicitudabs = SolicitudAbstracta::find($idlog);
        $nombre = $solicitudabs->SOAB_NOMBRES;
        $appaterno = $solicitudabs->SOAB_AP_PATERNO;
        $apmaterno = $solicitudabs->SOAB_AP_MATERNO;
        $usua_nombre_concatenado = $nombre . ' '. $appaterno  .' '. $apmaterno;

        $usuario = new Usuario;
        $usuariotitular = Input::get('usua_id_usuario');
        $usuario->usua_id_usuario = $usuariotitular;
        $usuario->usua_id_tipo_usuario = 2;
        $usuario->password = Hash::make($passwordtitular);
        $usuario->usua_nom_completo = $usua_nombre_concatenado;
        $usuario->usua_id_proyecto = $esproyecto->PROY_ID_PROYECTO;
        $usuario->save();


        $passwordvpn = $this->generarPassword();
        $nombre_login1 = $nombre . '_' . $appaterno . '_' . $apmaterno;
        $nombre_login1 = $this->quitarAcentos($nombre_login1);
        $grupo = substr($usuariotitular, 0, 2);


        $vpn = new Vpn;
        $cuentatitular = Input::get('usua_id_usuario');
        $vpn->vplo_login = $cuentatitular;
        $vpn->vplo_password = $passwordvpn;
        $vpn->vplo_nombre = $nombre_login1;
        $vpn->vplo_grupo_principal = $grupo . '_' . 'g';
        $vpn->save();

        $passwordmaquinatitular = $this->generarPassword();
        $maquina = new Maquina();
        $cuentatitular = Input::get('usua_id_usuario');
        $maquina->malo_login = $cuentatitular;
        $maquina->malo_password = $passwordmaquinatitular;
        $maquina->malo_nombre = $nombre_login1;
        $maquina->malo_grupo_principal = $grupo . '_' . 'g';
        $maquina->save();

        $aplicacionesseleccionadas = $solicitudabs->aplicaciones()->orderBy('soap_id_aplicacion', 'ASC')->get()->toArray();
        $aplicacionesseleccionadas = array_pluck($aplicacionesseleccionadas, 'APLI_ID_APLICACION');
        $dependencia = DB::table('solicitud_abstracta')
            ->join('dependencia', 'solicitud_abstracta.soab_id_dependencia', '=', 'dependencia.depe_id_dependencia')
            ->where('solicitud_abstracta.soab_id_solicitud_abstracta', '=', $idlog)
            ->first();

        //dd($aplicacionesseleccionadas);

        $this->obtenerGrupoSecundario($dependencia, $aplicacionesseleccionadas, $vpn);
        $cuentascolaboradora = Input::get('cuentacolaboradora');

        if(!empty($cuentascolaboradora))
        {
            foreach ($cuentascolaboradora as $id => $cuentacol)
            {

                $usrcol = Cuentacol::find($id);
                $nombre = $usrcol->SOCO_NOMBRES;
                $appaterno = $usrcol->SOCO_AP_PATERNO;
                $apmaterno = $usrcol->SOCO_AP_MATERNO;

                $usua_nombre_concatenado = $nombre . ' ' . $appaterno . ' ' . $apmaterno;
                $password = $this->generarPassword();
                $usuariocol = new Usuario();
                $usuariocol->usua_id_usuario = $cuentacol;
                $usuariocol->usua_id_tipo_usuario = 3;
                $usuariocol->usua_id_proyecto = $esproyecto->PROY_ID_PROYECTO;
                $usuariocol->password = Hash::make($password);
                $usuariocol->usua_nom_completo = $usua_nombre_concatenado;
                $usuariocol->save();

                $nombre_login1 = $nombre . '_' . $appaterno . '_' . $apmaterno;
                $nombre_login1 = $this->quitarAcentos($nombre_login1);

                $passwordvpn = $this->generarPassword();
                $vpncol = new Vpn;
                $vpncol->vplo_login = $cuentacol;
                $vpncol->vplo_password = $passwordvpn;
                $vpncol->vplo_nombre = $nombre_login1;
                $vpncol->vplo_grupo_principal = $grupo . '_' . 'g';
                $vpncol->save();

                $passwordmaquina = $this->generarPassword();
                $maquinacol = new Maquina();
                $maquinacol->malo_login = $cuentacol;
                $maquinacol->malo_password = $passwordmaquina;
                $maquinacol->malo_nombre = $nombre_login1;
                $maquinacol->malo_grupo_principal = $grupo . '_' . 'g';
                $maquinacol->save();
            }
        }





        Session::flash('message', '¡La solicitud se ha aceptado exitosamente!');

        return Redirect::to('evaluarsolicitudderecursos/evaluarsolicitud');
        //$queries = DB::getQueryLog();
        //var_dump($queries);

        }
    }



    /**
     * @return array
     */
    public function generarPassword()
    {
        $generator = new ComputerPasswordGenerator();
        $generator->setOptions(ComputerPasswordGenerator::OPTION_UPPER_CASE
            | ComputerPasswordGenerator::OPTION_LOWER_CASE
            | ComputerPasswordGenerator::OPTION_NUMBERS
            | ComputerPasswordGenerator::OPTION_SYMBOLS
            | ComputerPasswordGenerator::OPTION_AVOID_SIMILAR);
        $generator->setLength(12);
        $password = $generator->generatePassword();

        return $password;
    }

    /**
     * @param $dependencia
     * @param $aplicacionesseleccionadas
     * @param $vpn
     */
    public function obtenerGrupoSecundario($dependencia, $aplicacionesseleccionadas, $vpn)
    {
        if ($dependencia->DEPE_ID_TIPO_DEPENDENCIA == 1)
        {
            foreach ($aplicacionesseleccionadas as $aplicacion)
            {
                if ($aplicacion == 9)
                {
                    foreach ($aplicacionesseleccionadas as $aplicaciones2)
                    {
                        if ($aplicaciones2 == 14 )
                        {
                            $vpn->vplo_grupo_secundario = 'g009,g001';
                            $vpn->save();
                            break;

                        }
                    }

                    $vpn->vplo_grupo_secundario = 'g009';
                    $vpn->save();
                    break;
                } elseif ($aplicacion == 14)
                {
                    $vpn->vplo_grupo_secundario = 'g001';
                    $vpn->save();
                    break;
                }
            }
        }
    }


}