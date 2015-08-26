<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class DeleteInvestigacaoCampos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('sesmt.investigacaos', function (Blueprint $table) {
				$table->dropColumn(['usava_epi', 'motivo_epi', 'responsavel_imediato',
						'supervisor_presente', 'motivo_ausencia_supervisor', 'servico_supervisionado',
						'servico_treinamento_prevencionista', 'servico_instrucoes_especificas',
						'servico_trabalho_sozinho', 'servico_reincidente', 'servico_ferias',
						'servico_hora_extra', 'ocorrencia_tipo', 'ocorrencia_classificacao',
						'ocorrencia_incapacidade', 'ocorrencia_apos_horas', 'ocorrencia_local',
						'ocorrencia_agente_causador', 'ocorrencia_remocao', 'ocorrencia_remocao_descricao',
						'ocorrencia_data_hora_remocao', 'ocorrencia_local_assistencia', 'ocorrencia_atestado_id',
						'situacao']);
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
