<?php

use Illuminate\Routing\Controller;

class SesionesController extends Controller {

    /**
     * Display a listing of the resource.
     * GET /sessions
     *
     * @return Response
     */
    public function index()
    {
        return View::make('sessions.index');
    }
    /**
     * Show the form for creating a new resource.
     * GET /sessions/create
     *
     * @return Response
     */
    public function create()
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
        //
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

        }else
        {

            Session::flash('message', '¡El Usuario o la contraseña no son correctas!');
            return Redirect::route('login');
        }


    }








    /**
     * Remove the specified resource from storage.
     * DELETE /sessions/{id}
     *
     *
     * @return Response
     */
    public function destroy()
    {

        Auth::logout();

        return Redirect::to('login');
    }

}