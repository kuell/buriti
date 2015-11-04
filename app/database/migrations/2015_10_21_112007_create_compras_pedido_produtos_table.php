<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateComprasPedidoProdutosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('compras.pedido_produtos', function (Blueprint $table) {
				$table->increments('id');
				$table->integer('pedido_id');
				$table->integer('produto_id');
				$table->double('qtd', 12, 2);
				$table->double('estoque', 12, 2)->nullable();
				$table->string('foto')->nullable();
				$table->string('prioridade', 10);
				$table->date('data_compra')->nullable();
				$table->date('data_devolucao')->nullable();
				$table->date('data_recebimento')->nullable();
				$table->date('data_reprovacao')->nullable();
				$table->string('motivo_reprovacao')->nullable();

				$table->string('user_created', 20);
				$table->string('user_devolucao', 20)->nullable();
				$table->string('user_compra', 20)->nullable();
				$table->string('user_recebimento', 20)->nullable();
				$table->string('user_reprovacao', 20)->nullable();
				$table->string('user_updated', 20);

				$table->string('situacao');
				$table->timestamps();
			});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('compras.pedido_produtos');
	}

}
