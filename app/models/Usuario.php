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

    public static function buscarCuentaPorNombre($nombre){
        $resultados_nombre = DB::table('usuario')
            ->join('usuario_x_proyecto', 'usuario.usua_id_usuario', '=', 'usuario_x_proyecto.uspr_id_usuario')
            ->join('proyecto', 'usuario_x_proyecto.uspr_id_proyecto', '=', 'proyecto.proy_id_proyecto')
            ->join('estado_proyecto', 'proyecto.proy_id_estado_proyecto', '=', 'estado_proyecto.espr_id_estado_proyecto')
            ->join('solicitud_abstracta', 'proyecto.proy_id_solicitud_abstracta', '=', 'solicitud_abstracta.soab_id_solicitud_abstracta')
            ->join('maquina_login', 'maquina_login.malo_login', '=', 'usuario.usua_id_usuario')
            ->join('vpn_login', 'vpn_login.vplo_login', '=', 'usuario.usua_id_usuario')
            ->where('usua_id_tipo_usuario', '=', 2)
            ->where('usua_nom_completo', 'LIKE', "%$nombre%")
            ->get();

        return $resultados_nombre;
    }

    public static function buscarCuentaPorApellido($apellido){
        $resultados_apellido = DB::table('usuario')
            ->join('usuario_x_proyecto', 'usuario.usua_id_usuario', '=', 'usuario_x_proyecto.uspr_id_usuario')
            ->join('proyecto', 'usuario_x_proyecto.uspr_id_proyecto', '=', 'proyecto.proy_id_proyecto')
            ->join('estado_proyecto', 'proyecto.proy_id_estado_proyecto', '=', 'estado_proyecto.espr_id_estado_proyecto')
            ->join('solicitud_abstracta', 'proyecto.proy_id_solicitud_abstracta', '=', 'solicitud_abstracta.soab_id_solicitud_abstracta')
            ->join('maquina_login', 'maquina_login.malo_login', '=', 'usuario.usua_id_usuario')
            ->join('vpn_login', 'vpn_login.vplo_login', '=', 'usuario.usua_id_usuario')
            ->where('usua_id_tipo_usuario', '=', 2)
            ->where('soab_ap_paterno', 'LIKE', "%$apellido%")
            ->get();

        return $resultados_apellido;
    }

    public static function buscarCuentaPorLogin($login){
        $resultados_login = DB::table('usuario')
            ->join('usuario_x_proyecto', 'usuario.usua_id_usuario', '=', 'usuario_x_proyecto.uspr_id_usuario')
            ->join('proyecto', 'usuario_x_proyecto.uspr_id_proyecto', '=', 'proyecto.proy_id_proyecto')
            ->join('estado_proyecto', 'proyecto.proy_id_estado_proyecto', '=', 'estado_proyecto.espr_id_estado_proyecto')
            ->join('solicitud_abstracta', 'proyecto.proy_id_solicitud_abstracta', '=', 'solicitud_abstracta.soab_id_solicitud_abstracta')
            ->join('maquina_login', 'maquina_login.malo_login', '=', 'usuario.usua_id_usuario')
            ->join('vpn_login', 'vpn_login.vplo_login', '=', 'usuario.usua_id_usuario')
            ->where('usua_id_tipo_usuario', '=', 2)
            ->where('usua_id_usuario', 'LIKE', "%$login%")
            ->get();

        return $resultados_login;
    }


}


