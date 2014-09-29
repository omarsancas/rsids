<?php

class Cuentacol extends Eloquent {
	protected $fillable = array('soco_nombres', 'soco_ap_materno', 'soco_ap_paterno','soco_id_dependencia','soco_id_grado','soco_sexo');
    protected $primaryKey = 'soco_id_solicitud_colaboradora';
    public $timestamps = false;


    protected $table = 'solicitud_cta_colaboradora';


	public function proyecto()
    {
        return $this->belongsTo('Proyecto','soco_id_solicitud_abstracta','soco_id_solicitud_colaboradora');
    }

}