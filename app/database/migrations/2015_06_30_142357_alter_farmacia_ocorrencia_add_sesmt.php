<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AlterFarmaciaOcorrenciaAddSesmt extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::rename('farmacia_ocorrencias', 'ocorrencias');
		Schema::rename('farmacia_ocorrencia_medicacaos', 'ocorrencia_medicacaos');
		DB::statement('alter table ocorrencias set schema farmacia');
		DB::statement('alter table ocorrencia_medicacaos set schema farmacia');

		Schema::table('farmacia.ocorrencias', function (Blueprint $table) {
				$table->boolean('sesmt')->default('false')->nullable();
			});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {

		Schema::table('farmacia.ocorrencias', function (Blueprint $table) {
				$table->dropColumn('sesmt');
			});

		DB::statement('alter table farmacia.ocorrencias set schema public');
		DB::statement('alter table farmacia.ocorrencia_medicacaos set schema public');

		Schema::rename('ocorrencias', 'farmacia_ocorrencias');
		Schema::rename('ocorrencia_medicacaos', 'farmacia_ocorrencia_medicacaos');

	}

}
