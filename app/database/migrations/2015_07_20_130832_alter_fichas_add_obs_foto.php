<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AlterFichasAddObsFoto extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('cadastros.fichas', function (Blueprint $table) {
				$table->string('foto')->nullable();
				$table->text('obs')->nullable();
				$table->string('usuario_add', 20)->nullable();
			});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('cadastros.fichas', function (Blueprint $table) {
				$table->dropColumn('foto');
				$table->dropColumn('obs');
				$table->dropColumn('usuario_add');
			});
	}

}
