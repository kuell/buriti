<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AlterFarmaciaExamesExamesAddValidade extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {

		Schema::rename('farmacia_exames', 'aso_exames');
		DB::statement('alter table aso_exames set schema farmacia');

		Schema::table('farmacia.aso_exames', function (Blueprint $table) {
				$table->integer('exame_id')->nullable();
				$table->integer('validade')->nullable();
			});
		DB::statement('alter table farmacia.aso_exames alter column descricao drop not null');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('farmacia.aso_exames', function (Blueprint $table) {
				$table->dropColumn('exame_id');
				$table->dropColumn('validade');
			});
		DB::statement('alter table farmacia.aso_exames set schema public');
		Schema::rename('aso_exames', 'farmacia_exames');

	}

}
