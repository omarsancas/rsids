<?php

class Cuentacol extends Eloquent {
	protected $fillable = array('soco_id_solicitud_colaboradora','soco_nombres', 'soco_ap_materno', 'soco_ap_paterno','soco_id_dependencia','soco_id_grado','soco_sexo');
    protected $primaryKey = 'SOCO_ID_SOLICITUD_COLABORADORA';
    public $timestamps = false;

    protected $table = 'solicitud_cta_colaboradora';


	public function solicitudabstracta()
    {
        return $this->belongsTo('SolicitudAbstracta','soco_id_solicitud_abstracta','soco_id_solicitud_colaboradora');
    }

    public function medioComunicacion()
    {
        return $this->belongsTo('MedioComunicacion','meco_id_medio_comunicacion','soco_id_medio_comunicacion');
    }

}