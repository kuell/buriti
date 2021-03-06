<?php

use Illuminate\Database\Migrations\Migration;

class AlterColaboradorTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('colaboradors', function ($table) {
				$table->date('data_admissao')->nullable();
			});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('colaboradors', function ($table) {
				$table->dropColumn('data_admissao');
			});
	}

}
