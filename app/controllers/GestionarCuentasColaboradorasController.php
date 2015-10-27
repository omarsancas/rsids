<?php
/**
 *
 * User: Omar
 * Date: 27/11/14
 * Time: 06:18 PM
 * Clase que implementa todos los métodos del caso de uso Gestionar cuentas colaboradoras
 */

class GestionarCuentasColaboradorasController extends BaseController {
    /**
     *Regresa la vista principal para agregar una cuenta colaboradora
     * return @mixed
     */
    public function mostrarAgregarCuentaColaboradora()
    {
        return View::make('gestionarcuentascolaboradoras/agregarcuentacolaboradora');
    }

    /**
    * Obtiene las cuentas colaboradoras por medio de una búsqueda
    *
    * Input:
    * $query @string parametro de búsqueda
    * Output:
    * $proyectos @object regresa todos los proyectos encontrados
    */
    public function agregarCuentaColaboradora()
    {
        $query = Input::get('q');

        $proyectos = DB::table('usuario')
            ->join('usuario_x_proyecto', 'usuario.usua_id_usuario', '=', 'usuario_x_proyecto.uspr_id_usuario')
            ->join('proyecto', 'usuario_x_proyecto.uspr_id_proyecto', '=', 'proyecto.proy_id_proyecto')
            ->join('tipo_usuario', 'usuario.usua_id_tipo_usuario', '=', 'tipo_usuario.tius_id_tipo_usuario')
            ->where('proy_nombre', 'LIKE', "%$query%")
            ->where('usua_id_tipo_usuario','=',2)
            ->get();

        return View::make('gestionarcuentascolaboradoras/agregarcuentacolaboradoravista')->with('proyectos',$proyectos);

    }

    /**
    *
    *Parámetros:
    *Input:
    *Output:
    *
    */
    public function agregarCuentaColaboradoraProyectoVista($idproyecto)
    {
        $dependencias_catalogo = Dependencia::lists('depe_nombre', 'depe_id_dependencia');
        $grado = Grado::lists('grad_nombre', 'grad_id_grado');
        $proyecto = Proyecto::findOrFail($idproyecto);
        $solicitud = Proyecto::findOrFail($idproyecto)->solicitud;

        return View::make('gestionarcuentascolaboradoras/agregarcuentacolaboradoraproyecto')
                   ->with('proyecto',$proyecto)
                   ->with('grado',$grado)
                   ->with('dependencias_catalogo',$dependencias_catalogo)
                   ->with('solicitud',$solicitud);

    }

    public function agregarCuentaColaboradoraProyecto()
    {
        $idproyecto = Input::get('idproyecto');
        $rules = array(
            'nombre'               => 'required|min:3',
            'apellidopaterno'      => 'required',
            'telefono'             => 'required|numeric',

            'email'                => 'required|email',
            'usua_id_usuario'        => 'required|unique:usuario'
        );

        $mensajes = array(
            'required' => ' El campo :attribute es obligatorio',
            'numeric' => ' El campo :attribute solo debe contener números'
         );

        $validator = Validator::make(Input::all(), $rules, $mensajes);
        if ($validator->fails())
        {


            $messages = $validator->messages();

            // redirect our user back to the form with the errors from the validator
            return Redirect::route('agregar',$idproyecto)
                ->withErrors($validator)->withInput(Input::except('curriculum', 'constancias', 'documentodescriptivo'));
        } else
        {
        $idproyecto = Input::get('idproyecto');
        $idsolicitud = Input::get('idsolicitud');

        $solcol = new Cuentacol();
        $solcol->soco_id_solicitud_abstracta = $idsolicitud;
        $solcol->soco_id_estado_colaboradora = 2;
        $solcol->soco_id_dependencia = Input::get('dependencia');
        $solcol->soco_id_grado = Input::get('grado');
        $solcol->soco_ap_paterno = Input::get('apellidopaterno');
        $solcol->soco_ap_materno = Input::get('apellidomaterno');
        $solcol->soco_nombres = Input::get('nombre');
        $solcol->soco_sexo = Input::get('sexo');
        $solcol->save();
        $mediocomunicacion = new MedioComunicacion();
        $mediocomunicacion->meco_telefono1 = Input::get('telefono');
        $mediocomunicacion->meco_extension = Input::get('extension');
        $mediocomunicacion->meco_telefono2 = Input::get('otrotelefono');
        $mediocomunicacion->meco_correo = Input::get('email');
        $mediocomunicacion->save();
        $solcol->soco_id_medio_comunicacion = $mediocomunicacion->MECO_ID_MEDIO_COMUNICACION;
        $solcol->save();

        $login = Input::get('usua_id_usuario');
        $nombre =  Input::get('nombre');
        $appaterno = Input::get('apellidopaterno') ;
        $apmaterno = Input::get('apellidomaterno');

        $usua_nombre_concatenado = $nombre . ' ' . $appaterno . ' ' . $apmaterno;
        $password = $this->generarPassword();
        $usuariocol = new Usuario();
        $usuariocol->usua_id_usuario = $login;
        $usuariocol->usua_id_tipo_usuario = 3;
        $usuariocol->usua_id_estado_usuario = 1;
        $usuariocol->password = Hash::make($password);
        $usuariocol->usua_nom_completo = $usua_nombre_concatenado;
        $usuariocol->save();

        $proyecto = Proyecto::findOrFail($idproyecto);
        $usuarioid = $usuariocol->usua_id_usuario;
        $proyecto->usuarios()->attach($usuarioid);

        $nombre_login1 = $nombre . '_' . $appaterno . '_' . $apmaterno;
        $nombre_login1 = $this->quitarAcentos($nombre_login1);
        $grupo = substr($login, 0, 2);

        $passwordvpn = $this->generarPassword();
        $vpn = new Vpn;
        $vpn->vplo_login = $login;
        $vpn->vplo_password = $passwordvpn;
        $vpn->vplo_nombre = $nombre_login1;
        $vpn->vplo_grupo_principal = $grupo . '_' . 'g';
        $vpn->save();

        $passwordmaquinatitular = $this->generarPassword();
        $maquina = new Maquina();
        $maquina->malo_login = $login;
        $maquina->malo_password = $passwordmaquinatitular;
        $maquina->malo_nombre = $nombre_login1;
        $maquina->malo_grupo_principal = $grupo . '_' . 'g';
        $maquina->save();

        Session::flash('message','La cuenta colaboradora se ha agregado exitosamente');
        return Redirect::to('gestionarcuentascolaboradoras/agregarcuentascolaboradoras');
        }
    }

