@extends('layouts.modal')

@section('modal')
	<style type="text/css">
		*{
			font-size: 10px;
		}

	</style>

<div class="well">
@if(empty($posto))
	{{ Form::open(['route'=>['setors.posto.add', $setor->id], 'class'=>'form form-horizontal']) }}
@else
	{{ Form::model($posto, ['route'=>['setors.posto.add', $setor->id], 'class'=>'form form-horizontal']) }}
	{{ Form::hidden('posto_id', $posto->id) }}
@endif
	<div class="form-group">
		<div class="col-md-9">
			{{ Form::label('Descrição do Posto de Trabalho: ')}}
			{{ Form::text('descricao', null, ['class'=>'form-control', 'required']) }}
		</div>
	</div>
	<div class="form-group">
		<div class="col-md-12">
			{{ Form::submit('Grava', ['class'=>'btn btn-success btn-sm']) }}
		</div>
	</div>

	{{ Form::close() }}
</div>

<div>
	<table class="table table-hover table-bordered" id="postos">
		<thead>
			<tr>
				<th>#</th>
				<th>Descrição do Posto de Trabalho</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach($setor->postoTrabalhos as $posto)
			<tr>
				<td>{{{ $posto->id }}}</td>
				<td>{{{ $posto->descricao }}}</td>
				<td>

					<a href="{{ URL::route('setors.posto.edit', $posto->id) }}" class="btn btn-primary btn-sm" title="Editar Posto">
						<i class="glyphicon glyphicon-pencil" ></i>
					</a>

					<a href="{{ URL::route('setors.posto.atividades', $posto->id) }}" class="btn btn-info btn-sm" title="Atividades do Posto de Trabalho">
						<i class="glyphicon glyphicon-list" ></i>
					</a>

					<a href="{{ URL::route('setors.posto.delete', $posto->id) }}" class="btn btn-danger btn-sm" title="Delete Posto de Trabaho e suas atividades">
						<i class="glyphicon glyphicon-trash" ></i>
					</a>

				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>

<script type="text/javascript">
	$(function(){
		$('#postos').dataTable()
	})
</script>
@stop