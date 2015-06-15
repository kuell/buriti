<div class="row">

    <div class="panel panel-primary">
        <div class="panel-heading clearfix">
            <h4 class="panel-title pull-left">Dados da Ocorrencia</h4>
            <div class="btn-group pull-right">

            </div>
        </div>
	    <div class="panel-body">
	    	<div class="form-horizontal">
	  			<div class="form-group">
	  				<div class="col-sm-3">
	  					Data da Ocorrencia:
	  				</div>
	  				<div class="col-sm-3">
	  					{{ $investigacao->ocorrencia->data_hora }}
	  				</div>
	  			</div>
	    		<div class="form-group">
	    			<div class="col-sm-3">
	    				Tipo de Ocorrencia:
	    			</div>
	    			<div class="col-sm-3">
	    				{{ Form::select('ocorrencia_tipo', ['Acidente', 'Trajeto', 'Tipico', 'Atipico', 'Doença Ocupacional / do Trabalho', 'Incidente'], null, ['class'=>'form-control']) }}
	    			</div>
	    			<div class="col-sm-3">
	    				Classificação da Ocorrencia:
	    			</div>
	    			<div class="col-sm-3">
	    				{{ Form::select('ocorrencia_classificacao', ['Com afastamento', 'Sem afastamento', 'Risco de Indfecção'], null, ['class'=>'form-control']) }}
	    			</div>
	    		</div>
	    		<div class="form-group">
	    			<div class="col-sm-3">
	    				Incapacidade:
	    			</div>
	    			<div class="col-sm-3">
	    				{{ Form::select('ocorrencia_incapacidade', ['Temporario', 'Permanente', 'Parcial', 'Total', 'Morte'], null, ['class'=>'form-control'])}}
	    			</div>
	    			<div class="col-sm-3">
	    				Após quantas horas de trabalho?
	    			</div>
	    			<div class="col-sm-3">
	    				{{ Form::text('ocorrencia_apos_horas', null, ['class'=>'form-control'])}}
	    			</div>
	    		</div>
	    		<div class="form-group">
	    			<div class="col-sm-2">
	    				Local da ocorrencia:
	    			</div>
	    			<div class="col-sm-6">
	    				{{ Form::text('ocorrencia_local', null, ['class'=>'form-control'])}}
	    			</div>
	    			<div class="col-sm-2">
	    				Agente causador:
	    			</div>
	    			<div class="col-sm-2">
	    				{{ Form::text('ocorrencia_agente_causador', null, ['class'=>'form-control'])}}
	    			</div>
	    		</div>
	    		<div class="form-group">
	    			<div class="col-sm-3">
	    				Houve remoção de serviço especializado com urgẽncia(SAMU/Bombeiros/Outros)?
	    			</div>
	    			<div class="col-sm-3">
	    				{{ Form::select('ocorrencia_remocao', ['sim', 'nao'], null, ['class'=>'form-control'])}}
	    			</div>
	    			<div class="col-sm-2">
	    				Qual?
	    			</div>
	    			<div class="col-sm-4">
	    				{{ Form::text('ocorrencia_remocao_descricao', null, ['class'=>'form-control']) }}
	    			</div>
	    		</div>
	    		<div class="form-group">
	    			<div class="col-sm-3">
	    				Data e Hora da Remoção:
	    			</div>
	    			<div class="col-sm-3">
	    				{{ Form::text('ocorrencia_data_hora_remocao', null, ['class'=>'form-control hora']) }}
	    			</div>
	    			<div class="col-sm-3">
	    				Local da Assistencia Médica:
	    			</div>
	    			<div class="col-sm-3">
	    				{{ Form::text('ocorrencia_local_assistencia', null, ['class'=>'form-control'])}}
	    			</div>
	    		</div>
	    		<div class="form-group">
	    			<div class="col-sm-3">
	    				Identificação do Atestado(codigo de identificação):
	    			</div>
	    			<div class="col-sm-6">
	    				{{ Form::text('ocorrencia_atestado_id', null, ['class'=>'form-control']) }}
	    			</div>
	    		</div>

	    	</div>
	    </div>
	    <div class="panel-footer">
	    	{{ Form::submit('Proximo >>', ['class'=>'btn btn-success btn-sm']) }}
	    </div>
	</div>
</div>