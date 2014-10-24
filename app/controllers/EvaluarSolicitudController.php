<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 15/10/14
 * Time: 11:13 AM
 */
use League\Csv\Reader;
use \Hackzilla\PasswordGenerator\Generator\ComputerPasswordGenerator;
class EvaluarSolicitudController extends BaseController{

    public function listarSolicitudes()
    {

        $solicitudes = DB::table('solicitud_abstracta')
            ->join('tipo_solicitud', 'solicitud_abstracta.soab_id_tipo_solicitud', '=', 'tipo_solicitud.tiso_id_tipo_solicitud')
            ->where('solicitud_abstracta.soab_id_estado_solicitud', '=' , 0)
            //->where('solicitud_abstracta.soab_es_proyecto', '=' , 0)
            ->get();

        return View::make('evaluarsolicitudderecursos/evaluarsolicitud')->with('solicitudes',$solicitudes);
    }


    public function aceptar($id)
    {

        $solicitudabstracta = SolicitudAbstracta::find($id);
        //dd($solicitudabstracta->SOAB_ID_SOLICITUD_RENOVACION);
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

            $numerocuentascol = DB::table('solicitud_cta_colaboradora')
                ->select(DB::raw('COUNT(*) as cuentascolaboradoras'))
                ->where('solicitud_cta_colaboradora.soco_id_solicitud_abstracta', '=', $id)
                ->first();


            // Show form
            return View::make('evaluarsolicitudderecursos.aceptarsolicitud', $this->data)
                ->with('cuentascol', $solicitud)
                ->with('solicitudabstracta', $solicitudabstracta)
                ->with('grado', $grado)
                ->with('numerocuentascol',$cuentascol)
                ->with('dependencias_catalogo', $dependencias_catalogo)
                ->with('otrocampo', $otrocampo)
                ->with('otraapp', $otraapp)
                ->with('campotrabajo', $campotrabajo)
                ->with('meco', $meco);


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
        $solicitudabstracta->soab_id_estado_solicitud = 2;
        $solicitudabstracta->soab_desc_rechazo = Input::get('descrechazo');
        $solicitudabstracta->save();

        Session::flash('message', '¡La solicitud se ha rechazado exitosamente!');

        return Redirect::to('evaluarsolicitudderecursos/evaluarsolicitud');
    }


    public function prueba()
    {
        $moved = public_path() . '/uploads/contabilidad.txt';

        //DB::table('wc_program_1')->truncate();

        $csv = new Reader($moved);
        $csv->setOffset(0); //because we don't want to insert the header
        $nbInsert = $csv->each(function ($row) use (&$sth) {
            DB::table('usuario_x_proyecto')->insert(
                array(

                    'uspr_id_usuario' => (isset($row[0]) ? $row[0] : ''),
                    'uspr_num_jobs' => (isset($row[1]) ? $row[1] : ''),
                    'uspr_num_hrscpu' => (isset($row[2]) ? $row[2] : '')

            ));
            return true;
        });

        return Response::json('success', 200);


    }


