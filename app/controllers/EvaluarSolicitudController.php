<?php
/**
 *
 * User: Omar
 * Date: 15/10/14
 * Time: 11:13 AM
 * Clase que implementa todos los métodos del caso de uso evaluar solicitud
 */
use League\Csv\Reader;


class EvaluarSolicitudController extends BaseController {

    /**
     *Obtiene todas las solicitudes pendientes de evaluacion del periodo
     *
     *
     *Output:
     * $solicitudes @object es un objeto que contiene un conjunto de solicitudes pendientes
     * Ejemplo:
     * $this->listarSolicitudes()
     * $solicitudes->NOMBRE_PROYECTO
     * #=>Machine Learnng
     * return  @mixed
     */

    public function listarSolicitudes()
    {

        $solicitudes = DB::table('solicitud_abstracta')
            ->join('tipo_solicitud', 'solicitud_abstracta.soab_id_tipo_solicitud', '=', 'tipo_solicitud.tiso_id_tipo_solicitud')
            ->where('solicitud_abstracta.soab_id_estado_solicitud', '=', 1)
            //->where('solicitud_abstracta.soab_es_proyecto', '=' , 0)
            ->get();

        return View::make('evaluarsolicitudderecursos/evaluarsolicitud')->with('solicitudes', $solicitudes);
    }

    /**
     * Muestra los datos de la solicitud que se va a aceptar
     * Parametros:
     * @param de $id
     * @return
     * @internal param \de $id la solicitud a la que se va a asignar el proyecto
     *
     *Output: $solicitudabstracta @object es un conjunto de todos los datos de una solicitud abstracta
     *        $this->data @object son todas las aplicaciones seleccionadas por el usuario
     *        $dependencias_catalogo, $grado, $campotrabajo, $tipoproyecto, $anio @object: Estas variables son los catalogos de sus tablas respectivas
     *        $cuentascol @object es un objecto que contiene un conjunto de solicitudes de cuentas colaboradoras asociadas a la solicitud abstracta
     *        $mediocomunicacion_solabs @object es un objeto que contiene los datos del medio de comunicación de la solicitud abstracta
     *Ejemplo:
     *
     * $this->aceptar()
     *
     * return @mixed
     */
    public function aceptar($id)
    {

        $solicitudabstracta = SolicitudAbstracta::find($id);
        //dd($solicitudabstracta->SOAB_ID_SOLICITUD_RENOVACION);
        /*Esta funcion de empty es para que cuando se implemente la solicitud de renovacion se pueda cambiar de vista*/


        $dependencias_catalogo = Dependencia::lists('depe_nombre', 'depe_id_dependencia');
        $grado_catalogo = Grado::lists('grad_nombre', 'grad_id_grado');
        $campotrabajo_catalogo = CampoTrabajo::lists('catr_nombre_campo', 'catr_id_campo_trabajo');
        $tipoproyecto_catalogo = TipoProyecto::lists('tipr_nombre_tipo_proyecto', 'tipr_id_tipo_proyecto');
        $anio = Anio::lists('ANIO_ID', 'ANIO');
        $this->data['solicitud'] = $solicitudabstracta;
        $this->data['aplicaciones'] = Aplicacion::all();
        $aplicacionesseleccionadas = $solicitudabstracta->aplicaciones()->get()->toArray();
        $aplicacionesseleccionadas = array_pluck($aplicacionesseleccionadas, 'APLI_ID_APLICACION');
        $this->data['aplicacionesseleccionadas'] = $aplicacionesseleccionadas;
        $cuentascol = $solicitudabstracta->cuentascol;


        $mediocomunicacion_solabs = DB::table('solicitud_abstracta')
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
            ->with('grado', $grado_catalogo)
            ->with('numerocuentascol', $cuentascol)
            ->with('dependencias_catalogo', $dependencias_catalogo)
            ->with('otrocampo', $otrocampo)
            ->with('otraapp', $otraapp)
            ->with('campotrabajo', $campotrabajo_catalogo)
            ->with('meco', $mediocomunicacion_solabs)
            ->with('tipoproyecto', $tipoproyecto_catalogo)
            ->with('anio', $anio);


    }

