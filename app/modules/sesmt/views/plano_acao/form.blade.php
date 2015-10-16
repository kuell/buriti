
@extends('layouts.frame')


@section('frame')

	@if(!$ocorrencia->planoAcaos()->where('situacao', '<>', 'Finalizado')->count())

	<div class="well well-sm">
		{{ Form::open(['route'=>['sesmt.plano_acao.store', 'ocorrencia_id'=>$ocorrencia->id], 'class'=>'form']) }}
			<div class="form-group">
				{{ Form::label('descricao ', 'Descrição do Plano de Ação: ', ['class'=>'form-label']) }}
				{{ Form::textarea('descricao', null, ['class'=>'form-control', 'rows'=>'3']) }}
			</div>
			<div class="form-group">
				{{ Form::submit('Gravar', ['class'=>'btn btn-success']) }}
			</div>
		{{ Form::close() }}

	@endif

	</div>

	<div>
		<table class="table table-hover">
			<caption>Planos de Ação da Ocorrencia</caption>
			<thead>
				<tr>
					<th>#</th>
					<th>Descrição</th>
					<th>Situação</th>
					<th>Data de Criação</th>
					<th>Data Finalização</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				@foreach($ocorrencia->plano_acaos as $plano)
				<tr>
					<td>{{ $plano->id }}</td>
					<td>{{ $plano->descricao }}</td>
					<td>{{ $plano->situacao }}</td>
					<td>{{ $plano->data_criacao }}</td>
					<td>{{ $plano->data_finalizacao }}</td>
					<td>
					@if($plano->situacao != 'Finalizado')

						{{ Form::open(['route'=>['sesmt.plano_acao.destroy', $plano->id], 'method'=>'delete']) }}
							{{ Form::submit('Delete', ['class'=>'btn btn-sm btn-danger']) }}
						{{ Form::close() }}

						{{ Form::model($plano, ['route'=>['sesmt.plano_acao.update', $plano->id], 'method'=>'patch']) }}
							{{ Form::submit('Finalizar', ['class'=>'btn btn-sm btn-success']) }}
						{{ Form::close() }}
					@endif
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>

@stop