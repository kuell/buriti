<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePostoTrabalhoPostoAtividadesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('posto_trabalhos', function (Blueprint $table) {
				$table->increments('id');
				$table->integer('setor_id');
				$table->string('descricao');
				$table->timestamps();
			});
		Schema::create('posto_atividades', function (Blueprint $table) {
				$table->increments('id');
				$table->integer('posto_id');
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
		Schema::dropIfExists('posto_trabalhos');
		Schema::dropIfExists('posto_atividades');
	}

}
