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
				$table->integer('local_atendimento_id');
				$table->integer('colaborador_id');
				$table->datetime('data_hora');
				$table->enum('tipo_atestado', array('consulta', 'acompanhamento'));
				$table->string('periodo_dia');
				$table->date('inicio_afastamento')->nullable();
				$table->date('fim_afastamento')->nullable();
				$table->boolean('doenca');
				$table->boolean('acidente_trabalho');
				$table->boolean('encaminha_seguro');
				$table->integer('cid_id');
				$table->integer('profissional_id');
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
