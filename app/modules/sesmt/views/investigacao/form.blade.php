<div class="form-group">
    <div class="col-md-3">
        {{ Form::label('tipo_ocorrencia', 'Tipo de Acidente: ', ['class'=>'form-label']) }}
        {{ Form::select('tipo_ocorrencia', [''=>'Selecione ...']+TipoOcorrencia::tipoAcidente()->lists('descricao', 'id'), null, ['class'=>'form-control']) }}
    </div>
    <div class="col-md-3">
        {{ Form::label('classificacao', 'Classificacao: ', ['form-label']) }}
        {{ Form::select('classificacao', [''=>'Selecione ...', 'ASA', 'ACA', 'RI'], null, ['class'=>'form-control']) }}
    </div>
    <div class="col-md-3">
        {{ Form::label('potencial_risco', 'Potencial de Risco: ', ['form-label']) }}
        {{ Form::select('potencial_risco', [''=>'Selecione ...', 'BAIXA', 'MEDIA', 'ALTA', 'GRAVE'], null, ['class'=>'form-control']) }}
    </div>
    <div class="col-md-3">
        {{ Form::label('probabilidade', 'Probabilidade: ', ['form-label']) }}
        {{ Form::select('probabilidade', [''=>'Selecione ...', 'FREQUENTA', 'OCASIONAL', 'RARA'], null, ['class'=>'form-control']) }}
    </div>
</div>

<div class="form-group">
    <div class="col-md-3">
        {{ Form::label('data_acidente', 'Data do Acidente: ', ['class'=>'form-label']) }}
        {{ Form::text('data_acidente', null, ['class'=>'form-control data']) }}
    </div>
    <div class="col-md-3">
        {{ Form::label('horas_trabalhadas', 'Horas Trabalhadas: ', ['class'=>'form-label']) }}
        {{ Form::text('horas_trabalhadas', null, ['class'=>'form-control hora']) }}
    </div>
    <div class="col-md-6">
        {{ Form::label('local_acidente', 'Local do Acidente: ', ['class'=>'form-label']) }}
        {{ Form::text('local_acidente', null, ['class'=>'form-control']) }}
    </div>
</div>

<div class="form-group">
    <div class="col-md-3">
        {{ Form::label('tipo_lesao', 'Tipo de Lesão: ', ['class'=>'form-label']) }}
        {{ Form::select('tipo_lesao', [''=>'Selecione ...', 'LESÃO MEDIATA TARDIAL', 'LESÃO IMEDIATA'], null, ['class'=>'form-control']) }}
    </div>
    <div class="col-md-3">
        {{ Form::label('houve_afastamento', 'Houve Afastamento? ', ['class'=>'form-label']) }}
        {{ Form::select('houve_afastamento', ['NÃO','SIM'], null, ['class'=>'form-control']) }}
    </div>
    <div class="col-md-6">
        {{ Form::label('dias_afastamento', 'Dias Afastamento: ', ['class'=>'form-label']) }}
        {{ Form::text('dias_afastamento', null, ['class'=>'form-control numero']) }}
    </div>
</div>

<div class="form-group">
    <div class="col-md-6">
        {{ Form::label('houve_instrucao_tarefa', 'Houve instruções especificas para a tarefa? ', ['class'=>'form-label']) }}
        {{ Form::select('houve_instrucao_tarefa', ['NÃO','SIM'], null, ['class'=>'form-control']) }}
    </div>
    <div class="col-md-6">
        {{ Form::label('colaborador_usava_epi', 'O colaborador usava E.P.I? ', ['class'=>'form-label']) }}
        {{ Form::select('houve_instrucao_tarefa', ['NÃO','SIM'], null, ['class'=>'form-control']) }}
    </div>
</div>

<div class="form-group">
    <div class="col-md-6">
        {{ Form::label('ferramenta_boa_condicao', 'As ferramentas estavam em boas condições? ', ['class'=>'form-label']) }}
        {{ Form::select('ferramenta_boa_condicao', ['NÃO','SIM'], null, ['class'=>'form-control']) }}
    </div>
    <div class="col-md-6">
        {{ Form::label('colaborador_possui_ferias', 'O colaborador pussui ferias vencidas? ', ['class'=>'form-label']) }}
        {{ Form::select('colaborador_possui_ferias', ['NÃO','SIM'], null, ['class'=>'form-control']) }}
    </div>
</div>

<div class="form-group">
    <div class="col-md-6">
        {{ Form::label('colaborador_reincidente', 'O colaborador é reincidente? (RI, ASA, ACA)', ['class'=>'form-label']) }}
        {{ Form::select('colaborador_reincidente', ['NÃO','SIM'], null, ['class'=>'form-control']) }}
    </div>
    <div class="col-md-6">
        {{ Form::label('fez_hora_extra', 'Fez hora extra? ', ['class'=>'form-label']) }}
        {{ Form::select('fez_hora_extra', ['NÃO','SIM'], null, ['class'=>'form-control']) }}
    </div>
