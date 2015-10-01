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
		DB::statement('alter table
	sesmt.investigacaos
		drop column parte_corpo_id,
		add column parte_corpo_id integer,
		drop column testemunhas,
		add column testemunhas varchar(100),
		drop column qtde_dias,
		add column qtde_dias integer');
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
