<?php

class Dependencia extends Eloquent {

protected $table = 'dependencias';


public function proyecto()
    {
        return $this->hasMany('proyecto');
    }
	
	
}