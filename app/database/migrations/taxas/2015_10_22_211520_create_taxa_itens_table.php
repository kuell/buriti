<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTaxaItensTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('taxa.itens', function (Blueprint $table) {
				$table->increments('id');
				$table->string('descricao', 40);
				$table->string('grupo');
				$table->boolean('fiscal');
				$table->string('genero', 20);
				$table->string('situacao');

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
		Schema::dropIfExists('taxa.itens');
	}

}
