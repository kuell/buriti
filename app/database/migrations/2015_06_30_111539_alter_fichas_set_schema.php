<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterFichasSetSchema extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::statement('create schema cadastros');
		DB::statement('alter table fichas set schema cadastros');
		DB::statement('alter table ficha_setors set schema cadastros');
		DB::statement('alter table ficha_parentes set schema cadastros');
		DB::statement('alter table ficha_instrucaos set schema cadastros');
		DB::statement('alter table ficha_cursos set schema cadastros');
		DB::statement('alter table ficha_empregos set schema cadastros');


	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
