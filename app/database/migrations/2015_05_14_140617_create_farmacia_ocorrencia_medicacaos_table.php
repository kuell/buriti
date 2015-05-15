<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFarmaciaOcorrenciaMedicacaosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('farmacia_ocorrencia_medicacaos', function (Blueprint $table) {
				$table->increments('id');
				$table->integer('ocorrencia_id');
				$table->integer('medicacao_id');
				$table->double('qtd');
				$table->string('medida');
				$table->timestamps();
			});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('farmacia_ocorrencia_medicacaos');
	}

}
