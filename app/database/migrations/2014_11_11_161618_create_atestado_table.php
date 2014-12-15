<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAtestadoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('farmacia_atestados', function (Blueprint $table) {
				$table->increments('id');
				$table->string('local_atendimento');
				$table->integer('colaborador_id');
				$table->integer('tipo_atestado');
				$table->string('periodo_dispensa');
				$table->date('inicio_afastamento')->nullable();
				$table->date('fim_afastamento')->nullable();
				$table->boolean('doenca');
				$table->boolean('acidente_trabalho');
				$table->string('cid');
				$table->string('profissional');
				$table->string('cat');
				$table->timestamps();
			});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('farmacia_atestados');
	}

}
