<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 15/10/14
 * Time: 11:13 AM
 */
use League\Csv\Reader;
class EvaluarSolicitudController extends BaseController{

    public function modificarSolicitud()
    {

        $solicitudes = DB::table('solicitud_abstracta')
            ->join('tipo_solicitud', 'solicitud_abstracta.soab_id_tipo_solicitud', '=', 'tipo_solicitud.tiso_id_tipo_solicitud')
            ->where('solicitud_abstracta.soab_id_estado_solicitud', '=' , 0)
            ->get();

        return View::make('evaluarsolicitudderecursos/evaluarsolicitud')->with('solicitudes',$solicitudes);
    }


    public function aceptar($id)
    {
        $solicitudabstracta =  SolicitudAbstracta::find($id);
        $solicitudabstracta->soab_id_estado_solicitud = 1;
        $solicitudabstracta->soab_es_proyecto = 1;
        $solicitudabstracta->save();

        $esproyecto = new Proyecto;
        $esproyecto->proy_id_solicitud_abstracta = $solicitudabstracta->SOAB_ID_SOLICITUD_ABSTRACTA;
        $esproyecto->save();

        $usuario = new Usuario;
        $nombre = strtolower($solicitudabstracta->SOAB_NOMBRES);
        $apellido = strtolower($solicitudabstracta->SOAB_AP_PATERNO);



        $nombre = "$nombre$apellido";
        $login = str_replace(' ', '', $nombre);
        $usuario->usua_login = $login;
        $usuario->usua_id_tipo_usuario = 2;
        $usuario->save();

        $cuentascolaboradoras = DB::table('solicitud_cta_colaboradora')
                   ->where('solicitud_cta_colaboradora.soco_id_solicitud_abstracta', '=', $id)
                   ->get();

        foreach($cuentascolaboradoras as $cuentacolaboradora)
        {
            $usuario = new Usuario;
            $nombre = strtolower($cuentacolaboradora->SOCO_NOMBRES);
            $apellido = strtolower($cuentacolaboradora->SOCO_AP_PATERNO);
            $nombre = "$nombre$apellido";
            $login = str_replace(' ', '', $nombre);
            $usuario->usua_login = $login;
            $usuario->usua_id_tipo_usuario = 3;
            $usuario->save();

        }




        Session::flash('message', '¡La solicitud se ha aceptado exitosamente!');
        return Redirect::to('evaluarsolicitudderecursos/evaluarsolicitud');

    }


    public function prueba()
    {
        $moved = public_path() . '/uploads/contabilidad.txt';

        //DB::table('wc_program_1')->truncate();

        $csv = new Reader($moved);
        $csv->setOffset(0); //because we don't want to insert the header
        $nbInsert = $csv->each(function ($row) use (&$sth) {
            DB::table('usuario_x_proyecto')->insert(
                array(

                    'uspr_id_usuario' => (isset($row[0]) ? $row[0] : ''),
                    'uspr_num_jobs' => (isset($row[1]) ? $row[1] : ''),
                    'uspr_num_hrscpu' => (isset($row[2]) ? $row[2] : '')

            ));
            return true;
        });

        return Response::json('success', 200);


    }


    public function prueba2()
    {
        $links = DB::table('usuario_x_proyecto')
            ->select(DB::raw('sum(usuario_x_proyecto.uspr_num_jobs) AS totaljobs, proy_id_proyecto ,sum(usuario_x_proyecto.uspr_num_hrscpu) AS totalcpu'))
            //->sum('uspr_num_hrscpu')
            //->select(DB::raw('sum(\'usuario_x_proyecto.uspr_num_jobs\')'))
            ->join('usuario', 'usuario_x_proyecto.uspr_id_usuario', '=', 'usuario.usua_id_usuario')
            //->sum('usuario_x_proyecto.uspr_num_jobs')

            ->groupBy('proy_id_proyecto')

            //->where(DB::raw('YEAR(uspr_fecha)', '=', 2014))
            ->get();

        return \Illuminate\Support\Facades\View::make('proyectos')->with('proyectos',$links);
    }

} 