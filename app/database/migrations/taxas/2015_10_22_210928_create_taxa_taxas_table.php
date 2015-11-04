<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTaxaTaxasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('taxa.taxas', function (Blueprint $table) {
				$table->increments('id');
				$table->date('data');
				$table->integer('corretor_id');
				$table->string('obs');

				$table->string('user_created');
				$table->string('user_updated');

				$table->timestamps();
			});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('taxa.taxas');
	}

}
