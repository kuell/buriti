<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AlterOcorrenciasAddSituacao extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('farmacia.ocorrencias', function (Blueprint $table) {
				$table->string('situacao', 30)->default('aberto');
				$table->string('usuario_finalizacao', 30)->nullable();
			});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('farmacia.ocorrencias', function (Blueprint $table) {
				$table->dropColumn('situacao');
				$table->dropColumn('usuario_finalizacao');
			});
	}

}
