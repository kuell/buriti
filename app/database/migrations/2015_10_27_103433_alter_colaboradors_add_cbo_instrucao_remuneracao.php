<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AlterColaboradorsAddCboInstrucaoRemuneracao extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('colaboradors', function (Blueprint $table) {
				$table->string('grau_instrucao')->nullable();
				$table->double('remuneracao')->nullable();
				$table->string('cbo')->nullable();
			});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('colaboradors', function (Blueprint $table) {
				$table->dropColumn('grau_instrucao');
				$table->dropColumn('remuneracao');
				$table->dropColumn('cbo');
			});
	}

}
