<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AlterOcorrenciasAddObsCausa extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('farmacia.ocorrencias', function (Blueprint $table) {
				$table->text('obs')->nullable();
				$table->integer('queixa_id')->nullable();
				$table->string('usuario_analise')->nullable();
			});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('farmacia.ocorrencias', function (Blueprint $table) {
				$table->dropColumn('obs');
				$table->dropColumn('queixa_id');
				$table->dropColumn('usuario_analise');
			});
	}

}
