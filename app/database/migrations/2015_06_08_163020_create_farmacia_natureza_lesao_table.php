<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFarmaciaNaturezaLesaoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('farmacia_natureza_lesao', function (Blueprint $table) {
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
		Schema::dropIfExists('farmacia_natureza_lesao');
	}

}
