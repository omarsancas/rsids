<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDependenciasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//


		Schema::create('dependencias', function(Blueprint $table)
		{
			$table->increments('id_dependencia');
			$table->string('nombre_dependencia');
			$table->string('clave');
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
		Schema::drop('dependencias');
	}

}
