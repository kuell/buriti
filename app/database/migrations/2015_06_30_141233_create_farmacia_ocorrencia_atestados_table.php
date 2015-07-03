<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFarmaciaOcorrenciaAtestadosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		DB::statement('create schema farmacia');

		Schema::create('farmacia.ocorrencia_atestados', function (Blueprint $table) {
				$table->increments('id');
				$table->integer('ocorrencia_id');
				$table->string('local');
				$table->string('tipo');
				$table->integer('periodo');
				$table->date('inicio_afastamento');
				$table->date('fim_afastamento');
				$table->boolean('doente');
				$table->string('cid');
				$table->string('profissional');
				$table->string('obs');
				$table->timestamps();
			});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('farmacia.ocorrencia_atestados');
	}

}
