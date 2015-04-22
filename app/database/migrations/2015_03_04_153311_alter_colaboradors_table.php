<?php

use Illuminate\Database\Migrations\Migration;

class AlterColaboradorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('colaboradors', function ($table) {
				$table->string('situacao')->nullable();
			});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('colaboradors', function ($table) {
				$table->dropColumn('situacao');
			});
	}

}
