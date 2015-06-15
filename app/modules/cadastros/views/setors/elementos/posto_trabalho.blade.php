@extends('layouts.modal')

@section('modal')
	<style type="text/css">
		*{
			font-size: 10px;
		}

	</style>

<div>
	{{ Form::open(['route'=>['setors.posto.add', $setor->id]]) }}
		<div class="form form-group col-md-9">
			{{ Form::label('Descrição do Posto de Trabalho: ')}}
			{{ Form::text('descricao', null, ['class'=>'form-control col-md-9', 'required']) }}
		</div>
			{{ Form::submit('Grava', ['class'=>'btn btn-success btn-sm']) }}
	{{ Form::close() }}
</div>

<div>
	<table class="table table-hover">
		<thead>
			<tr>
				<th>Descrição do Posto de Trabalho</th>
			</tr>
		</thead>
		<tbody>
			@foreach($setor->postoTrabalhos as $posto)
			<tr>
				<td>{{{ $posto->descricao }}}</td>
				<td>

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
@stop