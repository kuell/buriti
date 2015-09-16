<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AlterFarmaciaOcorrenciaQueixas extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('farmacia.ocorrencia_queixas', function (Blueprint $table) {
				$table->boolean('pcmso')->default(false);
			});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('farmacia.ocorrencia_queixas', function (Blueprint $table) {
				$table->dropColumn('pcmso');
			});
	}

}
