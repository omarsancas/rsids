<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 27/11/14
 * Time: 06:18 PM
 */

class GestionarCuentasColaboradorasController extends BaseController {

    public function mostrarAgregarCuentaColaboradora()
    {
        return View::make('gestionarcuentascolaboradoras/agregarcuentacolaboradora');
    }

    public function agregarCuentaColaboradora()
    {
        $query = Input::get('q');

        $proyectos = DB::table('usuario')
            ->join('usuario_x_proyecto', 'usuario.usua_id_usuario', '=', 'usuario_x_proyecto.uspr_id_usuario')
            ->join('proyecto', 'usuario_x_proyecto.uspr_id_proyecto', '=', 'proyecto.proy_id_proyecto')
            ->join('tipo_usuario', 'usuario.usua_id_tipo_usuario', '=', 'tipo_usuario.tius_id_tipo_usuario')
            ->where('proy_nombre', 'LIKE', "%$query%")
            ->get();

        return View::make('gestionarcuentascolaboradoras/agregarcuentacolaboradoravista')->with('proyectos',$proyectos);

    }

    public function agregarCuentaColaboradoraProyecto($idproyecto)
    {
        $proyecto = Proyecto::findOrFail($idproyecto);
        return View::make('gestionarcuentascolaboradoras/agregarcuentacolaboradoraproyecto')->with('proyecto',$proyecto);
    }
} 