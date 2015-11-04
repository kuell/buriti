<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AlterColaboradorsAddUserUpdate extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('colaboradors', function (Blueprint $table) {
				$table->string('user_updated')->nullable();
				$table->string('user_created')->nullable();
			});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('colaboradors', function (Blueprint $table) {
				$table->dropColumn('user_updated');
				$table->dropColumn('user_created');
			});
	}

}
