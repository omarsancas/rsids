<?php

use Illuminate\Routing\Controller;

class SesionesController extends Controller {


    /**
     * Muestra el formulario para ingresar al sistema
     *
     * @return Response
     */
    public function mostrarIngresarAlSistema()
    {
        //
        return View::make('login ');
    }

    /**
     * Store a newly created resource in storage.
     * POST /sessions
     *
     * @return Response
     */
    public function store()
    {
        $rules = array(
            'usuario'        => 'required',
            'password'      => 'required'
        );

        $mensajes = array(
            'required' => ' El campo :attribute es obligatorio',
        );

        $validator = Validator::make(Input::all(), $rules, $mensajes);

        if ($validator->fails())
        {


            $mensajes = $validator->messages();

            // redirect our user back to the form with the errors from the validator
            return Redirect::route('login')
                ->withErrors($validator);
        } else
        {


            $input = Input::all();
            $attempt= Auth::attempt([
                'USUA_ID_USUARIO' => $input['usuario'],
                'password' => $input['password']
            ]);



            if ($attempt) {

             if (Auth::user()->esAdmin())
                {
                    return View::make('bienvenidaadmin');
                }
                elseif(Auth::user()->esUsuarioCuentaTitular())
                {
                    return View::make('bienvenidausuariocuentatitular');
                }

            }elseif(Auth::user()->esAdminColaborador()){

                return View::make('bienvenidaadmincolaborador');

            }else{

                Session::flash('message', '¡El Usuario o la contraseña no son correctas!');
                return Redirect::route('login');
            }

        }


    }


    /**
     * Remove the specified resource from storage.
     * DELETE /sessions/{id}
     *
     *
     * @return Response
     */
    public function destruirSesion()
    {

        Auth::logout();

        return Redirect::to('login');
    }

}