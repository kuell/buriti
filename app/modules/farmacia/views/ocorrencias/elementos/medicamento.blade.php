@extends('layouts.frame')

@section('frame')

{{ Form::open(['route'=>['farmacia.ocorrencias.medicamentos', $ocorrencia->id],'class'=>'navbar-form navbar-left col-md-12'])}}
	<div class="form-group">
		{{ Form::label('Medicação: ', null, ['class'=>'nav-brand'])}}
		{{ Form::select('medicacao_id', [''=>'Selecione ...']+Medicamento::all()->lists('descricao', 'id'), null, ['class'=>'form-control']) }}
	</div>
	<div class="form-group">
		{{ Form::text('qtd',  null, ['class'=>'form-control', 'size'=>3, 'placeholder'=>'Qtde.']) }}
	</div>
	<div class="form-group">
		{{ Form::select('medida',  [''=>'Selecione ...', 'gota'=>'Gota', 'gotas'=>'Comprimido',], ['class'=>'form-control', 'size'=>3, 'placeholder'=>'Qtde.']) }}
	</div>
		{{ Form::submit('Incluir', ['class'=>'btn btn-primary'])}}
{{ Form::close() }}

		<div>
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

		</div>


@stop

@section('scripts')
	<script type="text/javascript">
		$(function(){
			$('select[name=medicacao_id]').chosen();
			$('select[name=medida]').chosen();
		})

	</script>
@stop