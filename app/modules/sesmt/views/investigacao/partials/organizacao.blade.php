<div class="row">

    <div class="panel panel-primary">
        <div class="panel-heading clearfix">
            <h4 class="panel-title pull-left">Organização do Trabalho</h4>
            <div class="btn-group pull-right">
                {{-- Form::submit('Proximo >>', ['class'=>'btn btn-success btn-sm']) --}}
            </div>
        </div>
	    <div class="panel-body">
            <div class="form-horizontal">
                <div class="form-group">
                    <div class="col-sm-3">
                        {{ Form::label('Responsavel pelo setor: ')}}
                    </div>
                    <div class="col-sm-9">
                        {{ Form::text('responsavel_imediato', null, ['class'=>' form-control','placeholder'=>'Responsavel pelo setor'])}}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4">
                        {{ Form::label('Houve Supervisão do serviço? ')}}
                    </div>
                    <div class="col-sm-2">
                        {{ Form::select('servico_supervisionado', ['sim','nao'], null, ['class'=>' form-control'])}}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4">
                        {{ Form::label('Recebeu treinamento prevencionista? ')}}
                    </div>
                    <div class="col-sm-2">
                        {{ Form::select('servico_treinamento_prevencionista', ['sim','nao'], null, ['class'=>' form-control'])}}
                    </div>
                    <div class="col-sm-4">
                        {{ Form::label('O colaborador trabalhava sozinho?')}}
                    </div>
                    <div class="col-sm-2">
                        {{ Form::select('servico_trabalho_sozinho', ['sim','nao'], null, ['class'=>' form-control'])}}
                    </div>

                </div>

                <div class="form-group">
                    <div class="col-sm-4">
                        {{ Form::label('Houve instrução especifica para a tarefa? ')}}
                    </div>
                    <div class="col-sm-2">
                        {{ Form::select('servico_instrucoes_especificas', ['sim','nao'], null, ['class'=>' form-control'])}}
                    </div>
                    <div class="col-sm-4">
                        {{ Form::label('O responsavel pelo setor estava presente?')}}
                    </div>
                    <div class="col-sm-2">
                        {{ Form::select('supervisor_presente', ['sim','nao'], $investigacao->supervisor_presente, ['class'=>'form-control'])}}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4">
                        {{ Form::label('O colaborador é reincidente?')}}
                    </div>
                    <div class="col-sm-2">
                        {{ Form::select('servico_reincidente', ['sim','nao'], null, ['class'=>' form-control'])}}
                    </div>
                    <div class="col-sm-4">
                        {{ Form::label('Faltou equipamento de proteção E.P.I. E.P.C.?')}}
                    </div>
                    <div class="col-sm-2">
                        {{ Form::select('servico_trabalho_sozinho', ['sim','nao'], null, ['class'=>' form-control'])}}
                    </div>

                </div>
                <div class="form-group">
                    <div class="col-sm-4">
                        {{ Form::label('As ferramentas estavam em boas condições?')}}
                    </div>
                    <div class="col-sm-2">
                        {{ Form::select('servico_trabalho_sozinho', ['sim','nao'], null, ['class'=>' form-control'])}}
                    </div>
                    <div class="col-sm-4">
                        {{ Form::label('O colaborador possui férias vencidas?')}}
                    </div>
                    <div class="col-sm-2">
                        {{ Form::select('servico_ferias', ['sim','nao'], null, ['class'=>' form-control'])}}
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-4">
                        {{ Form::label('O colaborador estava fazendo hora extra?')}}
                    </div>
                    <div class="col-sm-2">
                        {{ Form::select('servico_hora_extra', ['sim','nao'], null, ['class'=>' form-control'])}}
                    </div>

                </div>
            </div>
	    </div>
	    <div class="panel-footer">
	    	{{ Form::submit('Proximo >>', ['class'=>'btn btn-success btn-sm'])}}
	    </div>
    </div>
</div>