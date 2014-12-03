<?php
use \Hackzilla\PasswordGenerator\Generator\ComputerPasswordGenerator;

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
     * @param $solicitudabstracta
     */
    public function guardarArchivos($solicitudabstracta)
    {
        if (Input::hasFile('curriculum'))
        {
            $archivo = $solicitudabstracta->SOAB_CURRICULUM;
            File::delete($archivo);
            $destinationPath = $solicitudabstracta->SOAB_RUTA_ARCHVIVOS;
            /** @var $filename1 TYPE_NAME */
            $filename1 = $solicitudabstracta->SOAB_ID_SOLICITUD_ABSTRACTA . '_' . 'CV' . '.' . Input::file('curriculum')->getClientOriginalExtension();
            $upload_success1 = Input::file('curriculum')->move($destinationPath, $filename1);


            if ($upload_success1)
            {
                $solicitudabstracta->soab_curriculum = $destinationPath . '/' . $filename1;
                $solicitudabstracta->save();
            }
        }


        if (Input::hasFile('docdesc'))
        {
            $archivo = $solicitudabstracta->SOAB_DESC_PROYECTO;
            File::delete($archivo);
            $destinationPath = $solicitudabstracta->SOAB_RUTA_ARCHVIVOS;
            /** @var $filename1 TYPE_NAME */
            $filename2 = $solicitudabstracta->SOAB_ID_SOLICITUD_ABSTRACTA . '_' . 'DOCDESC' . '.' . Input::file('documentodescriptivo')->getClientOriginalExtension();
            $upload_success2 = Input::file('documentodescriptivo')->move($destinationPath, $filename2);


            if ($upload_success2)
            {
                $solicitudabstracta->soab_desc_proyecto = $destinationPath . '/' . $filename2;
                $solicitudabstracta->save();
            }
        }


        if (Input::hasFile('constancias'))
        {
            $archivo = $solicitudabstracta->SOAB_CON_ADSCRIPCION;
            File::delete($archivo);
            $destinationPath = $solicitudabstracta->SOAB_RUTA_ARCHVIVOS;
            /** @var $filename1 TYPE_NAME */
            $filename3 = $solicitudabstracta->SOAB_ID_SOLICITUD_ABSTRACTA . '_' . 'CONSTANCIA' . '.' . Input::file('constancias')->getClientOriginalExtension();
            $upload_success3 = Input::file('constancias')->move($destinationPath, $filename3);

            if ($upload_success3)
            {
                $solicitudabstracta->soab_con_adscripcion = $destinationPath . '/' . $filename3;
                $solicitudabstracta->save();
            }
        }
    }

    /**
     * @return array
     */
    public function generarPassword()
    {
        $generator = new \Hackzilla\PasswordGenerator\Generator\ComputerPasswordGenerator();
        $generator->setOptions(\Hackzilla\PasswordGenerator\Generator\ComputerPasswordGenerator::OPTION_UPPER_CASE
            | \Hackzilla\PasswordGenerator\Generator\ComputerPasswordGenerator::OPTION_LOWER_CASE
            | \Hackzilla\PasswordGenerator\Generator\ComputerPasswordGenerator::OPTION_NUMBERS
            | \Hackzilla\PasswordGenerator\Generator\ComputerPasswordGenerator::OPTION_SYMBOLS
            | \Hackzilla\PasswordGenerator\Generator\ComputerPasswordGenerator::OPTION_AVOID_SIMILAR);
        $generator->setLength(12);
        $password = $generator->generatePassword();

        return $password;
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