    public function mostrarModificarCuentaColaboradora()
    {
        return View::make('gestionarcuentascolaboradoras/modificarcuentacolaboradoravista');
    }

    public function buscarCuentaColaboradora()
    {
        $proyectos = $this->buscarCuenta();

        return View::make('gestionarcuentascolaboradoras/modificarcuentacolaboradora')->with('proyectos',$proyectos);
    }

    public function modificarCuentaColaboradoraVista($id)
    {

    }

    public function modificarCuentaColaboradora()
    {

    }

    public function mostrarConsultarCuentaColaboradora()
    {
        return View::make('gestionarcuentascolaboradoras/consultarcuentacolaboradoravista');
    }

    public function buscarCuentaColaboradoraParaConsulta()
    {
        $proyectos = $this->buscarCuenta();

        return View::make('gestionarcuentascolaboradoras/consultarcuentacolaboradora')->with('proyectos',$proyectos);
    }

    public function consultarCuentaColaboradora($idusuario)
    {
        $proyecto = DB::table('contabilidad')
            ->select(DB::raw('sum(contabilidad.cont_num_jobs) AS totaljobs, usua_id_usuario ,proy_id_proyecto, proy_nombre, sum(contabilidad.cont_hrs_nodo) AS totalnodo,
            proy_hrs_aprobadas, usua_nom_completo ,CONCAT(FORMAT(IF(proy_hrs_aprobadas=0,0,(sum(contabilidad.cont_hrs_nodo)*100.0)/proy_hrs_aprobadas),2)) AS porcentajeproyecto'))
            ->join('usuario', 'contabilidad.cont_id_usuario', '=', 'usuario.usua_id_usuario')
            ->join('usuario_x_proyecto', 'usuario.usua_id_usuario', '=', 'usuario_x_proyecto.uspr_id_usuario')
            ->join('proyecto', 'usuario_x_proyecto.uspr_id_proyecto', '=', 'proyecto.proy_id_proyecto')
            ->where('usuario.usua_id_usuario', '=', $idusuario)
            ->groupBy('usuario.usua_id_usuario')
            ->first();

        return View::make('gestionarcuentascolaboradoras/consultarcuentacolaboradoraespecifica')->with('proyecto',$proyecto);
    }



    /**
     * @return mixed
     */
    public function buscarCuenta()
    {
        $query = Input::get('q');
        $proyectos = DB::table('usuario')
            ->join('usuario_x_proyecto', 'usuario.usua_id_usuario', '=', 'usuario_x_proyecto.uspr_id_usuario')
            ->join('proyecto', 'usuario_x_proyecto.uspr_id_proyecto', '=', 'proyecto.proy_id_proyecto')
            ->join('tipo_usuario', 'usuario.usua_id_tipo_usuario', '=', 'tipo_usuario.tius_id_tipo_usuario')
            ->where('proy_nombre', 'LIKE', "%$query%")
            ->orWhere('usua_nom_completo', 'LIKE', "%$query%")
            ->where('usua_id_tipo_usuario', '=', 3)
            ->get();

        return $proyectos;
    }


} 