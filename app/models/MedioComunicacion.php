<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 12/09/14
 * Time: 11:21 AM
 */

class MedioComunicacion extends Eloquent {

    protected $fillable = array('meco_id_medio_comunicacion','meco_telefono1', 'meco_extension', 'meco_telefono2','meco_correo');
    protected $table = 'medio_comunicacion';
    protected $primaryKey = 'meco_id_medio_comunicacion';
    public $timestamps = false;
    protected $with = array('SolicitudAbstracta');


    public function solicitudabstracta()
    {
        return $this->hasOne('SolicitudAbstracta','soab_id_medio_comunicacion','meco_id_medio_comunicacion');
    }


    public function cuentacol()
    {
        return $this->hasMany('Cuentacol','soco_id_medio_comunicacion','meco_id_medio_comunicacion');
    }

}