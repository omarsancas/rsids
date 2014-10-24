<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 17/10/14
 * Time: 03:11 PM
 */




class Usuario extends Eloquent {
    
    protected $fillable = array('usua_id_usuario,usua_login,usua_pass_md5');
    protected $table = 'usuario';
    protected $primaryKey = 'USUA_ID_USUARIO';
    public $timestamps = false;

}