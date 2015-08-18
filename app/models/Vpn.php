<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 24/10/14
 * Time: 12:29 PM
 */




class Vpn extends Eloquent {
    
    protected $fillable = [];
    protected $table = 'vpn_login';
    protected $primaryKey = 'VPLO_ID_VPN_LOGIN';
    public $timestamps = false;

    public static function cuentasVpn($id){
        $cuentasvpn = DB::table('solicitud_abstracta')
            ->select(DB::raw('vplo_login, vplo_password,vplo_nombre'))
            ->join('dependencia', 'solicitud_abstracta.soab_id_dependencia', '=', 'dependencia.depe_id_dependencia')
            ->join('proyecto', 'proyecto.proy_id_solicitud_abstracta', '=', 'solicitud_abstracta.soab_id_solicitud_abstracta')
            ->join('usuario_x_proyecto', 'proyecto.proy_id_proyecto', '=', 'usuario_x_proyecto.uspr_id_proyecto')
            ->join('usuario', 'usuario_x_proyecto.uspr_id_usuario', '=', 'usuario.usua_id_usuario')
            ->join('vpn_login', 'usuario.usua_id_usuario', '=', 'vpn_login.vplo_login')
            ->where('solicitud_abstracta.soab_id_solicitud_abstracta','=', $id)
            ->get();

        return $cuentasvpn;
    }

}