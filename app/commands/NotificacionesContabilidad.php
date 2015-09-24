<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class NotificacionesContabilidad extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'rsids:enviar-notificaciones';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Notificar los usuarios que sus recursos se estan acabando';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		//

        $reportesproyectos = DB::table('contabilidad')
            ->select(DB::raw('sum(contabilidad.cont_num_jobs) AS totaljobs, usua_id_usuario ,proy_id_proyecto, proy_nombre, sum(contabilidad.cont_hrs_nodo) AS totalnodo,
            proy_hrs_aprobadas, CONCAT(FORMAT(IF(proy_hrs_aprobadas=0,0,(sum(contabilidad.cont_hrs_nodo)*100.0)/proy_hrs_aprobadas),2)) AS porcentajeproyecto,
            soab_nombres, soab_ap_paterno, soab_ap_materno, depe_nombre, proy_fec_term_recu, meco_correo'))
            ->join('usuario', 'contabilidad.cont_id_usuario', '=', 'usuario.usua_id_usuario')
            ->join('usuario_x_proyecto', 'usuario.usua_id_usuario', '=', 'usuario_x_proyecto.uspr_id_usuario')
            ->join('proyecto', 'usuario_x_proyecto.uspr_id_proyecto', '=', 'proyecto.proy_id_proyecto')
            ->join('solicitud_abstracta', 'proyecto.proy_id_solicitud_abstracta', '=', 'solicitud_abstracta.soab_id_solicitud_abstracta')
            ->join('medio_comunicacion', 'solicitud_abstracta.soab_id_medio_comunicacion', '=', 'medio_comunicacion.meco_id_medio_comunicacion')
            ->join('dependencia', 'solicitud_abstracta.soab_id_dependencia', '=', 'dependencia.depe_id_dependencia')
            ->where('proyecto.proy_id_estado_proyecto', '=', 1)
            ->groupBy('proyecto.proy_id_proyecto')
            ->get();

            $data =  array(
                'mensaje' => 'Tus recursos están apunto de consumirse'
            );

        foreach($reportesproyectos as $reporte){

            if($reporte->porcentajeproyecto >= 85){

                $correo_electronico = $reporte->meco_correo;
                Mail::send('emails.notificarTerminacionRecursos',$data , function ($message) use ( $correo_electronico)
                {
                    $message->from('moroccosc@gmail.com', 'super.unam.mx');
                    $message->to($correo_electronico);

                });
            }
        }
	}


}
