<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AlterSesmtInvestigacaoAlteracoes extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('sesmt.investigacao', function (Blueprint $table) {
				$table->dropColumn('parte_corpo_id');
				$table->integer('parte_corpo_id')->nullable();

				$table->dropColumn('testemunhas');
				$table->string('testemunhas')->nullable();

				$table->dropColumn('qtde_dias');
				$table->integer('qtde_dias')->nullable();

			});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('sesmt.investigacao', function (Blueprint $table) {
				//
			});
	}

}
