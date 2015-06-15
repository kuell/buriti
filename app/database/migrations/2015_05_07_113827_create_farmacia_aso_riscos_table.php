<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFarmaciaAsoRiscosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('farmacia_aso_riscos', function (Blueprint $table) {
				$table->increments('id');
				$table->integer('aso_id');
				$table->integer('risco_id');
				$table->timestamps();
			});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('farmacia_aso_riscos');
	}

}
