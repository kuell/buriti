<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSesmtInvestigacaoCat extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('sesmt.investigacao_cats', function (Blueprint $table) {
				$table->increments('id');
				$table->string('investigacao_id');
				$table->string('numero_cat')->unique();
				$table->string('grau_instrucao');
				$table->double('remuneracao');
				$table->string('cbo');
				$table->string('agente_causador');
				$table->string('situacao_geradora');

				$table->string('user_created');
				$table->string('user_updated');
				$table->timestamps();
			});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('sesmt.investigacao_cats');
	}

}
