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
				$table->dropColumn('colaborador_id');
				$table->dropColumn('situacao');
			});

		Schema::table('farmacia_asos', function (Blueprint $table) {
				$table->integer('colaborador_id')->nullable();
				$table->string('colaborador_nome')->nullable();
				$table->date('colaborador_data_nascimento')->nullable();
				$table->boolean('colaborador_sexo')->nullable();
				$table->integer('colaborador_setor_id')->nullable();
				$table->integer('colaborador_matricula')->nullable();
				$table->date('colaborador_data_admissao')->nullable();
				$table->string('situacao')->default('aberto');
				$table->string('status')->nullable();
				$table->string('obs')->nullable();
			});

		Schema::table('colaboradors', function (Blueprint $table) {
				$table->text('obs')->nullable();

			});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {

		Schema::table('farmacia_asos', function (Blueprint $table) {
				$table->dropColumn('colaborador_id');
				$table->dropColumn('colaborador_nome');
				$table->dropColumn('colaborador_data_nascimento');
				$table->dropColumn('colaborador_sexo');
				$table->dropColumn('colaborador_setor_id');
				$table->dropColumn('colaborador_data_admissao');
				$table->dropColumn('situacao');
				$table->dropColumn('status');
				$table->dropColumn('obs');
				$table->dropColumn('colaborador_matricula');
			});
		Schema::table('colaboradors', function (Blueprint $table) {
				$table->dropColumn('obs');

			});

	}

}
