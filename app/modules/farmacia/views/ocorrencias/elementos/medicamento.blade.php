@extends('layouts.frame')

@section('frame')
{{ Form::open(['route'=>['farmacia.ocorrencias.medicamentos', $ocorrencia->id], 'class'=>'form form-inline'])}}
	<div class="form-group">
		<div class="col-sm-6">
			{{ Form::label('Medicação: ', null, ['class'=>'form-label'])}}
			{{ Form::select('medicacao_id', [''=>'Selecione ...']+Medicamento::all()->lists('descricao', 'id'), null, ['class'=>'col-sm-12', 'required']) }}
		</div>

		<div class="col-sm-2">
			{{Form::label('Qtde: ') }}
			{{ Form::text('qtd',  null, ['class'=>'form-control', 'size'=>3, 'placeholder'=>'Qtde.', 'required']) }}
		</div>

		<div class="col-sm-2 col-xs-2 col-md-2">
			{{ Form::label('Medida: ') }}
			{{ Form::select('medida',  [''=>'Selecione ...', 'gota'=>'Gota', 'comprimido'=>'Comprimido','sache'=>'Sachê', 'aplicacao'=>'Aplicação'], ['class'=>'form-control', 'size'=>3, 'required']) }}
		</div>

		<div class="col-sm-1">
			{{ Form::submit('Incluir', ['class'=>'btn btn-sm btn-primary'])}}
		</div>
	</div>
{{ Form::close() }}


	<table class="table">
		<thead>
			<tr>
				<th>Descrição</th>
				<th>Qtde</th>
				<th>Medida</th>
			</tr>
		</thead>
		<tbody>
			@foreach($ocorrencia->medicamentos as $medicamento)
			<tr>
				<td>{{ $medicamento->medicacao->descricao }}</td>
				<td>{{ $medicamento->qtd }}</td>
				<td>{{ $medicamento->medida }}</td>
				<td>{{ link_to_route('farmacia.ocorrencias.medicamentos.delete', '', $medicamento->id, ['class'=>'glyphicon glyphicon-trash']) }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>

@stop

@section('scripts')

	<script type="text/javascript">
		$(function(){
			$('select[name=medicacao_id]').chosen();
			$('select[name=medida]').chosen();
		})

	</script>
@stop