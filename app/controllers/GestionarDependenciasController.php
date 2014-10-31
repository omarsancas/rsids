<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 30/10/14
 * Time: 01:07 PM
 */

class GestionarDependenciasController extends BaseController{

    public function mostrarDarAlta()
    {
        return View::make('gestionardependencias.daraltadependencia');
    }

    public function darDeAltaDependencia()
    {
        $datos = Input::all();
        $reglas = array(
            'nombredependencia'        => 'required',
            'acronimo'      => 'required',
        );

        $mensajes = array(
            'required' => ' El campo :attribute es obligatorio',
        );

        // do the validation ----------------------------------
        // validate against the inputs from our form
        $validator = Validator::make(Input::all(), $reglas, $mensajes);

        // check if the validator failed -----------------------
        if ($validator->fails())
        {
            $mensajes = $validator->messages();

           // redirect our user back to the form with the errors from the validator
            return Redirect::to('gestionardependencias/daraltadependecia')
                ->withErrors($validator)
                ->withInput($datos);
        }else{
            $dependencia = new Dependencia;
            $dependencia->depe_nombre = Input::get('nombredependencia');
            $dependencia->depe_acronimo = Input::get('acronimo');
            $dependencia->depe_id_tipo_dependencia = Input::get('tipodependencia');
            $dependencia->save();

            return Response::json('success', 200);
        }

    }


    public function mostrarDarBaja()
    {
        $dependencias = $this->obtenerDependencias();

        return View::make('gestionardependencias/darbajadependencia')->with('dependencias',$dependencias);
    }


    public function darDeBajaDependencia()
    {
        $dependencias = Input::get('check_box');
        Dependencia::destroy($dependencias);
        Session::flash('message', '¡Las depedencias se han borrado exitosamente!');
        return Redirect::to('gestionardependencias/darbajadependencia');
    }

    public function mostrarModificar()
    {
        $dependencias = $this->obtenerDependencias();

        return View::make('gestionardependencias/modificardependenciasvista')->with('dependencias',$dependencias);
    }

    public function modificarDependencia($id)
    {
        list($dependencia, $tipodependencia) = $this->obtenerDependenciasJoin($id);

        return View::make('gestionardependencias/modificardependencia')
                         ->with('dependencia',$dependencia)
                         ->with('tipodependencia',$tipodependencia);
    }

    public function actualizarDependencia()
    {
        $id = Input::get('id');
        $dependencia = Dependencia::find($id);
        $dependencia->depe_nombre = Input::get('nombredependencia');
        $dependencia->depe_acronimo = Input::get('acronimo');
        $dependencia->depe_id_tipo_dependencia = Input::get('tipodependencia');
        $dependencia->save();

        Session::flash('message', '¡La dependencia se ha modificado exitosamente!');

        return Redirect::to('gestionardependencias/modificardependenciasvista');
    }

    public function mostrarConsultar()
    {
        $dependencias = $this->obtenerDependencias();

        return View::make('gestionardependencias/consultardependenciasvista')->with('dependencias',$dependencias);
    }

    public function consultarDependencia($id)
    {
        list($dependencia, $tipodependencia) = $this->obtenerDependenciasJoin($id);

        return View::make('gestionardependencias/consultardependencia')
            ->with('dependencia',$dependencia)
            ->with('tipodependencia',$tipodependencia);
    }


    /**
     * @return mixed
     */
    public function obtenerDependencias()
    {
        $dependencias = DB::table('dependencia')
            ->join('tipo_dependencia', 'dependencia.depe_id_tipo_dependencia', '=', 'tipo_dependencia.tide_id_tipo_dependencia')
            ->get();

        return $dependencias;
    }

    /**
     * @param $id
     * @return array
     */
    public function obtenerDependenciasJoin($id)
    {
        $dependencia = DB::table('dependencia')
            ->join('tipo_dependencia', 'dependencia.depe_id_tipo_dependencia', '=', 'tipo_dependencia.tide_id_tipo_dependencia')
            ->where('dependencia.depe_id_dependencia', '=', $id)
            ->first();

        $tipodependencia = TipoDependencia::lists('tide_tipo', 'tide_id_tipo_dependencia');

        return array($dependencia, $tipodependencia);
    }

} 