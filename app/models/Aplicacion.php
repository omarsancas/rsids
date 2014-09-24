<?php

class Aplicacion extends Eloquent {

	protected $table = 'aplicacion';
	protected $fillable = [];

	public function proyecto()
	{

		return $this->belongsToMany('Proyecto');
	}
	
}