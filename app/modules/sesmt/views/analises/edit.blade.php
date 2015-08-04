@extends('farmacia::ocorrencias.show')

@section('analise')
{{ Form::model($ocorrencia, ['route'=>['sesmt.analise.update', $ocorrencia->id], 'method'=>'PATCH', 'class'=>'form']) }}

<div class="panel panel-info">
	<div class="panel-heading">
		<h4 class="panel-title">Analisar ocorrencia {{ $ocorrencia->id }}</h4>
	</div>
	<div class="panel-body">

		<div class="form-group">
			<div class="col-sm-3">
				{{ Form::label('Monitoramento: ') }}
				{{ Form::select('monitoramento', [''=>'','1'=>'Sim','0'=>'Não'], null, ['class'=>'form-control']) }}
			</div>
			<div class="col-sm-3">
				{{ Form::label('Tipo de Ocorrencia: ') }}
				{{ Form::select('tipo', [''=>'Selecione ...']+AnaliseOcorrencia::tiposOcorrencia(), null, ['class'=>'form-control']) }}
			</div>
			<div class="col-sm-6">
				{{ Form::label('Causa ou Queixa: ') }}
				{{ Form::select('queixa_id', ['0'=>'Selecione ...']+Queixa::all()->lists('descricao', 'id'), null, ['class'=>'form-control']) }}
			</div>
		</div>


		<div class="form-group">
			<div class="col-sm-4">
				{{ Form::label('Finalizar Ocorrencia? ') }}
				{{ Form::select('situacao', ['aberto'=>'Não', 'baixado'=>'Sim'], null, ['class'=>'form-control']) }}
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-12">
				{{ Form::label('Observações: ') }}
				{{ Form::textarea('obs', null, ['class'=>'form-control', 'rows'=>3]) }}
			</div>
		</div>
		</div>
		<div class="panel-footer">
			<div class='form-group'>
				{{ Form::submit('Avaliar', ['class'=>'btn btn-primary']) }}
			</div>
		</div>

	</div>
</div>

{{ Form::close() }}

<script type="text/javascript">
	$(function(){
		$('select[name=tipo], select[name=queixa_id]').chosen({width: "100%"})
	})
</script>

@stop