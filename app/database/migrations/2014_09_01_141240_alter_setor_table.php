<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AlterSetorTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('setors', function (Blueprint $table) {
				$table->time('padrao_horatrabalho')->default('08:20:00');
				$table->boolean('situacao')->default(true);
			});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('setors', function (Blueprint $table) {
				$table->dropColumn('padrao_horatrabalho');
				$table->dropColumn('situacao');
			});
	}

}
