<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateComprasPedidoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('compras.pedidos', function (Blueprint $table) {
				$table->increments('id');
				$table->integer('setor_id');
				$table->string('solicitante', 40)->nullable();
				$table->integer('osi_id')->nullable()->default(0);
				$table->text('obs')->nullable();
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
		Schema::dropIfExists('compras.pedidos');
	}

}
