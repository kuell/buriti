<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateColaboradorFuncaoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('colaborador_funcaos', function (Blueprint $table) {
				$table->increments('id');
				$table->integer('colaborador_id');
				$table->integer('funcao_id');
				$table->date('data_mudanca');
				$table->timestamps();
			});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('colaborador_funcaos');
	}

}
