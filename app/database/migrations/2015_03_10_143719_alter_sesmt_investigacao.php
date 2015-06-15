<?php

use Illuminate\Database\Migrations\Migration;

class AlterSesmtInvestigacao extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('sesmt_investigacao_epis', function ($table) {
				$table->dropForeign('sesmt_investigacao_epis_investigacao_id_foreign');
			});

		Schema::dropIfExists('sesmt_investigacaos');
		Schema::dropIfExists('sesmt_investigacao_epis');

		Schema::create('sesmt_investigacaos', function ($table) {
				$table->increments('id');
				$table->integer('ocorrencia_id')->unsigned();
				$table->foreign('ocorrencia_id')->references('id')->on('farmacia_ocorrencias')->onDelete('cascade');

				$table->boolean('usava_epi')->nullable();
				$table->string('motivo_epi')->nullable();
				$table->string('responsavel_imediato')->nullable();
				$table->boolean('supervisor_presente')->nullable();
				$table->string('motivo_ausencia_supervisor')->nullable();
				$table->boolean('servico_supervisionado')->nullable();
				$table->boolean('servico_treinamento_prevencionista')->nullable();
				$table->boolean('servico_instrucoes_especificas')->nullable();
				$table->boolean('servico_trabalho_sozinho')->nullable();
				$table->boolean('servico_reincidente')->nullable();
				$table->boolean('servico_ferias')->nullable();
				$table->boolean('servico_hora_extra')->nullable();
				$table->integer('ocorrencia_tipo')->nullable();
				$table->integer('ocorrencia_classificacao')->nullable();
				$table->integer('ocorrencia_incapacidade')->nullable();
				$table->string('ocorrencia_apos_horas')->nullable();
				$table->string('ocorrencia_local')->nullable();
				$table->string('ocorrencia_agente_causador')->nullable();
				$table->boolean('ocorrencia_remocao')->nullable();
				$table->string('ocorrencia_remocao_descricao')->nullable();
				$table->time('ocorrencia_data_hora_remocao')->nullable();
				$table->string('ocorrencia_local_assistencia')->nullable();
				$table->integer('ocorrencia_atestado_id')->nullable();

				$table->string('situacao')->default('Em investigacao');

				$table->timestamps();
			});
		Schema::create('sesmt_investigacao_epis', function ($table) {
				$table->increments('id');
				$table->integer('investigacao_id');
				$table->string('descricao');
				$table->string('ca');
				$table->date('validade');
				$table->timestamps();
			});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIFexists('sesmt_investigacaos');
	}

}
