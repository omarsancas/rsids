<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProyectoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//


		Schema::create('proyecto', function(Blueprint $table)
		{
			$table->increments('id_proyecto');
			$table->integer('id_dependencia_fk');
			$table->string('nombre');
			$table->string('apellidoPaterno');
			$table->string('apellidoMaterno');
			$table->string('nombre_proyecto');
			$table->string('ultimo_grado');
			$table->string('sexo');
			$table->integer('telefono');
			$table->integer('extension');
			$table->integer('otro_telefono');
			$table->string('email');
			$table->string('ruta_curriculum');
			$table->string('ruta_documento_desc');
			$table->integer('horas_cpu');
			$table->integer('espacio_disco');
			$table->integer('memoria_ram');	
			$table->string('campo_trabajo');
			$table->string('otro_campo');
			$table->string('linea_especializacion');
			$table->string('otra_aplicacion');
			$table->string('modelo_computacional');
			$table->string('programacion_paralela');
			$table->integer('numero_procesadores');
			$table->string('duracion_promedio');
			
			
			
			

			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
		Schema::drop('proyecto');
	}

}
