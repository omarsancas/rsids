<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 17/11/14
 * Time: 12:05 AM
 */


class EstadoUsuario extends Eloquent {
    
    protected $fillable = [];
    protected $table = 'estado_usuario';
    protected $primaryKey = 'ESUS_ID_ESTADO_USUARIO';
    public $timestamps = false;

}