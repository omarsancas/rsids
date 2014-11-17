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

Route::get('pruebamuchos', function()
{

/*
    $esproyecto = new Proyecto;
    $esproyecto->proy_id_solicitud_abstracta = 5;
    $esproyecto->proy_id_tipo_proyecto = 1;
    $esproyecto->proy_hrs_aprobadas = '10000';
    $esproyecto->proy_nombre = 'machine learning';
    $esproyecto->proy_id_compuesto = 'SC-14-16';
    $esproyecto->proy_id_estado_proyecto = 1;
    $esproyecto->save();

*/

    $proyecto = Proyecto::find(3);



    $usuario = new Usuario;
    $usuario->usua_id_usuario = 'sauco';
    $usuario->usua_id_tipo_usuario = 3;
    $usuario->usua_id_estado_usuario = 1;
    $usuario->password = Hash::make('123');
    $usuario->usua_nom_completo = 'Saul Cordero';
    $usuario->save();



    $usuarioid = $usuario->usua_id_usuario;

    $proyecto->usuarios()->attach($usuarioid);

    //$usuario = Usuario::find('vicval');
    //$usuario->proyectos()->detach(2);




    return 'pruebamuchosamuchos';






});

Route::get('prueba', function()
{
    $reportesproyectodatos = DB::table('contabilidad')
        ->select(DB::raw('sum(contabilidad.cont_num_jobs) AS totaljobs, usua_id_usuario ,proy_id_proyecto,depe_nombre,soab_nombres,soab_ap_paterno, soab_ap_materno,
             proy_nombre, proy_hrs_aprobadas, sum(contabilidad.cont_hrs_nodo) AS totalnodo,
            proy_hrs_aprobadas, CONCAT(FORMAT(IF(proy_hrs_aprobadas=0,0,(sum(contabilidad.cont_hrs_nodo)*100.0)/proy_hrs_aprobadas),2)) AS porcentajeproyecto'))
        ->join('usuario', 'contabilidad.cont_id_usuario', '=', 'usuario.usua_id_usuario')
        ->join('usuario_x_proyecto', 'usuario.usua_id_usuario', '=', 'usuario_x_proyecto.uspr_id_usuario')
        ->join('proyecto', 'usuario_x_proyecto.uspr_id_proyecto', '=', 'proyecto.proy_id_proyecto')
        ->join('solicitud_abstracta', 'proyecto.proy_id_solicitud_abstracta', '=', 'solicitud_abstracta.soab_id_solicitud_abstracta')
        ->join('dependencia', 'solicitud_abstracta.soab_id_dependencia', '=', 'dependencia.depe_id_dependencia')
        ->where('proyecto.proy_id_proyecto','=', 3)
        ->where(DB::raw('MONTH(cont_fecha)'), '=', 10)
        ->where(DB::raw('YEAR(cont_fecha)'), '=', 2014)
        ->groupBy('proyecto.proy_id_proyecto')
        ->first();

    var_dump($reportesproyectodatos);


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


$solicitudabstracta = SolicitudAbstracta::find(7);
$solicitudabstracta->soab_proy_notificado = 0;
$solicitudabstracta->save();

/*
  $usuario = new Usuario;
  $usuario->usua_id_usuario = 'yoli';
  $usuario->password = Hash::make('123');
  $usuario->usua_id_estado_usuario = 1;
  $usuario->usua_id_tipo_usuario = 1;
  $usuario->save();*/
    /*
    Excel::create('Filename', function($excel) {

        $excel->sheet('Sheetname', function($sheet) {
        $model = Vpn::select('vplo_login', 'vplo_password','vplo_grupo_principal')->get();
        $sheet->fromModel($model);
        });
    })->download('txt');

    */







    $queries = DB::getQueryLog();
    //var_dump($numerocuentascol);

});

/*
 * Generar solicitud de recursos
 * */


Route::get('solicitud',[
    'as' => 'solicitud',
    'uses' => 'SolicitudController@mostrarSolicitud'
]);

Route::post('solicitud', [
    'as' => 'registrar',
    'uses' => 'SolicitudController@generarSolicitud'
]);


/* Rutas para Usuario Admin*/


Route::group(array('before' => 'auth|role:1'), function ()
{
/*
 * Gestionar solicitud de recursos
 */


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


Route::get('gestionarsolicitudderecursos/notificarrechazo', [
    'uses' => 'SolicitudController@mostrarNotificacionRechazoSolicitudes'
]);

Route::get('/rechazar/{id}', array(
    'as' => 'rechazar',
    'uses' => 'SolicitudController@notificarRechazo'
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


Route::get('/mostrarusuarioconproyecto/{idproyecto}/{idusuario}', [
    'as' => 'mostrarusuarioconproyecto',
    'uses' => 'GestionarProyectosController@mostrarUsuarioConProyecto'
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


Route::get('gestionarproyectos/consultarcuentatitularvista',[
    'uses' => 'GestionarCuentasTitularesController@mostrarConsultarCuentaTitular'
]);


Route::post('gestionarproyectos/consultarcuentatitularvista',[
    'as' => 'consultarcuentatitular',
    'uses' => 'GestionarCuentasTitularesController@consultarCuentaTitular'
]);


Route::get('/consultarcuentatitularespecifica/{idproyecto}', [
    'as' => 'consultarcuentatitularespecifica',
    'uses' => 'GestionarCuentasTitularesController@consultarCuentaTitualEspecifica'
]);

});//fin del fitro para rol de administrador



/*
 * Rutas para usuario cuenta titular
 */
Route::group(array('before' => 'auth|role:2'), function ()
{

    Route::get('cuentatitular/consultarrecursosdisponibles', [
        'uses' => 'ConsultarRecursosDisponiblesController@mostrarRecursosDisponiblesUsuarioTitular'
    ]);


    Route::get('cuentatitular/renovarsolicitudderecursos', [
        'uses' => 'RenovarSolicitudDeRecursosController@renovarSolicitudDeRecursosVista'
    ]);

});




/*
 * Sesiones para login
 * */

Route::get('login', [
    'as' => 'login',
    'uses' => 'SesionesController@create'
]);
Route::post('login', 'SesionesController@store');
Route::get('logout', 'SesionesController@destroy');
Route::resource('sesiones', 'SesionesController');