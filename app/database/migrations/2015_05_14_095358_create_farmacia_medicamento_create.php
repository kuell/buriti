<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFarmaciaMedicamentoCreate extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('farmacia_medicamentos', function (Blueprint $table) {
				$table->increments('id');
				$table->string('descricao');
				$table->timestamps();
			});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('farmacia_medicamentos');
	}

}
