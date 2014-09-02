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
Route::get('solicitud-recursos', ['as' => 'solicitud_recursos', 'uses' => 'SolicitudController@create']);
//Route::get('solicitud-recursos', ['as' => 'solicitud_recurss', 'uses' => 'SolicitudController@populate']);
Route::post('solicitud-recursos', ['as' => 'registrar', 'uses' => 'SolicitudController@registrar']);
