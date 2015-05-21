<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 3/05/15
 * Time: 06:47 PM
 */

class GestionarCuentasLogin extends BaseController {

    public function mostrarObfuscarCuentasMaquina(){
        $cuentasmaquina = DB::table('maquina_login')
                          ->where('obfuscada', '=', 0)
                          ->get();
        return View::make('gestionarcuentaslogin/cuentamaquina')->with('cuentas',$cuentasmaquina);
    }

    public function obfuscarCuentasMaquina(){
        $cuentas = Input::get('check_box');

        //var_dump($cuentas);

        foreach($cuentas as $cuenta){
           $maquina = Maquina::find($cuenta);
           $maquina->malo_password = 'xxxxxx';
           $maquina->obfuscada = 1;
           $maquina->save();
        }
        Session::flash('message', '¡Las cuentas seleccionadas se han obfuscado exitosamente!');
        return Redirect::to('gestionarcuentaslogin/mostrarobfuscarcuentasmaquina');
    }

    public function mostrarObfuscarCuentasVpn(){
        $cuentasmaquina = Vpn::all();
        return View::make('gestionarcuentaslogin/cuentavpn')->with('cuentas',$cuentasmaquina);
    }

    public function obfuscarCuentasVpn(){
        $cuentas = Input::get('check_box');

        //var_dump($cuentas);

        foreach($cuentas as $cuenta){
            $vpn = Vpn::find($cuenta);
            $vpn->vplo_password = 'xxxxxx';
            $vpn->obfuscada = 1;
            $vpn->save();
        }
        Session::flash('message', '¡Las cuentas seleccionadas se han obfuscado exitosamente!');
        return Redirect::to('gestionarcuentaslogin/mostrarobfuscarcuentasvpn');
    }
} 