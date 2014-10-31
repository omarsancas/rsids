<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 31/10/14
 * Time: 01:06 PM
 */


class Maquina extends Eloquent {
    
    protected $fillable = [];
    protected $table = 'maquina_login';
    protected $primaryKey = 'MALO_ID_MAQUINA_LOGIN';
    public $timestamps = false;

}