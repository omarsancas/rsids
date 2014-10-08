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
Route::get('solicitud', ['as' => 'solicitud', 'uses' => 'SolicitudController@create']);
Route::post('solicitud', ['as' => 'registrar', 'uses' => 'SolicitudController@registrar']);

Route::get('apps', 'AplicacionController@create');
Route::post('apps', ['as' => 'registrer', 'uses' => 'AplicacionController@registrer']);


Route::get('/edit/{id}', 'PruebaControl@getIndex');
Route::get('admin/ModificarSolicitudes', [ 'uses' => 'AdminController@index']);
Route::get('pruebas/modificarsolicitud', [ 'uses' => 'PruebaControl@index']);
Route::get('pruebas/checkbox', [ 'uses' => 'PruebaControl@getIndex']);
Route::post('pruebas/checkbox', [ 'as' => 'update', 'uses' => 'PruebaControl@getupdate']);

Route::post('solicitud/destroy', ['as' => 'solicitud.destroy', 	'uses' => 'AdminController@destroy' ]);


