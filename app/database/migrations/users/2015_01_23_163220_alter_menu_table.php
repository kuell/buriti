<?php

use Illuminate\Database\Migrations\Migration;

class AlterMenuTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('menus', function ($table) {
				$table->string('color')->nullable();
			});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('menus', function ($table) {
				$table->dropColumn('color')->nullable();
			});
	}

}
