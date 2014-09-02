<?php

class Aplicacion extends Eloquent {

	protected $table = 'aplicaciones';
	protected $fillable = [];

	public function proyecto()
	{

		return $this->belongsToMany('Proyecto');
	}
	
}