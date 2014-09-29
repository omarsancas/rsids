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


        $solicitudabstracta = SolicitudAbstracta::find(55);
        $this->data['solicitud'] = $solicitudabstracta;
        $this->data['aplicaciones'] = Aplicacion::all();
        $aplicacionesseleccionadas = $solicitudabstracta->aplicaciones()->get()->toArray();
        $aplicacionesseleccionadas = array_pluck($aplicacionesseleccionadas,'APLI_ID_APLICACION');
        $this->data['aplicacionesseleccionadas'] = $aplicacionesseleccionadas;
        // Get all galleries to populate our checkboxes
        //$aplicaciones = Aplicacion::all();

        //var_dump($solicitud);

        // Show form
        return View::make('pruebas.checkbox',$this->data);
    }
} 