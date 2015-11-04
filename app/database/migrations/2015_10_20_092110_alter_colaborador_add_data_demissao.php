<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AlterColaboradorAddDataDemissao extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('colaboradors', function (Blueprint $table) {
				$table->date('data_demissao')->nullable();
			});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('colaboradors', function (Blueprint $table) {
				$table->dropColumn('data_demissao');
			});
	}

}