</div>

<div class="form-group">
    <div class="col-md-6">
        {{ Form::label('fez_treinamento_prevencionista', 'Fez treinamento prevencionista?', ['class'=>'form-label']) }}
        {{ Form::select('fez_treinamento_prevencionista', ['NÃO','SIM'], null, ['class'=>'form-control']) }}
    </div>
    <div class="col-md-6">
        {{ Form::label('outros_colaboradores_tarefa', 'Outras pessoas trabalhavam na mesma função? ', ['class'=>'form-label']) }}
        {{ Form::select('outros_colaboradores_tarefa', ['NÃO','SIM'], null, ['class'=>'form-control']) }}
    </div>
</div>

<div class="form-group">
    <div class="col-md-12">
        {{ Form::label('fator_potencial', 'Fator Potencial de Acidentes: ', ['class'=>'form-label']) }}
        {{ Form::select('fator_potencial', [''=>'Selecione ...',
                'PRATICAS ABAIXO DO PADRÃO: OPERAR EQUIPAMENTOS SEM AUTORIZAÇÃO NÃO SINALIZAR, FALHA DE BLOQUEIO, TORNAR DISPOSITIVOS DE SEGURANÇA INOPERANTES, USO DE IMPROPRIO DE EQUIPAMENTOS, USO DE ALCOOL E DROGAS, ENTRE OUTROS.',
                'CONDIÇÕES ABAIXO DO PADRÃO, (CONDIÇÃO INSEGURA );
 PROTEÇÃO AUSENTE  OU INADEQUADA , PERIGO DE EXPLOSÃO OU INCENDIO , AUSENCIA  DE ORDEM E LIMPEZA , EXPOSIÇÃO AOS AGENTES AMBIENTAIS NOCIVOS .'
        ], null, ['class'=>'form-control']) }}
    </div>
</div>

<div class="form-group">
    <div class="col-md-12">
        {{ Form::label('rota_acidente', 'Preencher em caso de Acidente de Trajeto: ', ['class'=>'form-label']) }}
        {{ Form::select('rota_acidente', [''=>'Selecione ...', ' DA  RESIDENCIA PARA O TRABALHO', 'DO TRABALHO PARA SUA RESIDENCIA', 'DE IDA E PARA LOCAL DA REFEIÇÃO EM INTERVALO DE TRABALHO', 'DE VOLTA DO LOCAL DE REFEIÇÃO EM INTERVALO DE TRABALHO'], null, ['class'=>'form-control']) }}
    </div>
</div>

<div class="form-group">
    <div class="col-md-12">
        {{ Form::label('descricao', 'Descrição do Acidente: ', ['class'=>'form-label']) }}
        {{ Form::textarea('descricao_acidente', null, ['class'=>'form-control']) }}
    </div>
</div>

<div class="form-group">
    <div class="col-md-6">
        {{ Form::label('testemunhas', 'Testemunhas: ', ['class'=>'form-label']) }}
        {{ Form::text('testemunhas', null, ['class'=>'form-control']) }}
    </div>
    <div class="col-md-6">
        {{ Form::label('houve_remocao_especializada', 'Houve remoção por serviços especializados de urgência?(SAMU, Bombeiros, Outros) ', ['class'=>'form-label']) }}
        {{ Form::select('houve_remocao_especializada', ['NÃO', 'SIM'], null, ['class'=>'form-control']) }}
    </div>
</div>

<div class="form-group">
    <div class="col-md-6">
        {{ Form::label('local_assistencia_medica', 'Local de assistencia Médica: ', ['class'=>'form-label']) }}
        {{ Form::text('local_assistencia_medica', null, ['class'=>'form-control']) }}
    </div>
    <div class="col-md-3">
        {{ Form::label('horario_atendimento', 'Horario de Atendimento: ', ['class'=>'form-label']) }}
        {{ Form::text('horario_atendimento', null, ['class'=>'form-control hora']) }}
    </div>
    <div class="col-md-3">
        {{ Form::label('cid', 'C.I.D.: ', ['class'=>'form-label']) }}
        {{ Form::text('cid', null, ['class'=>'form-control']) }}
    </div>
</div>

<div class="form-group">
    <div class="col-md-6">
        {{ Form::label('devera_afastar', 'Deverá o colaborador se afastar - Se durante o tratamento? ', ['class'=>'form-label']) }}
        {{ Form::select('devera_afastar', ['NÃO', 'SIM'], null, ['class'=>'form-control']) }}
    </div>
    <div class="col-md-6">
        {{ Form::label('qtde_dias', 'Quantos dias? ', ['class'=>'form-label']) }}
        {{ Form::text('qtde_dias', null, ['class'=>'form-control']) }}
    </div>
</div>