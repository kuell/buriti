<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('usuarios', function (Blueprint $table) {
				$table->increments('id');
				$table->string('nome', 60);
				$table->integer('ramal')->nullable();
				$table->string('cel')->nullable();
				$table->string('email')->nullable();
				$table->string('user', 20);
				$table->string('password', 60);
				$table->string('remember_token')->nullable();
				$table->integer('ativo')->default(true);
				$table->string('avatar')->default('no_image.jpg');
				$table->timestamps();
			});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('usuarios');
	}

}
