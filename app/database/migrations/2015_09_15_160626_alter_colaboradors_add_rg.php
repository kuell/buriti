<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterColaboradorsAddRg extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('colaboradors', function (Blueprint $table) {
				$table->string('rg', 30)->nullable();
				$table->string('emissor', 10)->nullable();
			});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('colaboradors', function (Blueprint $table) {
				$table->dropColumn('rg');
				$table->dropColumn('emissor');
			});
	}
}
