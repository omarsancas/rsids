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

Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);
/*
Route::get('/', function()
{
	$dependecia = new Dependencia;
	$dependecia->id = '4';
	$dependecia->nombreDependencia = 'Facultad de psicologia';
	$dependecia->clave = 'FP';
	$dependecia->save();

});

*/

//Route::get('pruebas-recursos', ['as' => 'pruebas_recursos', 'uses' => 'SolicitudController@registro']);
//Route::get('pruebas-recursos', ['as' => 'pruebas_recursos', 'uses' => 'SolicitudController@populate']);
Route::get('solicitud', ['as' => 'solicitud', 'uses' => 'SolicitudController@create']);
//Route::get('solicitud-recursos', ['as' => 'solicitud_recurss', 'uses' => 'SolicitudController@populate']);
Route::post('solicitud', ['as' => 'registrar', 'uses' => 'SolicitudController@registrar']);

Route::get('apps', 'AplicacionController@create');
Route::post('apps', ['as' => 'registrer', 'uses' => 'AplicacionController@registrer']);


Route::get('versolicitud', function()
{

    /*$queries = DB::table('solicitud_cta_colaboradora')
        ->leftJoin('solicitud_abstracta','solicitud_cta_colaboradora.soco_id_solicitud_abstracta' , '=', 'solicitud_abstracta.soab_id_solicitud_abstracta')
        ->select('solicitud_abstracta.soab_id_solicitud_abstracta', 'solicitud_cta_colaboradora.soco_nombres')
        ->get();*/



     $solicitud = SolicitudAbstracta::find(55)->aplicaciones;
   /*$solicitud = DB::table('solicitud_abstracta')
        ->join('dependencia', 'solicitud_abstracta.soab_id_dependencia', '=', 'dependencia.depe_id_dependencia')
        ->join('tipo_solicitud', 'solicitud_abstracta.soab_id_tipo_solicitud', '=', 'tipo_solicitud.tiso_id_tipo_solicitud')
        ->join('medio_comunicacion', 'solicitud_abstracta.soab_id_medio_comunicacion', '=', 'medio_comunicacion.meco_id_medio_comunicacion')
        //->join('solicitud_x_app', 'solicitud_abstracta.soab_id_solicitud_abstracta', '=', 'solicitud_x_app.soap_id_solicitud_abstracta')
        //->join('solicitud_cta_colaboradora', 'solicitud_abstracta.soab_id_solicitud_abstracta', '=', 'solicitud_cta_colaboradora.soco_id_solicitud_abstracta')
        //->select('users.id', 'contacts.phone', 'orders.price')
        ->get();*/


});


Route::get('admin/ModificarSolicitudes', [ 'uses' => 'AdminController@index']);
Route::get('pruebas/checkbox', [ 'uses' => 'PruebaControl@getIndex']);

Route::post('solicitud/destroy', ['as' => 'solicitud.destroy', 	'uses' => 'AdminController@destroy' ]);


