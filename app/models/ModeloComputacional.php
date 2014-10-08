<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 19/09/14
 * Time: 12:44 AM
 */



class ModeloComputacional extends Eloquent {
    
    protected $fillable = array('moco_nombre');
    protected $table = 'modelo_compu';
    protected $primaryKey = 'moco_id_modelo';
    public $timestamps = false;

    public function proyecto()
    {
        return $this->hasOne('SolicitudAbstracta','soab_id_modelo','moco_id_modelo');
    }

}