<?php

class Aplicacion extends Eloquent {

	protected $table = 'aplicacion';
	protected $fillable = [];
    protected $primaryKey = 'apli_id_aplicacion';

	public function solicitudabstracta()
	{
        return $this->belongsToMany('SolicitudAbstracta', 'solicitud_x_app','apli_id_aplicacion','soap_id_applicacion');
	}
	
}