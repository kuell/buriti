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
				$table->boolean('sexo')->nullable();
				$table->boolean('interno');
				$table->date('data_nascimento')->nullable();
				$table->string('endereco')->nullable();
				$table->string('bairro')->nullable();
				$table->string('contato')->nullable();
				$table->integer('setor_id')->nullable();
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
