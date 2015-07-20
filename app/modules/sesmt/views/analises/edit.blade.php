@extends('farmacia::ocorrencias.show')

@section('analise')
<div class="panel panel-info">
	<div class="panel-heading">
		<h4 class="panel-title">Analisar ocorrencia {{ $ocorrencia->id }}</h4>
	</div>
	<div class="panel-body">
		{{ Form::model($ocorrencia, ['route'=>['sesmt.analise.update', $ocorrencia->id], 'method'=>'PATCH', 'class'=>'form']) }}
		<div class="form-group">
			{{ Form::label('Tipo de Ocorrencia: ') }}
			{{ Form::select('tipo', AnaliseOcorrencia::tiposOcorrencia(), null, ['class'=>'form-control']) }}
		</div>

		<div class="form-group">
			{{ Form::label('Causa ou Queixa: ') }}
			{{ Form::select('queixa_id', Queixa::all()->lists('descricao', 'id'), null, ['class'=>'form-control']) }}
		</div>

		<div class="form-group">
			{{ Form::label('Observações: ') }}

				{{ Form::textarea('obs', null, ['class'=>'form-control']) }}

		</div>
		<div class="panel-footer">
			<div class='form-group'>
				{{ Form::submit('Avaliar', ['class'=>'btn btn-primary']) }}
			</div>
		</div>

		{{ Form::close() }}
	</div>
</div>

@stop