    /**
     * Muestra la vista para cambiar de estatus a rechazada
     * Parámetros:
     * $id
     * @param de $id
     * @return
     * @internal param \de $id la solicitud
     * Output:
     * $solicitudabstracta @object: es un conjunto de todos los datos de una solicitud abstracta
     *
     */
    public function rechazar($id)
    {
        $solicitudabstracta = SolicitudAbstracta::find($id);

        return View::make('evaluarsolicitudderecursos.rechazarsolicitud')
            ->with('solicitudabstracta', $solicitudabstracta);
    }

    /**
     * Cambia de estatus la solicitud a rechazada y agrega un comentario de rechazo en la solicitud abstracta
     *
     * Input:
     * $id @integer id del proyecto
     * Output:
     * @mixed
     *
     *
     *  return @mixed
     */

    public function rechazarSolicitud()
    {

        $id = Input::get('id');
        $rules = array(
            'descrechazo' => 'required',
        );

        $mensajes = array(
            'required' => ' El campo descripción de rechazo es obligatorio',
        );

        $validator = Validator::make(Input::all(), $rules, $mensajes);

        if ($validator->fails())
        {


            $messages = $validator->messages();

            // redirect our user back to the form with the errors from the validator
            return Redirect::route('rechazar', $id)
                ->withErrors($validator);
        } else
        {


            $id = Input::get('id');
            $solicitudabstracta = SolicitudAbstracta::find($id);
            $solicitudabstracta->soab_id_estado_solicitud = 3;
            $solicitudabstracta->soab_desc_rechazo = Input::get('descrechazo');
            $solicitudabstracta->save();

            Session::flash('message', '¡La solicitud se ha rechazado exitosamente!');

            return Redirect::to('evaluarsolicitudderecursos/evaluarsolicitud');
        }
    }

    /**
     * Muestra la vista para subir archivo de colas
     *
     *
     *
     * Output: Vista para subir archivo de contabilidad
     *
     */

    public function mostrarSubirContabilidad()
    {

        return View::make('subircontabilidad');
    }

    /**
     * Asigna los datos del archivo .csv a la tabla de contabilidad
     *
     * Input:
     * $moved @string la ruta del archivo de contabilidad
     * Output:
     *
     */

    public function asignarContabilidadPorUsuario()
    {
        $destinationpath = public_path() . '/uploads/';
        $archivocontabilidad = 'contabilidad' . time() . '.' . 'txt';
        $upload_success = Input::file('contabilidad')->move($destinationpath, $archivocontabilidad);

        $moved = $destinationpath . $archivocontabilidad;


        if ($upload_success)
        {

            $csv = new Reader($moved);
            $csv->setOffset(0); //because we don't want to insert the header
            $nbInsert = $csv->each(function ($row) use (&$sth)
            {
                DB::table('contabilidad')->insert(
                    array(

                        'cont_id_usuario' => (isset($row[0]) ? $row[0] : ''),
                        'cont_num_jobs'   => (isset($row[1]) ? $row[1] : ''),
                        'cont_hrs_nodo'   => (isset($row[2]) ? $row[2] : '')
                    ));

                return true;
            });

            return Response::json('success', 200);

        }
        //DB::table('wc_program_1')->truncate();

    }


