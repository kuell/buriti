@extends('layouts.frame')

@section('frame')
{{ Form::open(array('route' => ['fichas.curso', $ficha->id], 'rule'=>'form')) }}
	<div class="form-group">
		{{ Form::label('descricao', 'Descrição: ') }}
		{{ Form::text('descricao', null, array('class'=>'form-control', 'placeholder'=>'Descrição do curso')) }}
	</div>
	<div class="form-grup">
		{{ Form::label('instituicao', 'Instituição de ensino: ') }}
		{{ Form::text('instituicao', null, array('class'=>'form-control', 'placeholder'=>'Instituição')) }}
	</div>
	<div class="form-group">
		{{ Form::label('ano', 'Ano: ') }}
		{{ Form::text('ano', null, array('class'=>'form-control numero', 'placeholder'=>'Ano')) }}

		{{ Form::label('concluido', 'Concluido: ') }}
		{{ Form::select('concluido', ['Não', 'Sim'], 1, ['class'=>'form-control']) }}
	</div>
	<div class="form-group">
		{{ Form::submit('Gravar', array('class' => 'btn btn-info')) }}
	</div>

{{ Form::close() }}

@if (count($ficha->cursos))
<table class="table table-hover">
	<thead>
		<tr>
			<th>Descricao do Curso</th>
			<th>Instituicao</th>
			<th>Ano</th>
			<th>Concluido</th>
		</tr>
	</thead>

	<tbody>
		@foreach ($ficha->cursos as $curso)
		<tr>
			<td>{{{ $curso->descricao }}}</td>
			<td>{{{ $curso->instituicao }}}</td>
			<td>{{{ $curso->ano }}}</td>
			<td>{{{ $curso->concluido }}}</td>
			<td>
				<a href="/fichas/cursos/{{ $curso->id }}/delete" class="glyphicon glyphicon-trash">
				</a>
			</td>
			<td></td>
		</tr>
		@endforeach
	</tbody>
</table>
@endif

@stop