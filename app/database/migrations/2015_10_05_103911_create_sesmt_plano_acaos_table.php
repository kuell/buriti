<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSesmtPlanoAcaosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('sesmt.plano_acaos', function (Blueprint $table) {
				$table->increments('id');
				$table->integer('ocorrencia_id');
				$table->text('descricao');
				$table->text('situacao');
				$table->text('usuario_created');
				$table->text('usuario_updated');
				$table->timestamps();
			});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('sesmt.plano_acaos');
	}

}
