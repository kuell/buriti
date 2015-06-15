<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AlterFarmaciaOcorrenciaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('farmacia_ocorrencias', function (Blueprint $table) {
				$table->integer('elemento_id')->nullable();
			});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('farmacia_ocorrencias', function (Blueprint $table) {
				//
			});
	}

}
