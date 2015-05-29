@extends('layouts.modal')

@section('modal')

<div class="well well-sm">
	<h4>Posto de Trabalho:
		<small> {{ $posto->descricao }}
		</small>
	</h4>
	{{ link_to_route('setors.posto', '<< Voltar', $posto->setor_id)}}
</div>

<div>
	{{ Form::open(['route'=>['setors.posto.atividade.add', $posto->id]]) }}
		<div class="form form-group">
			{{ Form::label('Descrição da Atividade: ')}}
			{{ Form::textArea('descricao', null, ['class'=>'form-control col-md-9','rows'=>4,'required']) }}
		</div>

			{{ Form::submit('Grava', ['class'=>'btn btn-success']) }}
	{{ Form::close() }}
</div>

<div>
	<table class="table table-hover">
		<thead>
			<tr>
				<th>Atividades</th>
			</tr>
		</thead>
		<tbody>
			@foreach($posto->atividades as $atividade)
			<tr>
				<td>{{{ $atividade->descricao }}}</td>
				<td>
					<a href="{{ URL::route('setors.posto.atividade.delete', $atividade->id) }}" class="btn btn-danger btn-sm" title="Delete Posto de Trabaho e suas atividades">
						<i class="glyphicon glyphicon-trash" ></i>
					</a>

				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
@stop