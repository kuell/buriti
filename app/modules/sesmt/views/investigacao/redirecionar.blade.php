@extends('farmacia::ocorrencias.show')

@section('analise')
{{ Form::open(['route'=>['sesmt.investigacao.redirecionar', $ocorrencia->id]]) }}

<div class="panel panel-info">
	<div class="panel-heading">
		<h4 class="panel-title">Redirecionar</h4>
	</div>
	<div class="panel-body">
		<div class="form-group">
			<div class="col-sm-12">
				{{ Form::label('Tipo de Ocorrencia: ') }}
				{{ Form::select('tipo_id', [''=>'Selecione ...']+AnaliseOcorrencia::tiposOcorrencia(['ACIDENTE']), null, ['class'=>'form-control']) }}
			</div>
		</div>
	</div>
	<div class="panel-footer">
		{{ Form::submit('Redireciona >>', ['class'=>'btn btn-primary']) }}
	</div>

</div>
{{ Form::close() }}

@stop