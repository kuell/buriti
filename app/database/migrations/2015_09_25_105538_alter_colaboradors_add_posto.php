<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AlterColaboradorsAddPosto extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('colaboradors', function (Blueprint $table) {
				$table->integer('posto_id')->nullable();
				$table->integer('funcao_id')->nullable();
			});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('colaboradors', function (Blueprint $table) {
				$table->dropColumn('posto_id');
				$table->dropColumn('funcao_id');
			});
	}

}
