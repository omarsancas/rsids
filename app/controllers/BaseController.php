<?php

class BaseController extends Controller {

    /**
     * @param $nombre_login1
     * @return string
     */
    public function quitarAcentos($nombre_login1)
    {
        $unwanted_array = array('Š' => 'S', 'š' => 's', 'Ž' => 'Z', 'ž' => 'z', 'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'A', 'Ç' => 'C', 'È' => 'E', 'É' => 'E',
                                'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ø' => 'O', 'Ù' => 'U',
                                'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ý' => 'Y', 'Þ' => 'B', 'ß' => 'Ss', 'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'a', 'ç' => 'c',
                                'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 'ð' => 'o', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o',
                                'ö' => 'o', 'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ý' => 'y', 'ý' => 'y', 'þ' => 'b', 'ÿ' => 'y');
        $str = strtr($nombre_login1, $unwanted_array);
        $nombre_login = strtoupper($str);

        return $nombre_login;
    }

    /**
     * @param $querynombre
     * @return mixed
     */
    public function obtenerCuentasTitulares($querynombre)
    {
        $usuarios = DB::table('usuario')
            ->join('usuario_x_proyecto', 'usuario.usua_id_usuario', '=', 'usuario_x_proyecto.uspr_id_usuario')
            ->join('proyecto', 'usuario_x_proyecto.uspr_id_proyecto', '=', 'proyecto.proy_id_proyecto')
            ->join('tipo_usuario', 'usuario.usua_id_tipo_usuario', '=', 'tipo_usuario.tius_id_tipo_usuario')
            ->where('usua_nom_completo', 'LIKE', "%$querynombre%")
            ->where('usua_id_tipo_usuario', '=', 2)
            ->get();

        return $usuarios;
    }


    /**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

}
