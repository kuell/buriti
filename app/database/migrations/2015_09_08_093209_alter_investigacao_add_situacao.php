<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AlterInvestigacaoAddSituacao extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('sesmt.investigacaos', function (Blueprint $table) {
				$table->string('situacao')->default('Em investigacao');
			});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('sesmt.investigacaos', function (Blueprint $table) {
				$table->dropColumn('situacao');
			});
	}

}
