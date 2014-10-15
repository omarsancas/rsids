<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 26/09/14
 * Time: 12:56 PM
 */

class PruebaControl extends BaseController {

    public function index()
    {


        //$solicitud=  Proyecto::with('mediocomunicacion')->get();
        //$solicitud = DB::table('solicitud_abstracta')->get();
        //$solicitud = Proyecto::all();
        $solicitudes = DB::table('solicitud_abstracta')
            // ->join('dependencia', 'solicitud_abstracta.soab_id_dependencia', '=', 'dependencia.depe_id_dependencia')
            ->join('tipo_solicitud', 'solicitud_abstracta.soab_id_tipo_solicitud', '=', 'tipo_solicitud.tiso_id_tipo_solicitud')
            //->join('medio_comunicacion', 'solicitud_abstracta.soab_id_medio_comunicacion', '=', 'medio_comunicacion.meco_id_medio_comunicacion')
            //->join('solicitud_x_app', 'solicitud_abstracta.soab_id_solicitud_abstracta', '=', 'solicitud_x_app.soap_id_solicitud_abstracta')
            //->join('solicitud_cta_colaboradora', 'solicitud_abstracta.soab_id_solicitud_abstracta', '=', 'solicitud_cta_colaboradora.soco_id_solicitud_abstracta')
            //->select('users.id', 'contacts.phone', 'orders.price')
            ->get();

        //var_dump($solicitudes);

        return View::make('gestionarsolicitudderecursos.eliminarsolicitud')->with('solicitudes',$solicitudes);
    }


    public function getIndex($id)
    {

        $solicitudabstracta = SolicitudAbstracta::find($id);
        $dependencias_catalogo = Dependencia::lists('depe_nombre', 'depe_id_dependencia');
        $grado = Grado::lists('grad_nombre', 'grad_id_grado');
        $this->data['solicitud'] = $solicitudabstracta;
        $this->data['aplicaciones'] = Aplicacion::all();
        $aplicacionesseleccionadas = $solicitudabstracta->aplicaciones()->get()->toArray();
        $aplicacionesseleccionadas = array_pluck($aplicacionesseleccionadas,'APLI_ID_APLICACION');
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






        // Show form
        return View::make('pruebas.checkbox',$this->data)->with('cuentascol',$solicitud)->with('solicitudabstracta',$solicitudabstracta)->with('grado',$grado)->with('dependencias_catalogo',$dependencias_catalogo)->with('meco',$meco);
    }


    public function getupdate()
    {
        $id = Input::get('id');
        $solicitudabstracta =  SolicitudAbstracta::find($id);
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
        $solicitudabstracta->soab_desc_proyecto = Input::get('descproyecto');
        $solicitudabstracta->SOAB_ID_DEPENDENCIA = Input::get('dependencias');
        $solicitudabstracta->soab_id_grado = Input::get('grado');
        $solicitudabstracta->soab_hrs_cpu = Input::get('horasCPU');
        $solicitudabstracta->soab_esp_hd = Input::get('disco');
        $solicitudabstracta->soab_mem_ram = Input::get('memoria');
        $solicitudabstracta->save();

        $idmeco = Input::get('idmeco');
        $mediocomunicacion = MedioComunicacion::find($idmeco);
        $mediocomunicacion->meco_telefono1 = Input::get('telefono');
        $mediocomunicacion->meco_extension = Input::get('extension');
        $mediocomunicacion->meco_telefono2 = Input::get('telefono2');
        $mediocomunicacion->meco_correo = Input::get('email');
        $mediocomunicacion->save();


       $aplicaciones = Input::get('aplicaciones');
       $solicitudabstracta->aplicaciones()->sync($aplicaciones);



        $datoscuentacol = Input::get('solcol');
        //var_dump($datoscuentacol);
        $datosMecoCuentasCol = Input::get('meco');

        //$cuentacol = $datoscuentacol;
        //$mecocuentascol = array_slice($datosMecoCuentasCol,1);




        $solcol_ids = array();
        foreach (Input::get('solcol', array()) as $id => $solcolData)
        {
            $solcol = Cuentacol::find($id);
            $solcol->update($solcolData);
            $solcol->save();
        }

        $solcol_ids = array();
        foreach (Input::get('meco', array()) as $id => $solcolData)
        {
            $meco = MedioComunicacion::find($id);
            $meco->update($solcolData);
            $meco->save();
        }

        //$solicitudabstracta->cuentascol()->sync($solcol_ids);



        Session::flash('message', '¡La solicitud se ha modificado exitosamente!');
        return Redirect::to('pruebas/modificarsolicitud');
       //$queries = DB::getQueryLog();
        //var_dump($queries);
    }
} 