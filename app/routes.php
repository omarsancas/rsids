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

Route::get('/', function()
{

    $solicitudes = DB::table('solicitud_abstracta')
        ->join('dependencia', 'solicitud_abstracta.soab_id_dependencia', '=', 'dependencia.depe_id_dependencia')
        ->join('grado', 'solicitud_abstracta.soab_id_grado', '=', 'grado.grad_id_grado')
        ->where('solicitud_abstracta.soab_id_solicitud_abstracta', '=', 4)
        ->first();

    //var_dump($solicitudes);

    $html = View::make('admin.generarcarta')->with('solicitudes',$solicitudes)->render();
    //return PDF::load($html, 'A4', 'portrait')->show();

    $outputName = str_random(10); // str_random is a [Laravel helper](http://laravel.com/docs/helpers#strings)
    $pdfPath = public_path().'/'.$outputName.'.pdf';
    File::put($pdfPath, PDF::load($html, 'A4', 'portrait')->output());

    $data = [ 'msg' => 'hola' ];
    Mail::send('emails.welcome' ,$data ,function($message) use ($pdfPath){
        $message->from('moroccosc@gmail.com', 'Laravel');
        $message->to('vic.raval.val@gmail.com');
        $message->attach($pdfPath);
    });
});


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


