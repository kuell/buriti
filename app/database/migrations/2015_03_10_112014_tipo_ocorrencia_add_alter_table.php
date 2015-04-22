<?php

use Illuminate\Database\Migrations\Migration;

class TipoOcorrenciaAddAlterTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('farmacia_ocorrencias', function ($table) {
				$table->string('tipo')->nullable();
			});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('farmacia_ocorrencias', function ($table) {
				$table->dropColumn('tipo');
			});
	}

}
