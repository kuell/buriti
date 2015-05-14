<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFarmaciaExameTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('farmacia_exames', function (Blueprint $table) {
				$table->increments('id');
				$table->date('data');
				$table->string('medico');
				$table->string('resultado')->nullable();
				$table->string('local_realizacao');
				$table->string('descricao');
				$table->string('tipo_exame');
				$table->integer('relacao_id');
				$table->timestamps();
			});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('farmacia_exames');
	}

}