    /**
     *Cambia la solicitud de estatus a aceptada, asigna los recursos, crea los logins y passwords de cuentas
     * Titulares y colaboradoras, crea un proyecto y lo asigna a la solicitud.
     *Parametros:
     * $id @param id  la solicitud a la que se va a asignar el proyecto
     *
     */
    public function actualizarAceptarSolicitud()
    {

        $id = Input::get('id');


        $rules = array(
            'usua_id_usuario' => 'required|unique:usuario',
            'horasaprobadas' => 'required',

        );

        //validacion para inputs dinámicamente
        //foreach (Input::get('cuentacolaboradora') as $key => $val)(
        //$rules["usua_id_usuario"] = array( "unique:Usuario")
        //   );


        $mensajes = array(
            'required'     => ' El campo :attribute es obligatorio',
            'mimes'        => 'El archivo :attribute archivo debe de ser pdf',
            'max'          => 'El archivo :attribute no debe de pasar los 8MB',
            'horasCPU.max' => 'Las horas cpu no deben sobrepasar las 5000000 de horas',
            'numeric'      => ' El campo :attribute solo debe contener números',
            'unique'       => 'El login :attribute del usuario ya existe en el sistema'

        );

        if(Input::get('cuentacolaboradora')){
            foreach (Input::get('cuentacolaboradora') as $key => $val){

                $rules['cuentacolaboradora.'.$key] = 'required|unique:usuario,usua_id_usuario';
                $messages['cuentacolaboradora.'.$key.'.required'] = 'campo requerido';
            }
        }








        $validator = Validator::make(Input::all(), $rules, $mensajes);

        if ($validator->fails())
        {


            $messages = $validator->messages();

            // redirect our user back to the form with the errors from the validator
            return Redirect::route('aceptar', $id)
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


            $this->guardarArchivos($solicitudabstracta);


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
                //$solcol->soco_id_estado_colaboradora = 2;
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
            $tipoproy = TipoProyecto::find($tipoproyecto);
            $tipoproyectocomp = $tipoproy->TIPR_CLAVE_TIPO_PROYECTO;

            $convocatoria = Input::get('convocatoria');
            $passwordtitular = $this->generarPassword();
            $esproyecto = new Proyecto;
            $esproyecto->proy_id_solicitud_abstracta = $solicitudabstracta->SOAB_ID_SOLICITUD_ABSTRACTA;
            $esproyecto->proy_id_tipo_proyecto = Input::get('tipoproyecto');
            $esproyecto->proy_hrs_aprobadas = Input::get('horasaprobadas');
            $esproyecto->proy_nombre = Input::get('nombreproyecto');
            $esproyecto->proy_id_compuesto = 'SC' . $anio . $convocatoria . '-' . $tipoproyectocomp . '-' . $solicitudabstracta->SOAB_ID_SOLICITUD_ABSTRACTA;
            $esproyecto->proy_id_estado_proyecto = 1;
            $esproyecto->save();

            $idlog = Input::get('id');
            $solicitudabs = SolicitudAbstracta::find($idlog);
            $nombre = $solicitudabs->SOAB_NOMBRES;
            $appaterno = $solicitudabs->SOAB_AP_PATERNO;
            $apmaterno = $solicitudabs->SOAB_AP_MATERNO;
            $usua_nombre_concatenado = $nombre . ' ' . $appaterno . ' ' . $apmaterno;

            $usuario = new Usuario;
            $usuariotitular = Input::get('usua_id_usuario');
            $usuario->usua_id_usuario = $usuariotitular;
            $usuario->usua_id_tipo_usuario = 2;
            $usuario->usua_id_estado_usuario = 1;
            $usuario->password = Hash::make($passwordtitular);
            $usuario->usua_nom_completo = $usua_nombre_concatenado;
            $usuario->save();
            $path = $solicitudabs->SOAB_RUTA_ARCHIVOS . '/' . 'WPD'. $solicitudabs->SOAB_ID_SOLICITUD_ABSTRACTA . '.txt';
            File::put($path,$passwordtitular);

            $usuarioid = $usuario->usua_id_usuario;
            $esproyecto->usuarios()->attach($usuarioid);


            $passwordvpn = $this->generarPassword();
            $nombre_login1 = $nombre . '_' . $appaterno . '_' . $apmaterno;
            $nombre_login1 = $this->quitarAcentos($nombre_login1);
            $grupo = substr($usuariotitular, 0, 2);


            $vpn = new Vpn;
            $cuentatitular = Input::get('usua_id_usuario');
            $vpn->vplo_login = $cuentatitular;
            $vpn->vplo_password = $passwordvpn;
            $vpn->vplo_nombre = $nombre_login1;
            $vpn->obfuscada = 0;
            $vpn->vplo_grupo_principal = $grupo . '_' . 'g';
            $vpn->save();

            $passwordmaquinatitular = $this->generarPassword();
            $maquina = new Maquina();
            $cuentatitular = Input::get('usua_id_usuario');
            $maquina->malo_login = $cuentatitular;
            $maquina->malo_password = $passwordmaquinatitular;
            $maquina->malo_nombre = $nombre_login1;
            $maquina->obfuscada = 0;
            $maquina->malo_grupo_principal = $grupo . '_' . 'g';
            $maquina->save();

            $aplicacionesseleccionadas = $solicitudabs->aplicaciones()->orderBy('soap_id_aplicacion', 'ASC')->get()->toArray();
            $aplicacionesseleccionadas = array_pluck($aplicacionesseleccionadas, 'APLI_ID_APLICACION');
            $dependencia = DB::table('solicitud_abstracta')
                ->join('dependencia', 'solicitud_abstracta.soab_id_dependencia', '=', 'dependencia.depe_id_dependencia')
                ->where('solicitud_abstracta.soab_id_solicitud_abstracta', '=', $idlog)
                ->first();



            $cuentascolaboradora = Input::get('cuentacolaboradora');

            if (!empty($cuentascolaboradora))
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
                    $usuariocol->usua_id_estado_usuario = 1;
                    $usuariocol->password = Hash::make($password);
                    $usuariocol->usua_nom_completo = $usua_nombre_concatenado;
                    $usuariocol->save();

                    $usuarioid = $usuariocol->usua_id_usuario;
                    $esproyecto->usuarios()->attach($usuarioid);

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

                    $usrcol->soco_id_estado_colaboradora = 2;
                    $usrcol->save();
                }
            }else{
                $maquinacol = false;
            }


