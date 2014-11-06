<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 5/11/14
 * Time: 02:16 PM
 */




class EstadoProyecto extends Eloquent {
    
    protected $fillable = [];
    protected $table = 'estado_proyecto';
    protected $primaryKey = 'ESPR_ID_ESTADO_PROYECTO';
    public $timestamps = false;

}