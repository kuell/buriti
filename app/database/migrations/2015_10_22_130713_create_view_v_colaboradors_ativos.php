<?php

use Illuminate\Database\Migrations\Migration;

class CreateViewVColaboradorsAtivos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		DB::statement("CREATE OR REPLACE VIEW v_colaboradors_ativos AS
							 SELECT *
							   FROM colaboradors a
							  WHERE a.situacao = 'ativo' OR a.situacao IS NULL");
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		DB::statement('drop view if exists v_colaboradors_ativos');
	}

}
