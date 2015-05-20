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
        $vpn = Vpn::find($id);
        return View::make('reasignarPassword/mostrarcuentavpn')
            ->with('id',$id)
            ->with('vpn',$vpn);
    }

    public function mostrarCuentaMaquina($id){
        $vpn = Vpn::find($id);
        return View::make('reasignarPassword/mostrarcuentavpn')
            ->with('id',$id)
            ->with('vpn',$vpn);
    }
} 