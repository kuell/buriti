<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AlterAsoAddFuncao extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('farmacia.asos', function (Blueprint $table) {
				$table->integer('colaborador_funcao_id')->nullable();
			});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('farmacia.asos', function (Blueprint $table) {
				$table->dropColumn('colaborador_funcao_id');
			});
	}

}
