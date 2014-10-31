<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 31/10/14
 * Time: 11:24 AM
 */


class TipoProyecto extends Eloquent {
    
    protected $fillable = [];
    protected $table = 'tipo_proyecto';
    protected $primaryKey = 'TIPR_ID_TIPO_PROYECTO';
    public $timestamps = false;

}