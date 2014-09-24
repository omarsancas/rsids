<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 12/09/14
 * Time: 11:21 AM
 */



class MedioComunicacion extends Eloquent {
    


    protected $table = 'medio_comunicacion';
    protected $fillable = array('meco_telefono1', 'meco_extension', 'meco_telefono2','meco_correo');
    protected $primaryKey = 'meco_id_medio_comunicacion';
    public $timestamps = false;


    public function proyecto()
    {
        return $this->hasOne('Proyecto','soab_id_medio_comunicacion','meco_id_medio_comunicacion');
    }


}