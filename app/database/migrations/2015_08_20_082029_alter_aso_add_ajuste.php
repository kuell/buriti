<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AlterAsoAddAjuste extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('farmacia.asos', function (Blueprint $table) {
				$table->boolean('ajuste')->nullable();
			});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('farmacia.asos', function (Blueprint $table) {
				$table->dropColumn('ajuste');
			});
	}

}
