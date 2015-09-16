@extends('layouts.frame')

@section('frame')

    {{ Form::open(array('url' => 'fichas/parentes/'.$ficha->id, 'class'=>'form')) }}
    	<div class="form-group">
        	{{ Form::label('nome', 'Nome: ') }}
        	{{ Form::text('nome', null, array('class'=>'form-control', 'placeholder'=>'Nome do parente')) }}
		</div>
		<div class="form-group">
        	{{ Form::label('grau', 'Grau de Parentesco: ') }}
        	{{ Form::text('grau', null, array('class'=>'form-control', 'placeholder'=>'Grau de parentesco')) }}
		</div>
		<div class="form-group">
            {{ Form::label('setor', 'Setor: ') }}
            {{ Form::text('setor', null, array('class'=>'form-control', 'placeholder'=>'Setor')) }}
		</div>
		<div class="form-group">
            {{ Form::submit('Gravar', array('class' => 'btn btn-info')) }}
        </div>
    {{ Form::close() }}

@if (count($ficha->parentes))
	<table class="table table-hover">
		<thead>
			<tr>
				<th>Nome</th>
				<th>Setor</th>
				<th>Grau de parentesco</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($ficha->parentes as $parente)
				<tr>
					<td>{{{ $parente->nome }}}</td>
					<td>{{{ $parente->setor }}}</td>
					<td>{{{ $parente->grau }}}</td>
                    <td>
                    	<a href="/fichas/parentes/{{ $parente->id }}/delete" class="glyphicon glyphicon-trash">
                        </a>
                    </td>
                    <td></td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endif

@stop