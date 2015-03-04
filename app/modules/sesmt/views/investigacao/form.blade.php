<div>
    <h3>
        Dados do Acidentado
    </h3>
    <div class="col-md-12">
        <div class="col-md-9">
            Nome: {{ $ocorrencia->colaborador->nome }}
        </div>
        <div class="col-md-3">
            Matricula: {{ $ocorrencia->colaborador->codigo_interno }}
        </div>
        <div class="col-md-3">
            Data Nascimento: {{ $ocorrencia->colaborador->data_nascimento }}
        </div>
        <div class="col-md-3">
            Sexo: {{ $ocorrencia->colaborador->sexoDescricao }}
        </div>
        <div class="col-md-12">
            Endereço: {{ $ocorrencia->colaborador->endereco }}
        </div>
        Setor: {{ $ocorrencia->colaborador->setor->descricao or null }} <br />
        Funcao: {{ Form::text('funcao', null) }} <br />
        Data Admissão: {{ Form::text('data_admissao', null) }} <br />
    </div>
</div>
<div>
    <h3>Uso de Proteção Individual</h3>
    Uso de epi: {{ Form::select('epi', ['sim', 'nao']) }} -> Descrição se não: {{ Form::text('descricao_epi', null) }}<br />
    Se sim, Quais: {{ Form::button('Epi Utilizados') }}<br />
    <table class="table">
        <tr>
            <th>Descrição</th>
            <th>C.A.</th>
            <th>Validade</th>
        </tr>
    </table><br />
</div>
<div>
    <h3>Organização do Trabalho</h3>
    Encarregado do Setor: {{ $ocorrencia->colaborador->setor->encarregado or null}} <br />
    Houve Supervisão do serviço? {{ Form::select('hove_supervisao', ['sim','nao']) }} <br />
    Recebeu treinamento prevencionista? {{ Form::select('treinamento_prevencionista', ['sim','nao']) }} <br />
    Houve instruções especificas para a tarefa?  {{ Form::select('instrucao_para_tarefa', ['sim','nao']) }} <br />
    Reincidencia: {{ Form::text('reincidente', null) }} <br />
    Estava fazendo hora extra?  {{ Form::select('hora_extra', ['sim','nao']) }} <br />
    Colaborador trabalhava sozinho?  {{ Form::select('trabalhava_sozinho', ['sim','nao']) }} - Quantidade de colaboradores na tarefa: {{ Form::text('qtd_pessoas', null) }} <br /><br />
</div>
<div>
    <h3>Dados da Ocorrencia</h3>
    {{--
        Se TIPO = Incidente							-> Classificação = Sem Afastamento
        Se TIPO = Acidente 							-> Classificação = Sem ou Com Afastamento
        Se Tipo = Doenca Ocupacional / do Trabalho 	-> Classificação = Sem ou Com Afastamento + Risco de Infecção
        Se TIPO = Queixas  							-> Classificação = Sem ou Com Afastamento
        Se TIPO = acidente com afastamento -> Incapacidade habilita se não desabilitado
    --}}

    {{-- Somente Doenças Ocupacionais tem 'risco de Infecção' --}}
    Tipo de ocorrencia: {{ Form::select('tipo_ocorrencia', ['Acidente', 'Incidente', 'Doença Ocupacional / do Trabalho', 'Queixas']) }} - se Acidente {{ Form::select('acidente_tipo', ['trajeto', 'tipico', 'atipico']) }} <br />
    Classificação da Ocorrencia: {{ Form::select('classificacao_ocorrencia', ['Sem Afastamento', 'Com Afastamento', 'Risco de Infecção']) }}<br />
    Incapacidade: {{ Form::select('incapacidade', ['temporario', 'permanente', 'parcial', 'total', 'morte']) }} <br />
    Gravidade da Ocorrencia: {{ Form::select('gravidade', ['grave', 'alta', 'media', 'baixo']) }} <br />
    Após quantas horas de trabalho?  {{ Form::text('horas_trabalho', null) }} <br />
    Local da Ocorrencia: {{ Form::text('local_ocorrencia', null) }} <br />
    Agente causador: {{ Form::text('agente_causador', null) }} <br />
    Houve remoção de serviço especializado com urgẽncia(SAMU/Bombeiros/Outros)? {{ Form::select('remocao_urgencia', ['sim','nao']) }} - Se SIM, Qual?{{ Form::text('veiculo_remocao', null) }}<br />
    Data e Hora da Remoção: {{ Form::text('data_hora_remocao', null) }} <br />
    Local da Assistencia Médica: {{ Form::text('data_hora_remocao', null) }} <br />
    Identificação do Atestado(codigo de identificação): {{ Form::text('atestado_id', null) }} <br />
</div>
<div>
    <h3>Relato / Medidas Preventivas e Conclusivas da Ocorrencia</h3>
    Relato: {{ Form::textarea('relato_ocorrencia', null) }} - {{ Form::file('relato_foto') }}<br />
    Medidas Corretivas: {{ Form::textarea('corretiva_ocorrencia', null) }} - {{ Form::file('corretiva_foto') }} <br />
    Medidas Preventivas: {{ Form::textarea('preventiva_ocorrencia', null) }} - {{ Form::file('preventiva_foto') }}<br />
    Conclusão / Parecer Tecnico: {{ Form::textarea('conclusao_ocorrencia', null) }} - {{ Form::file('conclusao_foto') }} <br />

</div>
<div>

</div>
