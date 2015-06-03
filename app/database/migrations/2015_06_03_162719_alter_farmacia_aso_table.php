<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AlterFarmaciaAsoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('farmacia_asos', function (Blueprint $table) {
				$table->string('colaborador_rg')->nullable();
				$table->string('colaborador_orgao_emissor')->nullable();
			});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('farmacia_asos', function (Blueprint $table) {
				$table->dropColumn('colaborador_rg');
				$table->dropColumn('colaborador_orgao_emissor');
			});
	}

}
