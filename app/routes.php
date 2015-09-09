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



Route::get('/', function()
{


    return Response::json('Hola :)', 200);

});


Route::get('seedDB', function()
{
    $usuarioadmin  = new Usuario();
    $usuarioadmin->usua_id_usuario = 'omarcolaborador';
    $usuarioadmin->usua_id_tipo_usuario = 4;
    $usuarioadmin->usua_id_estado_usuario = 1;
    $usuarioadmin->usua_nom_completo = 'colaborador';
    $usuarioadmin->password = Hash::make('123');
    $usuarioadmin->save();


    /*
    $usuarioadmin  = new Usuario();
    $usuarioadmin->usua_id_usuario = 'yoliztli';
    $usuarioadmin->usua_id_tipo_usuario = 1;
    $usuarioadmin->usua_id_estado_usuario = 1;
    $usuarioadmin->usua_nom_completo = 'Yolanda Flores';
    $usuarioadmin->password = Hash::make('y0l1_Fl0r3s$.2015');
    $usuarioadmin->save();


    $usuarioadmin  = new Usuario();
    $usuarioadmin->usua_id_usuario = 'total';
    $usuarioadmin->usua_id_tipo_usuario = 2;
    $usuarioadmin->usua_id_estado_usuario = 1;
    $usuarioadmin->usua_nom_completo = 'total';
    $usuarioadmin->password = Hash::make('t0tal_2015_V1v4_Rs1ds');
    $usuarioadmin->save();
    */


});


