<?php

use Illuminate\Database\Migrations\Migration;

class CreateTaxaViewCorretorsAtivosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		DB::statement("create or replace view taxa.v_corretors_ativos as
							select
								*
							from
								taxa.corretors
							where
								situacao = '0'");
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		DB::statement('drop view taxa.v_corretors_ativos');
	}

}
