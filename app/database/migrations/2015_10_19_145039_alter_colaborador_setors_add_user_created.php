<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AlterColaboradorSetorsAddUserCreated extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('colaborador_setors', function (Blueprint $table) {
				$table->string('user_created')->nullable();
			});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('colaborador_setors', function (Blueprint $table) {
				$table->dropColumn('user_created');
			});
	}

}
