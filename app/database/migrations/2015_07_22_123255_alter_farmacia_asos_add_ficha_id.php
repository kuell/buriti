<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AlterFarmaciaAsosAddFichaId extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::rename('farmacia_asos', 'asos');

		DB::statement('alter table asos set schema farmacia');

		Schema::table('farmacia.asos', function (Blueprint $table) {
				$table->integer('ficha_id')->nullable();
			});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::rename('farmacia.asos', 'farmacia_asos');

		DB::statement('alter table farmacia.farmacia_asos set schema public');

		Schema::table('farmacia_asos', function (Blueprint $table) {
				$table->dropColumn('ficha_id');
			});
	}

}
