<?php

class Dependencia extends Eloquent {

protected $table = 'dependencia';


public function proyecto()
    {
        return $this->hasMany('Solicitud');
    }
	
	
}