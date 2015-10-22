<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateComprasProdutosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		DB::statement('create schema compras');

		Schema::create('compras.produtos', function (Blueprint $table) {
				$table->increments('id');
				$table->string('descricao');
				$table->string('codigo_interno');
				$table->string('agrupamento', 50);
				$table->string('situacao', 20);
				$table->string('unidade_medida', 20);
				$table->string('img')->nullable();
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
		Schema::dropIfExists('compras.produtos');
		DB::statement('DROP SCHEMA compras');
	}

}
