<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateColaboradorSetorTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('colaborador_setors', function (Blueprint $table) {
				$table->increments('id');
				$table->integer('colaborador_id');
				$table->integer('setor_id');
				$table->integer('aso_id');
				$table->integer('posto_id');
				$table->timestamps();
			});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('colaborador_setors');
	}

}
