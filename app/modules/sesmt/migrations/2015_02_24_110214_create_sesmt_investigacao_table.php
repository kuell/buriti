<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSesmtInvestigacaoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sesmt_investigacaos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('ocorrencia_id')->unsigned();
			$table->foreign('ocorrencia_id')->references('id')->on('farmacia_ocorrencias');
			$table->string('funcao_colaborador');
			$table->date('data_admissao');
			$table->boolean('usava_epi');
			$table->string('motivo_epi');
			$table->string('responsavel_imediato');
			$table->boolean('supervisor_presente');
			$table->string('motivo_ausencia_supervisor');
			$table->boolean('servico_supervisionado');
			$table->boolean('servico_treinamento_prevencionista');
			$table->boolean('servico_instrucoes_especificas');
			$table->string('reincidencia');


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
		Schema::drop('sesmt_investigacaos');
	}

}
