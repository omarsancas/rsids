<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 26/09/14
 * Time: 12:56 PM
 */

class PruebaControl extends BaseController {

    public function getIndex()
    {
        // Get our artist with associated galleries
        //$solicitud = SolicitudAbstracta::find(55);
        //$solicitud->load('aplicaciones');


        $solicitudabstracta = SolicitudAbstracta::find(123);
        $dependencias_catalogo = Dependencia::lists('depe_nombre', 'depe_id_dependencia');
        $grado = Grado::lists('grad_nombre', 'grad_id_grado');
        $this->data['solicitud'] = $solicitudabstracta;
        $this->data['aplicaciones'] = Aplicacion::all();
        $aplicacionesseleccionadas = $solicitudabstracta->aplicaciones()->get()->toArray();
        $aplicacionesseleccionadas = array_pluck($aplicacionesseleccionadas,'APLI_ID_APLICACION');
        $this->data['aplicacionesseleccionadas'] = $aplicacionesseleccionadas;
        $cuentascol = $solicitudabstracta->cuentascol;

        $id = $solicitudabstracta->SOAB_ID_SOLICITUD_ABSTRACTA;

        $solicitud = DB::table('solicitud_cta_colaboradora')
            ->join('medio_comunicacion', 'solicitud_cta_colaboradora.soco_id_medio_comunicacion', '=', 'medio_comunicacion.meco_id_medio_comunicacion')
            ->where('solicitud_cta_colaboradora.soco_id_solicitud_abstracta', '=', $id)
            ->get();








        //var_dump();


        // Get all galleries to populate our checkboxes
        //$aplicaciones = Aplicacion::all();


        // Show form
        return View::make('pruebas.checkbox',$this->data)->with('cuentascol',$solicitud)->with('solicitudabstracta',$solicitudabstracta)->with('grado',$grado)->with('dependencias_catalogo',$dependencias_catalogo);
    }


    public function getupdate()
    {
        $solicitudabstracta =  SolicitudAbstracta::find(123);
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




       $queries = DB::getQueryLog();
        var_dump($queries);
    }
} 