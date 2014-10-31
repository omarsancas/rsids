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

Route::get('download', function()
{


    $solicitudes = DB::table('solicitud_abstracta')
        ->where('solicitud_abstracta.soab_id_solicitud_abstracta', '=', 4)
        ->first();

    $pathfile = $solicitudes->SOAB_CURRICULUM;
    $nombre = $solicitudes->SOAB_NOMBRES;
    $apellido = $solicitudes->SOAB_AP_PATERNO;

    //PDF file is stored under project/public/download/info.pdf
    $file= public_path() ."/". $pathfile;
    $filename1 = 'curriculum'.$nombre .'.'.'pdf';
    $headers = array(
        'Content-Type: application/pdf',
    );
    return Response::download($file, $filename1 ,$headers);

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













