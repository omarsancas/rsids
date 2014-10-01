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


        $solicitudabstracta = SolicitudAbstracta::find(77);
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




        $queries = DB::getQueryLog();
        $last_query = end($queries);
        var_dump($solicitud);


        // Get all galleries to populate our checkboxes
        //$aplicaciones = Aplicacion::all();


        // Show form
        return View::make('pruebas.checkbox',$this->data)->with('cuentascol',$cuentascol);
    }
} 