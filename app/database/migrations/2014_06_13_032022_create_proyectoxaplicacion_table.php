<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProyectoxaplicacionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//

		Schema::create('proyectoxaplicacion', function(Blueprint $table)
		{
			$table->increments('id_proyectoxaplicacion');
			$table->string('id_proyecto');
			$table->string('id_aplicacion');
			
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
		Schema::drop('proyectoxaplicacion');
	}

}
