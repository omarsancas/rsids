<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
Route::get('prueba', function()
{
    $reportesproyectos = DB::table('contabilidad')
        ->select(DB::raw('sum(contabilidad.cont_num_jobs) AS totaljobs, usua_id_usuario ,proy_id_proyecto, proy_nombre, sum(contabilidad.cont_hrs_nodo) AS totalnodo,
            proy_hrs_aprobadas, CONCAT(FORMAT(IF(proy_hrs_aprobadas=0,0,(sum(contabilidad.cont_hrs_nodo)*100.0)/proy_hrs_aprobadas),2)) AS porcentajeproyecto'))
        ->join('usuario', 'contabilidad.cont_id_usuario', '=', 'usuario.usua_id_usuario')
        ->join('proyecto', 'usuario.usua_id_proyecto', '=', 'proyecto.proy_id_proyecto')
        ->where('proyecto.proy_id_estado_proyecto', '=', 1)
        ->groupBy('proyecto.proy_id_proyecto')
        ->get();



    $users = DB::table('usuario')
        ->join('proyecto', 'usuario.usua_id_proyecto', '=', 'proyecto.proy_id_proyecto')
        ->where('usua_id_usuario', 'LIKE', '%vicval%')
        ->where('usua_id_usuario', 'LIKE', '%vicval%')
        ->orWhere('proy_nombre', 'LIKE', '%natural proc%')
        //->orWhere('email', 'LIKE', '%foo%')
        ->get();

    var_dump($users);
});

Route::get('download', function()
{

    //query por contabilidad por proyecto específico
    $links = DB::table('contabilidad')
        ->select(DB::raw('sum(contabilidad.cont_num_jobs) AS totaljobs, usua_id_usuario ,sum(contabilidad.cont_hrs_nodo) AS totalnodo'))
        ->join('usuario', 'contabilidad.cont_id_usuario', '=', 'usuario.usua_id_usuario')
        ->where('usuario.usua_id_proyecto', '=',11  )
        ->whereBetween(DB::raw('MONTH(cont_fecha)'),array( 10,11))
        ->whereBetween(DB::raw('YEAR(cont_fecha)'),array( 2014,2018))
        //->where(DB::raw('MONTH(cont_fecha)'), '=', 10)
        //->where(DB::raw('YEAR(uspr_fecha)', '=', 2014))'
        //->sum('usuario_x_proyecto.uspr_num_jobs')

        ->groupBy('usua_id_usuario')

        //->where(DB::raw('YEAR(uspr_fecha)', '=', 2014))
        ->get();

    //query por dependencia

    //var_dump($links);

    $links2 = DB::table('contabilidad')
        ->select(DB::raw('sum(contabilidad.cont_num_jobs) AS totaljobs, depe_nombre ,proy_id_proyecto,sum(contabilidad.cont_hrs_nodo) AS totalnodo ,proy_hrs_aprobadas,
        CONCAT(FORMAT(IF(proy_hrs_aprobadas=0,0,(sum(contabilidad.cont_hrs_nodo)*100.0)/proy_hrs_aprobadas),2))
       AS average'))
        ->join('usuario', 'contabilidad.cont_id_usuario', '=', 'usuario.usua_id_usuario')
        ->join('proyecto', 'usuario.usua_id_proyecto', '=', 'proyecto.proy_id_proyecto')
        ->join('solicitud_abstracta', 'proyecto.proy_id_solicitud_abstracta', '=', 'solicitud_abstracta.soab_id_solicitud_abstracta')
        ->join('dependencia', 'solicitud_abstracta.soab_id_dependencia', '=', 'dependencia.depe_id_dependencia')
        ->groupBy('usuario.usua_id_proyecto')

        //->where(DB::raw('YEAR(uspr_fecha)', '=', 2014))
        ->get();


    foreach($links2 as $link){

        if($link->average > 22)
        {
            echo $link->proy_id_proyecto . '_';
        }
    }

});


Route::get('proyectos', ['as' => 'contabilidad', 'uses' => 'EvaluarSolicitudController@prueba']);

Route::get('/', function()
{

    //$solicitudabs = SolicitudAbstracta::find(11);
    //$aplicacionesseleccionadas = $solicitudabs->aplicaciones()->orderBy('soap_id_aplicacion', 'ASC')->get()->toArray();
    //$aplicacionesseleccionadas = array_pluck($aplicacionesseleccionadas, 'APLI_ID_APLICACION');
    //$dependencia = DB::table('solicitud_abstracta')
        //->join('dependencia', 'solicitud_abstracta.soab_id_dependencia', '=', 'dependencia.depe_id_dependencia')
        //->where('solicitud_abstracta.soab_id_solicitud_abstracta', '=', 12)
        //->first();

   // dd($aplicacionesseleccionadas);

    /*if($dependencia->DEPE_ID_TIPO_DEPENDENCIA == 0)
    {
    foreach($aplicacionesseleccionadas as  $aplicacion)
    {
        if($aplicacion == 8)
        {
            foreach($aplicacionesseleccionadas as $aplicaciones2)
            {
                if($aplicaciones2 == 14)
                {
                    return 'Son las dos apps';

                }
            }

            return 'solo es ocho';
        }elseif($aplicacion == 14)
        {
            return 'solo es 14 ';
        }
    }*/


    //}


    Excel::create('Filename', function($excel) {

        $excel->sheet('Sheetname', function($sheet) {
        $model = Vpn::select('vplo_login', 'vplo_password','vplo_grupo_principal')->get();
        $sheet->fromModel($model);
        });
    })->download('txt');





    /*
    $numerocuentascol = DB::table('solicitud_cta_colaboradora')
        ->select(DB::raw('COUNT(*) as cuentascolaboradoras'))
        ->where('solicitud_cta_colaboradora.soco_id_solicitud_abstracta', '=', 18)
        ->get();
    */
    /*//$total = DB::table('usuario_x_proyecto')->sum('uspr_num_hrscpu');
    $links = DB::table('usuario_x_proyecto')
        ->select(DB::raw('sum(usuario_x_proyecto.uspr_num_jobs) AS totaljobs, proy_id_proyecto ,sum(usuario_x_proyecto.uspr_num_hrscpu) AS totalcpu'))
        //->sum('uspr_num_hrscpu')
        //->select(DB::raw('sum(\'usuario_x_proyecto.uspr_num_jobs\')'))
        ->join('usuario', 'usuario_x_proyecto.uspr_id_usuario', '=', 'usuario.usua_id_usuario')
        //->sum('usuario_x_proyecto.uspr_num_jobs')

        ->groupBy('proy_id_proyecto')
        ->whereBetween(DB::raw('MONTH(uspr_fecha)'),array( 10, 11))
        //->where(DB::raw('MONTH(uspr_fecha)'), '=', 10)
        //->where(DB::raw('YEAR(uspr_fecha)', '=', 2014))
        ->get(

        );*/

    $queries = DB::getQueryLog();
    //var_dump($numerocuentascol);

});

/*
 * Gestionar solicitud de recursos
 */
Route::get('solicitud',[
    'as' => 'solicitud',
    'uses' => 'SolicitudController@mostrarSolicitud'
]);

Route::post('solicitud', [
    'as' => 'registrar',
    'uses' => 'SolicitudController@generarSolicitud'
]);

Route::get('gestionarsolicitudderecursos/eliminarsolicitud', [
    'as' => 'delete',
    'uses' => 'SolicitudController@eliminarSolicitud'
]);

Route::post('gestionarsolicitudderecursos/eliminarsolicitud', [
    'uses' => 'SolicitudController@eliminar'
]);

Route::get('gestionarsolicitudderecursos/modificarsolicitud', [
    'uses' => 'SolicitudController@modificarsolicitud'
]);

Route::get('gestionarsolicitudderecursos/consultarsolicitud', [
    'uses' => 'SolicitudController@consultarSolicitud'
]);
Route::get('gestionarsolicitudderecursos/buscarsolicitud', function()
{

    return View::make('gestionarsolicitudderecursos/buscarsolicitud');
});

Route::post('gestionarsolicitudderecursos/buscarsolicitud', [
    'as' => 'buscar', 'uses' => 'SolicitudController@buscarSolicitud'
]);

Route::get('/edit/{id}', 'SolicitudController@editarSolicitud');


Route::get('/consultar/{id}', array(
    'as' => 'consultar',
    'uses' => 'SolicitudController@consultarSolicitudVista'
));


Route::get('/bajarcurriculum/{id}', array(
    'as' => 'bajarcurriculum',
    'uses'=> 'SolicitudController@mostrarCurriculum'
));
Route::get('/bajardocdesc/{id}', array(
    'as' => 'bajardocdesc',
    'uses'=> 'SolicitudController@mostrarDocumentoDesc'
));
Route::get('/bajarconads/{id}', array(
    'as' => 'bajarconads',
    'uses'=> 'SolicitudController@mostrarConstancia'
));
Route::post('gestionarsolicitudderecursos/modificarsolicitud', [
    'as' => 'update',
    'uses' => 'SolicitudController@actualizarSolicitud'
]);


Route::get('gestionarsolicitudderecursos/generarcartas', [
    'uses' => 'SolicitudController@mostrarSolicitudes'
]);

Route::get('/generar/{id}', array(
    'as' => 'generar',
    'uses' => 'SolicitudController@generarCartas'
));


Route::get('gestionarsolicitudderecursos/notificaraprobacion', [
    'uses' => 'SolicitudController@mostrarNotificacionSolicitudes'
]);

Route::get('/notificar/{id}', array(
    'as' => 'notificar',
    'uses' => 'SolicitudController@notificarAprobacion'
));



/*
 *
 * Evaluar solicitud
 * */
Route::post('evaluarsolicituderecursos/aceptarsolicitud', [
    'as' => 'aceptarsolicitud',
    'uses' => 'EvaluarSolicitudController@actualizarAceptarSolicitud'
]);
Route::get('evaluarsolicitudderecursos/evaluarsolicitud', [
    'uses' => 'EvaluarSolicitudController@listarSolicitudes'
]);
Route::get('/aceptar/{id}', array(
    'as' => 'aceptar',
    'uses' => 'EvaluarSolicitudController@aceptar'
));

Route::get('/rechazar/{id}', array(
    'as' => 'rechazar',
    'uses' => 'EvaluarSolicitudController@rechazar'
));

Route::post('evaluarsolicituderecursos/rechazarsolicitud', [
    'as' => 'rechazarsolicitud',
    'uses' => 'EvaluarSolicitudController@rechazarSolicitud'
]);


/*
 * Gestionar dependencias
 * */

Route::get('gestionardependencias/daraltadependecia',[
    'uses' => 'GestionarDependenciasController@mostrarDarAlta'
]);


Route::post('gestionardependencias/daraltadependecia',[
    'as' => 'daraltadependencia',
    'uses' => 'GestionarDependenciasController@darDeAltaDependencia'
]);

Route::get('gestionardependencias/darbajadependencia',[
     'uses' => 'GestionarDependenciasController@mostrarDarBaja'
]);


Route::post('gestionardependencias/darbajadependencia',[
    'as' => 'eliminardependencias',
    'uses' => 'GestionarDependenciasController@darDeBajaDependencia'
]);


Route::get('gestionardependencias/modificardependenciasvista',[
    'uses' => 'GestionarDependenciasController@mostrarModificar'
]);


Route::get('/modificardependencia/{id}', array(
    'uses' => 'GestionarDependenciasController@modificarDependencia'
));


Route::post('gestionarsolicitudderecursos/modificardependencia', [
    'as' => 'modificardependencia',
    'uses' => 'GestionarDependenciasController@actualizarDependencia'
]);

Route::get('gestionardependencias/consultardependenciasvista',[
    'uses' => 'GestionarDependenciasController@mostrarConsultar'
]);


Route::get('/consultardependencia/{id}', array(
    'uses' => 'GestionarDependenciasController@consultarDependencia'
));




/*
 *
 * Rutas para Caso de uso generar reportes
 */

Route::get('generarreportes/contabilidadmensualproyectos',[
    'uses' => 'GenerarReportesController@mostrarGenerarReporteMensualProyecto'
]);

Route::post('generarreportes/contabilidadmensualproyectos',[
    'as' => 'genreportes',
    'uses' => 'GenerarReportesController@generarReporteMensualProyecto'
]);


Route::get('/reportemensualespecifico/{id}/{mes}/{anio}', [
    'as' => 'reportemensualespecifico',
    'uses' => 'GenerarReportesController@mostrarReporteProyectoEspecifico'
]);

Route::get('generarreportes/contabilidadporperiodoproyectos',[
    'uses' => 'GenerarReportesController@mostrarGenerarReportePeriodoProyecto'
]);


Route::post('generarreportes/contabilidadporperiodoproyectos',[
    'as' => 'genreportesporperiodo',
    'uses' => 'GenerarReportesController@generarReportePeriodoProyecto'
]);


Route::get('/reporteperiodoespecifico/{id}/{mes}/{anio}/{mes2}/{anio2}', [
    'as' => 'reporteporperiodoespecifico',
    'uses' => 'GenerarReportesController@mostrarReportePorPeriodoProyectoEspecifico'
]);

Route::get('generarreportes/contabilidadmensualdependencias',[
    'uses' => 'GenerarReportesController@mostrarGenerarReporteMensualDependencia'
]);


Route::post('generarreportes/contabilidadmensualdependencias',[
    'as' => 'genreportesmensualdependencias',
    'uses' => 'GenerarReportesController@generarReporteMensualDependencia'
]);


Route::get('generarreportes/contabilidadporperiododependencias',[
    'uses' => 'GenerarReportesController@mostrarGenerarReportePeriodoDependencia'
]);


Route::post('generarreportes/contabilidadporperiododependencias',[
    'as' => 'genreportesporperiododependencias',
    'uses' => 'GenerarReportesController@generarReportePeriodoDependencia'
]);



Route::get('/generarreportemensualpdfproyectos/{mes}/{anio}', [
    'as' => 'generarreportemensualpdfproyectos',
    'uses' => 'GenerarReportesController@generarPdfMensualPorProyectos'
]);



/*Consultar Recursos disponibles*/

Route::get('consultarrecursosdisponibles/recursosdisponiblesproyectos',[
    'uses' => 'ConsultarRecursosDisponiblesController@recursosDisponiblesProyectos'
]);

Route::post('consultarrecursosdisponibles/recursosdisponiblesproyectos',[
    'as' => 'mostrarrecursosdisponibles',
    'uses' => 'ConsultarRecursosDisponiblesController@mostrarRecursosDisponiblesProyectos'
]);

Route::get('consultarrecursosdisponibles/consumorecursosmiztli',[
    'uses' => 'ConsultarRecursosDisponiblesController@mostrarConsumoRecursosMiztli'
]);

Route::post('consultarrecursosdisponibles/consumorecursosmiztli',[
    'as' => 'mostrarconsumorecursosmiztliporperiodo',
    'uses' => 'ConsultarRecursosDisponiblesController@mostrarConsumoRecursosMiztliPorPeriodo'
]);


/* Gestionar proyectos */


Route::get('gestionarproyectos/consultarproyectosvista',[
    'uses' => 'GestionarProyectosController@mostrarConsultarProyectos'
]);


Route::post('gestionarproyectos/consultarproyectosvista',[
    'as' => 'consultarproyecto',
    'uses' => 'GestionarProyectosController@consultarProyectos'
]);

Route::get('/consultarproyectoespecifico/{id}', [
    'as' => 'consultarproyectoespecifico',
    'uses' => 'GestionarProyectosController@consultarProyectoEspecifico'
]);


Route::get('gestionarproyectos/modificarproyectosvista',[
    'uses' => 'GestionarProyectosController@mostrarModificarProyectos'
]);


Route::post('gestionarproyectos/modificarproyectosvista',[
    'as' => 'modificarproyecto',
    'uses' => 'GestionarProyectosController@modificarProyectos'
]);


Route::get('/modificarproyectoespecifico/{id}', [
    'as' => 'modificarproyectoespecifico',
    'uses' => 'GestionarProyectosController@modificarProyectoEspecifico'
]);

Route::post('gestionarproyectos/modificarproyectoespecifico',[
    'as' => 'modificarguardarproyectoespecifico',
    'uses' => 'GestionarProyectosController@modificarGuardarProyectoEspecifico'
]);


Route::get('gestionarproyectos/cambiarestadoproyectovista',[
    'uses' => 'GestionarProyectosController@mostrarCambiarEstadoProyectos'
]);


Route::post('gestionarproyectos/cambiarestadoproyectovista',[
    'as' => 'cambiarestadoproyecto',
    'uses' => 'GestionarProyectosController@cambiarEstadoProyectos'
]);


Route::get('/cambiarestadoproyectoespecifico/{id}', [
    'as' => 'cambiarestadoproyectoespecifico',
    'uses' => 'GestionarProyectosController@cambiarEstadoProyectoEspecifico'
]);

Route::post('gestionarproyectos/cambiarestadoproyectoespecifico',[
    'as' => 'guardarcambioestadoproyectoespecifico',
    'uses' => 'GestionarProyectosController@guardarCambiarEstadoProyectoEspecifico'
]);

Route::get('gestionarproyectos/buscarusuariosvista',[
    'uses' => 'GestionarProyectosController@mostrarBuscarUsuarios'
]);


Route::post('gestionarproyectos/buscarusuariosvista',[
    'as' => 'buscarusuarios',
    'uses' => 'GestionarProyectosController@buscarUsuarios'
]);

/*
 * Gestionar cuentas titulares
 * */

Route::get('gestionarproyectos/modificarcuentatitularvista',[
    'uses' => 'GestionarCuentasTitularesController@mostrarModificarCuentaTitular'
]);


Route::post('gestionarproyectos/modificarcuentatitularvista',[
    'as' =>'modificarcuentatitular',
    'uses' => 'GestionarCuentasTitularesController@modificarCuentaTitular'
]);

Route::get('/modificarcuentatitularespecifica/{id}/{id_usuario}', [
    'as' => 'modificarcuentatitularespecifica',
    'uses' => 'GestionarCuentasTitularesController@modificarCuentaTitularEspecifica'
]);


Route::post('gestionarproyectos/modificarguardarcuentatitular',[
    'as' =>'modificarguardarcuentatitular',
    'uses' => 'GestionarCuentasTitularesController@modificarGuardarCuentaTitularEspecifica'
]);