Route::get('pruebafuncion', function()
{
    $aplicacionesseleccionadas = array(1, 9, 14, 10);
    $aplicacion_seleccionada = '';
    $aplicacion_seleccionada2 = '';

        foreach ($aplicacionesseleccionadas as $aplicacion)
        {
            if ($aplicacion == 14)
            {

                $aplicacion_seleccionada = 'g09';

                //var_dump($aplicacion_seleccionada);
            }

        }

        foreach ($aplicacionesseleccionadas as $aplicacion2)
        {
            if($aplicacion2 == 14){

                $aplicacion_seleccionada2 = ',adf';
            }else{
                $aplicacion_seleccionada2 = '';
            }

        }

        $aplicaciones = "{$aplicacion_seleccionada}{$aplicacion_seleccionada2}";

        var_dump($aplicaciones);


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

    Route::get('/bajararchivo/{id}', array(
        'as' => 'bajararchivo',
        'uses'=> 'SolicitudController@mostrarArchivoRenovacion'
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

Route::get('/notificarrechazar/{id}', array(
        'as' => 'notificarrechazar',
        'uses' => 'SolicitudController@notificarRechazo'
));

Route::get('/rechazar/{id}', array(
    'as' => 'rechazar',
    'uses' => 'EvaluarSolicitudController@rechazarSolicitud'
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


Route::get('subircontabilidad', [
        'uses' => 'EvaluarSolicitudController@mostrarSubirContabilidad'
]);

Route::post('subircontabilidad/archivodecolas', [
        'as' => 'archivodecolas',
        'uses' => 'EvaluarSolicitudController@asignarContabilidadPorUsuario'
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

/*Gestionar cuentas colaboradoras*/

Route::get('gestionarcuentascolaboradoras/agregarcuentascolaboradoras', [
    'uses' => 'GestionarCuentasColaboradorasController@mostrarAgregarCuentaColaboradora'
]);

Route::post('gestionarcuentascolaboradoras/agregarcuentascolaboradoras', [
    'as' => 'agregarcuentacolaboradora',
    'uses' => 'GestionarCuentasColaboradorasController@agregarCuentaColaboradora'
]);

Route::get('/agregarcuentascolaboradoras/{idproyecto}', [
        'as' => 'agregar',
        'uses' => 'GestionarCuentasColaboradorasController@agregarCuentaColaboradoraProyectoVista'
]);

Route::post('agregarcuentascolaboradoras',[
    'as' => 'agregarcuentaaproyecto',
    'uses' => 'GestionarCuentasColaboradorasController@agregarCuentaColaboradoraProyecto'
]);

Route::get('gestionarcuentascolaboradoras/modificarcuentacolaboradoravista',[

    'uses' => 'GestionarCuentasColaboradorasController@mostrarModificarCuentaColaboradora'
]);

Route::post('gestionarcuentascolaboradoras/modificarcuentacolaboradoravista',[

    'as' => 'modificarcuentacolaboradoravista',
    'uses' => 'GestionarCuentasColaboradorasController@buscarCuentaColaboradora'
]);

Route::get('gestionarcuentascolaboradoras/consultarcuentacolaboradoravista',[

        'uses' => 'GestionarCuentasColaboradorasController@mostrarConsultarCuentaColaboradora'
]);

Route::post('gestionarcuentascolaboradoras/consultarcuentacolaboradoravista',[
        'as' => 'consultarcuentacolaboradoravista',
        'uses' => 'GestionarCuentasColaboradorasController@buscarCuentaColaboradoraParaConsulta'
]);

Route::get('/consultarcuentacolaboradora/{idusuario}',[
    'as' => 'consultarcuentacolaboradora',
    'uses' => 'GestionarCuentasColaboradorasController@consultarCuentaColaboradora'
]);

Route::get('/asignarconvocatoria',[
    'as' => 'asignarconvocatoria',
    'uses' => 'SolicitudController@mostrarConvocatoria'
]);

Route::post('/actualizarconvocatoria',[
        'as' => 'actualizarconvocatoria',
        'uses' => 'SolicitudController@actualizarConvocatoria'
]);


Route::get('/asignarcontabilidad', [

    'as' => 'asignarcontabilidad',
    'uses' => 'EvaluarSolicitudController@asignarContabilidadPorUsuario'


]);

    /*
    * Caso de uso Gestionar cuentas login
    * */

Route::get('gestionarcuentaslogin/mostrarobfuscarcuentasmaquina',[
    'as' => 'mostrarobfuscarcuentas',
    'uses' => 'GestionarCuentasLogin@mostrarObfuscarCuentasMaquina'
]);

Route::post('gestionarcuentaslogin/obfuscarcuentas',[
    'as' => 'obfuscarcuentas',
    'uses' => 'GestionarCuentasLogin@obfuscarCuentasMaquina'
]);

Route::get('gestionarcuentaslogin/mostrarobfuscarcuentasvpn',[
        'as' => 'mostrarobfuscarcuentasvpn',
        'uses' => 'GestionarCuentasLogin@mostrarObfuscarCuentasVpn'
]);

Route::post('gestionarcuentaslogin/obfuscarcuentasvpn',[
       'as' => 'obfuscarcuentasvpn',
       'uses' => 'GestionarCuentasLogin@obfuscarCuentasVpn'
]);


/*Caso de uso Reasignar Password*/
Route::get('reasignarpassword/mostrarreasignarpassword',[
        'as' => 'mostrarreasignarpassword',
        'uses' => 'ReasignarPasswordController@mostrarReasignarPassword'
]);

Route::post('reasignarpassword/buscarcuenta',[
        'as' => 'buscarcuenta',
        'uses' => 'ReasignarPasswordController@buscarCuenta'
]);


Route::get('/reasignarpasswordvpn/{id}', [
        'as' => 'reasignarpasswordvpn',
        'uses' => 'ReasignarPasswordController@mostrarCuentaVPN'
]);

Route::get('/reasignarpasswordmaquina/{id}', [
        'as' => 'reasignarpasswordmaquina',
        'uses' => 'ReasignarPasswordController@mostrarCuentaMaquina'
]);

Route::get('/reasignarpasswordaplicacion/{id}', [
        'as' => 'reasignarpasswordmaquina',
        'uses' => 'ReasignarPasswordController@mostrarCuentaAplicacion'
]);

Route::post('reasignarpassword/cambiarpasswordvpn',[
        'as' => 'cambiarpasswordvpn',
        'uses' => 'ReasignarPasswordController@cambiarPasswordVPN'
]);

Route::post('reasignarpassword/cambiarpasswordaplicacion',[
        'as' => 'cambiarpasswordaplicacion',
        'uses' => 'ReasignarPasswordController@cambiarPasswordAplicacion'
]);

Route::post('reasignarpassword/cambiarpasswordmaquina',[
        'as' => 'cambiarpasswordmaquina',
        'uses' => 'ReasignarPasswordController@cambiarPasswordMaquina'
]);


Route::post('admin/renovarsolicitudderecursos', [
        'as' => 'renovarsolicitudadmin',
        'uses' => 'RenovarSolicitudDeRecursosController@editarRenovacionSolicitudDeRecursos'
]);


    /*
     *
     * Función para resetear los password anteriores
     * y crear txt con cuentas
     */
    Route::get('resetcontabilidad', function()
    {

        DB::update( DB::raw("update vpn_login set vplo_password = 'XXXXXXXXXXXX'") );
        DB::update( DB::raw("update maquina_login set vplo_password = 'XXXXXXXXXXXX'") );


        return 'Tablas actualizadas';

    });


    Route::get('obtenerarchivo' , function()
    {
        Excel::create('Filename', function($excel) {

            $excel->sheet('Sheetname', function($sheet) {
                $model = Vpn::cuentasVpn(14)->get();
                $sheet->fromModel($model);
            });
        })->download('txt');


    });


    Route::get('obtenerarchivo2' , function()
    {
        Excel::create('Filename', function($excel) {

            $excel->sheet('Sheetname', function($sheet) {
                $models = Vpn::cuentasVpn(14);
                $array = json_decode(json_encode($models), true);
                $sheet->fromModel($array);
            });
        })->download('txt');


    });




});//fin del fitro para rol de administrador



/* filtro para administrador y administrador colaborador */

Route::group(array('before' => 'auth|admin_colaborator'), function ()
{
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



});//Rutas para filtro de administrador y administrador colaborador



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

    Route::post('cuentatitular/renovarsolicitudderecursos', [
        'as' => 'renovarsolicitud',
        'uses' => 'RenovarSolicitudDeRecursosController@renovarSolicitudDeRecursos'
    ]);

    Route::get('cuentatitular/generarsolicituddesoportetecnico',[
        'uses' => 'GenerarSolicitudesParaSoporteTecnicoController@mostrarSolicitud'
    ]);


    Route::post('cuentatitular/generarsolicituddesoportetecnico',[

        'as' => 'enviarsolicitud',
        'uses' => 'GenerarSolicitudesParaSoporteTecnicoController@enviarSolicitud'
    ]);

});




/*
 * Sesiones para login
 * */

Route::get('login', [
    'as' => 'login',
    'uses' => 'SesionesController@mostrarIngresarAlSistema'
]);
Route::post('login', 'SesionesController@store');
Route::get('logout', 'SesionesController@destruirSesion');
Route::resource('sesiones', 'SesionesController');



