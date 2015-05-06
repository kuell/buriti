<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFarmaciaAsoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('farmacia_asos', function (Blueprint $table) {
				$table->increments('id');
				$table->integer('posto_id');
				$table->integer('colaborador_id');
				$table->date('data')->nullable();
				$table->string('tipo');
				$table->string('medico');
				$table->string('situacao');

				$table->timestamps();
			});
		Schema::table('posto_riscos', function ($table) {
				$table->string('situacao')->default('ativo');
			});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('farmacia_asos');
	}

}
