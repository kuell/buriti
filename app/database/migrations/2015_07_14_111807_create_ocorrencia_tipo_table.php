<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOcorrenciaTipoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {

		DB::statement('create schema sesmt');

		Schema::rename('sesmt_investigacaos', 'investigacaos');
		DB::statement('alter table investigacaos set schema sesmt');

		Schema::create('farmacia.ocorrencia_tipos', function (Blueprint $table) {
				$table->increments('id');
				$table->string('descricao');
				$table->timestamps();
			});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('farmacia.ocorrencia_tipos');
	}

}
