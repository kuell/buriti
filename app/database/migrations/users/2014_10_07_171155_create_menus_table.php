<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMenusTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('menus', function (Blueprint $table) {
				$table->increments('id');
				$table->string('descricao');
				$table->string('url')->nullable();
                $table->string('icone')->nullable();
                $table->string('indice')->nullable();
				$table->integer('menu_pai')->nullable();
				$table->timestamps();
			});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('menus');
	}

}
