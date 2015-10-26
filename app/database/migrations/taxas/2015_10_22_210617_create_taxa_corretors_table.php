<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTaxaCorretorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {

		DB::statement('CREATE SCHEMA taxa');

		Schema::create('taxa.corretors', function (Blueprint $table) {
				$table->increments('id');
				$table->string('codigo_interno', 20);
				$table->string('nome', 40);
				$table->string('email')->nullable();
				$table->string('fone', 15)->nullable();
				$table->string('cel', 15)->nullable();
				$table->string('situacao');
				$table->string('obs')->nullable();

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
		Schema::dropIfExists('taxa.corretors');
		DB::statement('DROP SCHEMA taxa');
	}

}
