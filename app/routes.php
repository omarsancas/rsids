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


Route::get('proyectos', ['as' => 'proyectos', 'uses' => 'EvaluarSolicitudController@prueba2']);

Route::get('/', function()
{



    Excel::create('Filename', function($excel) {

        $excel->sheet('Sheetname', function($sheet) {
            $model = Vpn::all();

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
    var_dump($numerocuentascol);

});


//Estas rutas son para el caso de uso gestionar solicitud de recursos
Route::get('solicitud', ['as' => 'solicitud', 'uses' => 'SolicitudController@mostrarSolicitud']);

Route::post('solicitud', ['as' => 'registrar', 'uses' => 'SolicitudController@generarSolicitud']);

Route::get('gestionarsolicitudderecursos/eliminarsolicitud', ['as' => 'delete', 'uses' => 'SolicitudController@eliminarSolicitud']);

Route::post('gestionarsolicitudderecursos/eliminarsolicitud', [	'uses' => 'SolicitudController@eliminar' ]);

Route::get('gestionarsolicitudderecursos/modificarsolicitud', [ 'uses' => 'SolicitudController@modificarsolicitud']);

Route::get('gestionarsolicitudderecursos/consultarsolicitud', [ 'uses' => 'SolicitudController@consultarSolicitud']);
Route::get('gestionarsolicitudderecursos/buscarsolicitud', function()
{

    return View::make('gestionarsolicitudderecursos/buscarsolicitud');
});

Route::post('gestionarsolicitudderecursos/buscarsolicitud', ['as' => 'buscar', 'uses' => 'SolicitudController@buscarSolicitud']);

Route::get('/edit/{id}', 'SolicitudController@editarSolicitud');


Route::get('/consultar/{id}', array(
    'as' => 'consultar',
    'uses' => 'SolicitudController@consultarSolicitudVista'
));


Route::get('/bajarcurriculum/{id}', array('as' => 'bajarcurriculum','uses'=> 'SolicitudController@mostrarCurriculum'));
Route::get('/bajardocdesc/{id}', array('as' => 'bajardocdesc','uses'=> 'SolicitudController@mostrarDocumentoDesc'));
Route::get('/bajarconads/{id}', array('as' => 'bajarconads','uses'=> 'SolicitudController@mostrarConstancia'));
Route::post('gestionarsolicitudderecursos/modificarsolicitud', [ 'as' => 'update', 'uses' => 'SolicitudController@actualizarSolicitud']);


Route::get('gestionarsolicitudderecursos/generarcartas', [ 'uses' => 'SolicitudController@mostrarSolicitudes']);

Route::get('/generar/{id}', array(
    'as' => 'generar',
    'uses' => 'SolicitudController@generarCartas'
));


Route::get('gestionarsolicitudderecursos/notificaraprobacion', [ 'uses' => 'SolicitudController@mostrarNotificacionSolicitudes']);

Route::get('/notificar/{id}', array(
    'as' => 'notificar',
    'uses' => 'SolicitudController@notificarAprobacion'
));



//Estas rutas son para el caso de uso evaluar solicitud
Route::post('evaluarsolicituderecursos/aceptarsolicitud', [ 'as' => 'aceptarsolicitud', 'uses' => 'EvaluarSolicitudController@actualizarSolicitud']);
Route::get('evaluarsolicitudderecursos/evaluarsolicitud', [ 'uses' => 'EvaluarSolicitudController@listarSolicitudes']);
Route::get('/aceptar/{id}', array(
    'as' => 'aceptar',
    'uses' => 'EvaluarSolicitudController@aceptar'
));

Route::get('/rechazar/{id}', array(
    'as' => 'rechazar',
    'uses' => 'EvaluarSolicitudController@rechazar'
));

Route::post('evaluarsolicituderecursos/rechazarsolicitud', [ 'as' => 'rechazarsolicitud', 'uses' => 'EvaluarSolicitudController@rechazarSolicitud']);