            if ($dependencia->DEPE_ID_TIPO_DEPENDENCIA == 1)
            {
                $this->obtenerGrupoSecundario($aplicacionesseleccionadas, $maquina, $maquinacol);
            }


            Session::flash('message', '¡La solicitud se ha aceptado exitosamente!');

            return Redirect::to('evaluarsolicitudderecursos/evaluarsolicitud');
            //$queries = DB::getQueryLog();
            //var_dump($queries);

        }
    }


    /**
     * Obtiene el grupo secundario para asignarlo a la tabla de Maquina Y VPN
     * @param $aplicacionesseleccionadas
     * @param $maquina
     * @param $maquinacol
     */
    public function obtenerGrupoSecundario($aplicacionesseleccionadas, $maquina, $maquinacol)
    {

        $aplicacion_seleccionada = $this->generarGrupoGaussian($aplicacionesseleccionadas);

        $aplicacion_seleccionada2 = $this->generarGrupoAdf($aplicacionesseleccionadas);


        if($aplicacion_seleccionada && $aplicacion_seleccionada2){

            $aplicaciones = "{$aplicacion_seleccionada}{$aplicacion_seleccionada2}";
        }elseif($aplicacion_seleccionada){
            $aplicaciones = "{$aplicacion_seleccionada}";
        }elseif($aplicacion_seleccionada2){
            $aplicaciones = "{$aplicacion_seleccionada2}";
        }else{
            $aplicaciones = " ";
        }




            if($maquinacol){
                $maquinacol->malo_grupo_secundario = $aplicaciones;
                $maquinacol->save();
            }

            $maquina->malo_grupo_secundario = $aplicaciones;
            $maquina->save();

    }

    /**
     * @param $aplicacionesseleccionadas
     * @return string
     */
    public function generarGrupoGaussian($aplicacionesseleccionadas)
    {
        foreach ($aplicacionesseleccionadas as $aplicacion)
        {
            if ($aplicacion == 9)
            {

                $aplicacion_seleccionada = 'g09';
            }else{
                $aplicacion_seleccionada = false;
            }

        }

        return $aplicacion_seleccionada;
    }

    /**
     * @param $aplicacionesseleccionadas
     * @return string
     */
    public function generarGrupoAdf($aplicacionesseleccionadas)
    {
        foreach ($aplicacionesseleccionadas as $aplicacion2)
        {
            if ($aplicacion2 == 14)
            {

                $aplicacion_seleccionada2 = 'adf';
            } else
            {
                $aplicacion_seleccionada2 = false;
            }

        }

        return $aplicacion_seleccionada2;
    }


}