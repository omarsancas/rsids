<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 19/09/14
 * Time: 01:09 PM
 */

class AdminController  extends BaseController{

    public function index()
    {


        //$solicitud=  Proyecto::with('mediocomunicacion')->get();
        $solicitud = DB::table('solicitud_abstracta')->get();
        //$solicitud = Proyecto::all();
        $solicitudes = DB::table('solicitud_abstracta')
            ->join('dependencia', 'solicitud_abstracta.soab_id_dependencia', '=', 'dependencia.depe_id_dependencia')
            //->join('tipo_solicitud', 'solicitud_abstracta.soab_id_tipo_solicitud', '=', 'tipo_solicitud.tiso_id_tipo_solicitud')
            //->join('medio_comunicacion', 'solicitud_abstracta.soab_id_medio_comunicacion', '=', 'medio_comunicacion.meco_id_medio_comunicacion')
            //->join('solicitud_x_app', 'solicitud_abstracta.soab_id_solicitud_abstracta', '=', 'solicitud_x_app.soap_id_solicitud_abstracta')
            //->join('solicitud_cta_colaboradora', 'solicitud_abstracta.soab_id_solicitud_abstracta', '=', 'solicitud_cta_colaboradora.soco_id_solicitud_abstracta')
            //->select('users.id', 'contacts.phone', 'orders.price')
            ->get();

        return View::make('admin/listarsolicitudes')->with('solicitudes2',$solicitud);
    }

} 