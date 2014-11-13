<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOcorrenciaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('farmacia_ocorrencias', function (Blueprint $table) {
				$table->increments('id');
				$table->datetime('data_hora');
				$table->integer('colaborador_id');
				$table->string('relato');
				$table->string('diagnostico');
				$table->string('conduta');
				$table->string('encaminhamento');
				$table->string('profissional');
				$table->timestamps();
			});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('farmacia_ocorrencias');
	}

}
