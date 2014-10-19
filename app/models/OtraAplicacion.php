<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 18/09/14
 * Time: 10:33 PM
 */




class OtraAplicacion extends Eloquent {
    
    protected $fillable = array('otap_opcion');
    protected $table = 'otra_app';
    protected $primaryKey = 'OTAP_ID_OTRA_APP';
    public $timestamps = false;



    public function proyecto()
    {
        return $this->belongsTo('SolicitudAbstracta','otap_id_solicitud_abstracta','otap_id_otra_app');
    }

}