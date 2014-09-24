<?php


class Solicitud extends Eloquent{

	protected $table = 'solicitud_abstracta';


	protected $softDelete = true;

	protected $guarded = array();  // Important

    public function proyecto()
    {
        return $this->belongsTo('Proyecto');
    }
}