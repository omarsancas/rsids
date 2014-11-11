<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 10/11/14
 * Time: 08:10 PM
 */



class AnioFormulario extends Eloquent {
    
    protected $fillable = [];
    protected $table = 'anio_formulario';
    protected $primaryKey = 'ANFO_ID_ANIO';
    public $timestamps = false;

}