    public function actualizarSolicitud()
    {
        $id = Input::get('id');
        $solicitudabstracta = SolicitudAbstracta::find($id);
        $solicitudabstracta->soab_nombres = Input::get('nombre');
        $solicitudabstracta->soab_ap_paterno = Input::get('apellidoPaterno');
        $solicitudabstracta->soab_ap_materno = Input::get('apellidoMaterno');
        $solicitudabstracta->soab_id_estado_solicitud = 1;
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


        $generator = new ComputerPasswordGenerator();
        $generator->setOptions(ComputerPasswordGenerator::OPTION_UPPER_CASE | ComputerPasswordGenerator::OPTION_LOWER_CASE | ComputerPasswordGenerator::OPTION_NUMBERS);
        $generator->setLength(12);
        $passwordtitular = $generator->generatePassword();

        $esproyecto = new Proyecto;
        $esproyecto->proy_id_solicitud_abstracta = $solicitudabstracta->SOAB_ID_SOLICITUD_ABSTRACTA;
        $esproyecto->proy_id_tipo_proyecto = Input::get('tipoproyecto');
        $esproyecto->proy_hrs_aprobadas = Input::get('horasaprobadas');
        $esproyecto->proy_nombre = Input::get('nombreproyecto');
        $esproyecto->proy_id_estado_proyecto = 1;
        $esproyecto->save();

        $usuario = new Usuario;
        $usuariotitular =  Input::get('cuentatitular');
        $usuario->usua_id_usuario =  $usuariotitular;
        $usuario->usua_id_tipo_usuario = 2;
        $usuario->usua_pass_md5 = Hash::make($passwordtitular);
        $usuario->usua_id_proyecto = $esproyecto->proy_id_proyecto;
        $usuario->save();

        $generator = new ComputerPasswordGenerator();
        $generator->setOptions(ComputerPasswordGenerator::OPTION_UPPER_CASE | ComputerPasswordGenerator::OPTION_LOWER_CASE | ComputerPasswordGenerator::OPTION_NUMBERS);
        $generator->setLength(12);
        $passwordvpn = $generator->generatePassword();

        $vpn = new Vpn;
        $logintitular =  Input::get('cuentatitular');
        $vpn->vplo_id_vpn =  $logintitular;
        $vpn->vpn_password = $passwordvpn;
        $vpn->save();



        $cuentascolaboradora = Input::get('cuentacolaboradora');


        foreach ($cuentascolaboradora as  $cuentacol)
        {
            $generator = new ComputerPasswordGenerator();
            $generator->setOptions(ComputerPasswordGenerator::OPTION_UPPER_CASE | ComputerPasswordGenerator::OPTION_LOWER_CASE | ComputerPasswordGenerator::OPTION_NUMBERS);
            $generator->setLength(12);
            $password = $generator->generatePassword();
            $usuariocol = new Usuario();
            $usuariocol->usua_id_usuario = $cuentacol;
            $usuariocol->usua_id_tipo_usuario = 3;
            $usuariocol->usua_id_proyecto = $esproyecto->proy_id_proyecto;
            $usuariocol->usua_pass_md5 = Hash::make($password);
            $usuariocol->save();

            $generator = new ComputerPasswordGenerator();
            $generator->setOptions(ComputerPasswordGenerator::OPTION_UPPER_CASE | ComputerPasswordGenerator::OPTION_LOWER_CASE | ComputerPasswordGenerator::OPTION_NUMBERS|ComputerPasswordGenerator::OPTION_SYMBOLS|ComputerPasswordGenerator::OPTION_AVOID_SIMILAR);
            $generator->setLength(12);
            $passwordvpn = $generator->generatePassword();

            $vpncol = new Vpn;
            $vpncol->vplo_login =  $cuentacol;
            $vpncol->vpn_password = $passwordvpn;
            $vpncol->save();

        }










        Session::flash('message', '¡La solicitud se ha aceptado exitosamente!');

        return Redirect::to('evaluarsolicitudderecursos/evaluarsolicitud');
        //$queries = DB::getQueryLog();
        //var_dump($queries);
    }


    public function prueba2()
    {
        $links = DB::table('usuario_x_proyecto')
            ->select(DB::raw('sum(usuario_x_proyecto.uspr_num_jobs) AS totaljobs, proy_id_proyecto ,sum(usuario_x_proyecto.uspr_num_hrscpu) AS totalcpu'))
            //->sum('uspr_num_hrscpu')
            //->select(DB::raw('sum(\'usuario_x_proyecto.uspr_num_jobs\')'))
            ->join('usuario', 'usuario_x_proyecto.uspr_id_usuario', '=', 'usuario.usua_id_usuario')
            //->sum('usuario_x_proyecto.uspr_num_jobs')

            ->groupBy('proy_id_proyecto')

            //->where(DB::raw('YEAR(uspr_fecha)', '=', 2014))
            ->get();

        return \Illuminate\Support\Facades\View::make('proyectos')->with('proyectos',$links);
    }

} 