<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateColaboradorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('colaboradors', function (Blueprint $table) {
				$table->increments('id');
				$table->string('nome');
				$table->boolean('sexo');
				$table->boolean('interno');
				$table->date('data_nascimento');
				$table->string('endereco');
				$table->string('bairro');
				$table->string('contato');
				$table->integer('setor_id');
				$table->integer('codigo_interno');
				$table->timestamps();
			});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('colaboradors');
	}

}
