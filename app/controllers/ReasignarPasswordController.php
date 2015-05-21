<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 5/05/15
 * Time: 10:57 PM
 */

class ReasignarPasswordController extends BaseController{

    public function mostrarReasignarPassword(){

        return View::make('reasignarPassword/mostrarreasignarpassword');
    }

    public function buscarCuenta(){
        $q = Input::get('q');
        $duracion = Input::get('duracion');

        if($duracion == 1){
            $resultados = Usuario::buscarCuentaPorNombre($q);
           return View::make('reasignarPassword/resultadosbuscarcuenta')->with('resultados',$resultados);
            var_dump($resultados);

        }elseif($duracion == 2){
            $resultados = Usuario::buscarCuentaPorApellido($q);
            return View::make('reasignarPassword/resultadosbuscarcuenta')->with('resultados', $resultados);


        }elseif($duracion == 3){
            $resultados = Usuario::buscarCuentaPorLogin($q);
            return View::make('reasignarPassword/resultadosbuscarcuenta')->with('resultados',$resultados);
        }
    }

    public function mostrarCuentaVPN($id){
        $vpn = Vpn::find($id);
        return View::make('reasignarPassword/mostrarcuentavpn')
                   ->with('id',$id)
                   ->with('vpn',$vpn);
    }

    public function mostrarCuentaAplicacion($id){
        $usuario = Usuario::find($id);
        return View::make('reasignarPassword/mostrarcuentaaplicacion')
            ->with('id',$id)
            ->with('usuario',$usuario);
    }

    public function mostrarCuentaMaquina($id){
        $maquina = Maquina::find($id);
        return View::make('reasignarPassword/mostrarcuentamaquina')
            ->with('id',$id)
            ->with('maquina',$maquina);
    }

    public function cambiarPasswordVPN(){

        $id = Input::get('id');
        $password = Input::get('password');

        $vpn = Vpn::find($id);
        $vpn->vplo_password = $password;
        $vpn->obfuscada = 0;
        $vpn->save();

        Session::flash('message', '¡El password se ha reasignado exitosamente!');
        return Redirect::to('reasignarpassword/mostrarreasignarpassword');
    }

    public function cambiarPasswordMaquina(){

        $id = Input::get('id');
        $password = Input::get('password');

        $maquina = Maquina::find($id);
        $maquina->malo_password = $password;
        $maquina->obfuscada = 0;
        $maquina->save();

        Session::flash('message', '¡El password se ha reasignado exitosamente!');
        return Redirect::to('reasignarpassword/mostrarreasignarpassword');
    }

    public function cambiarPasswordAplicacion(){

        $id = Input::get('id');
        $password = Input::get('password');

        $usuario = Usuario::find($id);
        $usuario->password = Hash::make($password);
        $usuario->save();

        Session::flash('message', '¡El password se ha reasignado exitosamente!');
        return Redirect::to('reasignarpassword/mostrarreasignarpassword');
    }
} 