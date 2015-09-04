<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CorrigeOcorrenciasAddSetorPosto extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('farmacia.ocorrencias', function (Blueprint $table) {
				$table->integer('setor_id')->nullable();
				$table->integer('posto_id')->nullable();
			});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('farmacia.ocorrencias', function (Blueprint $table) {
				$table->dropColumn('posto_id');
				$table->dropColumn('posto_id');
			});
	}

}
