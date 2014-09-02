<?php

class Proyecto extends Eloquent {
	protected $fillable = [];

	protected $table = 'proyecto';



	public function cuentascol()
    {
        return $this->hasMany('cuentascol');
    }



    public function aplicaciones()
    {
        

        return $this->belongsToMany('Aplicacion', 'proyectoxaplicacion', 'id_proyecto', 'id_aplicacion');
    }
}