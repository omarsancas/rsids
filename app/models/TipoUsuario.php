<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 7/11/14
 * Time: 02:04 PM
 */



class TipoUsuario extends Eloquent {
    
    protected $fillable = [];
    protected $table = 'tipo_usuario';
    protected $primaryKey = 'TIUS_ID_TIPO_USUARIO';
    public $timestamps = false;

}