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

    public $timestamps = false;

    public function proyecto()
    {
        return $this->belongsTo('Proyecto','otap_id_solicitud_abstracta','otap_id_otra_app');
    }

}