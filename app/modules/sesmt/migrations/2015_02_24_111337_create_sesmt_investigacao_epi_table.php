<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSesmtInvestigacaoEpiTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sesmt_investigacao_epis', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('investigacao_id')->unsigned();
			$table->foreign('investigacao_id')->references('id')->on('sesmt_investigacaos');
			$table->string('descricao');
			$table->string('ca');
			$table->date('validate');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sesmt_investigacao_epis');
	}

}
