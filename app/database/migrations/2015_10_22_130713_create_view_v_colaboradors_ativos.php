<?php

use Illuminate\Database\Migrations\Migration;

class CreateViewVColaboradorsAtivos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		DB::statement("select * from colaboradors a  where a.situacao = 'ativo' or a.situacao is null");
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
