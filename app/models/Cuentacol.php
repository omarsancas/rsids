<?php

class Cuentacol extends Eloquent {
	protected $fillable = [];

	protected $table = 'cuentascol';


	public function proyecto()
    {
        return $this->belongsTo('proyecto');
    }

}