<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 15/10/14
 * Time: 11:48 AM
 */



class Proyecto extends Eloquent {
    
    protected $fillable = [];
    protected $table = 'proyecto';
    protected $primaryKey = 'PROY_ID_PROYECTO';
    public $timestamps = false;


    public function usuarios()
    {
        return $this->belongsToMany('Usuario', 'usuario_x_proyecto','uspr_id_proyecto','uspr_id_usuario');
    }

    public function solicitud()
    {
        return $this->hasOne('SolicitudAbstracta','SOAB_ID_SOLICITUD_ABSTRACTA','PROY_ID_PROYECTO');
    }


}