<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AlterOcorrenciaTipoAddPai extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('farmacia.ocorrencia_tipos', function (Blueprint $table) {
				$table->integer('pai_id')->nullable();
			});

		Schema::table('farmacia.ocorrencias', function (Blueprint $table) {
				$table->integer('tipo_id')->nullable();
				$table->integer('sub_tipo_id')->nullable();
				$table->integer('gravidade')->nullable();
				$table->dropColumn('tipo');
			});

		DB::statement('truncate table farmacia.ocorrencia_tipos restart identity');

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('farmacia.ocorrencia_tipos', function (Blueprint $table) {
				$table->dropColumn('pai_id');
			});

		Schema::table('farmacia.ocorrencias', function (Blueprint $table) {
				$table->dropColumn('tipo_id');
				$table->dropColumn('sub_tipo_id');
				$table->dropColumn('gravidade');
			});

	}

}
