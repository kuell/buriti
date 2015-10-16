<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AlterColaboradorPostosAddUser extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('colaborador_posto', function (Blueprint $table) {
				$table->string('user_created')->nullable();
			});
		Schema::table('colaborador_funcaos', function (Blueprint $table) {
				$table->string('user_created')->nullable();
			});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('colaborador_posto', function (Blueprint $table) {
				$table->dropColumn('user_created');
			});
		Schema::table('colaborador_funcaos', function (Blueprint $table) {
				$table->dropColumn('user_created');
			});

	}

}
