<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTaxaTaxaItensTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('taxa.taxa_itens', function (Blueprint $table) {
				$table->increments('id');
				$table->integer('taxa_id');
				$table->integer('item_id');
				$table->double('qtd', 12, 2);
				$table->double('peso', 12, 2);
				$table->double('valor', 12, 2);
				$table->string('tipo');

				$table->string('user_created', 20);
				$table->string('user_updated', 20);
				$table->timestamps();
			});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('taxa.taxa_itens');
	}

}
