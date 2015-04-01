<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 17/10/14
 * Time: 03:11 PM
 */

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;


class Usuario extends Eloquent implements UserInterface, RemindableInterface {

    use UserTrait, RemindableTrait;
    
    protected $fillable = array('usua_id_usuario','usua_pass_md5','usua_nom_completo');
    protected $table = 'usuario';
    protected $primaryKey = 'USUA_ID_USUARIO';
    public $timestamps = false;
    protected $hidden = array('password', 'remember_token');

    public function esUsuario($tipo)
    {
        if( $this->USUA_ID_TIPO_USUARIO == $tipo){
            return true;
        }
            return false;
    }

    public function esAdmin(){


        if( $this->USUA_ID_TIPO_USUARIO == 1){
            return true;
        }
            return false;
    }

    public function esAdminColaborador(){


        if( $this->USUA_ID_TIPO_USUARIO == 4){
            return true;
        }
            return false;
    }


    public function esUsuarioCuentaTitular(){


        if( $this->USUA_ID_TIPO_USUARIO == 2){
            return true;
        }

        return false;

    }


    public function proyectos()
    {

        return $this->belongsToMany('Proyecto', 'usuario_x_proyecto', 'uspr_id_usuario', 'uspr_id_proyecto');
    }


}


