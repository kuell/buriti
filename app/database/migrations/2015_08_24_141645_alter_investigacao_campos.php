<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AlterInvestigacaoCampos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {

		Schema::rename('farmacia_natureza_lesao', 'natureza_lesao');
		Schema::rename('farmacia_parte_corpo', 'parte_corpo');

		DB::statement('alter table natureza_lesao set schema farmacia');
		DB::statement('alter table parte_corpo set schema farmacia');

		Schema::table('sesmt.investigacaos', function (Blueprint $table) {
				$table->string('tipo_ocorrencia')->nullable();
				$table->string('classificacao')->nullable();
				$table->string('potencial_risco')->nullable();
				$table->string('probabilidade')->nullable();
				$table->date('data_acidente')->nullable();
				$table->time('horas_trabalhadas')->nullable();
				$table->string('local_acidente')->nullable();
				$table->string('tipo_lesao')->nullable();
				$table->boolean('houve_afastamento')->nullable();
				$table->integer('dias_afastamento')->nullable();
				$table->boolean('houve_instrucao_tarefa')->nullable();
				$table->boolean('ferramenta_boa_condicao')->nullable();
				$table->boolean('colaborador_reincidente')->nullable();
				$table->boolean('fez_treinamento_prevencionista')->nullable();
				$table->boolean('colaborador_usava_epi')->nullable();
				$table->boolean('colaborador_possui_ferias')->nullable();
				$table->boolean('fez_hora_extra')->nullable();
				$table->boolean('outros_colaboradores_tarefa')->nullable();
				$table->boolean('houve_instrucao_prevencionista')->nullable();
				$table->integer('natureza_lesao_id')->nullable();
				$table->boolean('parte_corpo_id')->nullable();
				$table->string('fator_potencial')->nullable();
				$table->string('rota_acidente')->nullable();
				$table->text('descricao_acidente')->nullable();
				$table->boolean('testemunhas')->nullable();
				$table->boolean('houve_remocao_especializada')->nullable();
				$table->string('local_assistencia_medica')->nullable();
				$table->time('horario_atendimento')->nullable();
				$table->string('cid')->nullable();
				$table->boolean('devera_afastar')->nullable();
				$table->boolean('qtde_dias')->nullable();

			});

		Schema::create('sesmt.investigacao_acoes', function (Blueprint $table) {
				$table->increments('id');
				$table->integer('investigacao_id');
				$table->text('acao');
				$table->string('quem');
				$table->date('quando');
				$table->string('status');
			});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('sesmt.investigacaos', function (Blueprint $table) {
				//
			});
	}

}
