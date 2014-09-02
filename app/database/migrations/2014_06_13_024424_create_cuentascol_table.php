<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCuentascolTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('cuentascol', function(Blueprint $table)
		{
			$table->increments('id_cuentacol');
			$table->integer('id_proyecto');
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
		Schema::drop('cuentascol');
	}

}
