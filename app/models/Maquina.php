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

    public static function cuentasMaquina($id){
        $cuentasmaquina = DB::table('solicitud_abstracta')
            ->select(DB::raw('malo_login, malo_password,malo_nombre, malo_grupo_principal,malo_grupo_secundario, malo_maquina'))
            ->join('dependencia', 'solicitud_abstracta.soab_id_dependencia', '=', 'dependencia.depe_id_dependencia')
            ->join('proyecto', 'proyecto.proy_id_solicitud_abstracta', '=', 'solicitud_abstracta.soab_id_solicitud_abstracta')
            ->join('usuario_x_proyecto', 'proyecto.proy_id_proyecto', '=', 'usuario_x_proyecto.uspr_id_proyecto')
            ->join('usuario', 'usuario_x_proyecto.uspr_id_usuario', '=', 'usuario.usua_id_usuario')
            ->join('maquina_login', 'usuario.usua_id_usuario', '=', 'maquina_login.malo_login')
            ->where('solicitud_abstracta.soab_id_solicitud_abstracta','=', $id)
            ->get();

        return $cuentasmaquina;
    }

}