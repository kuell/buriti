<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AlterSesmtInvestigacaosAddPossiveisEventos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('sesmt.investigacaos', function (Blueprint $table) {
				$table->integer('possiveis_eventos_causadores')->nullable();
			});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('sesmt.investigacaos', function (Blueprint $table) {
				$table->dropColumn('possiveis_eventos_causadores');
			});
	}

}
