
@extends('layouts.modal')

@section('modal')
	<style type="text/css">
		*{
			font-size: 10px;
		}

	</style>

<div class="well">
	{{ Form::open(['route'=>['setors.funcao.add', $setor->id], 'class'=>'form form-horizontal']) }}
		<div class="form form-group">
			<div class="col-md-9">
				{{ Form::label('Descrição da Função: ')}}
				{{ Form::text('descricao', null, ['class'=>'form-control col-md-9', 'required']) }}
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
	<table class="table">
		<thead>
			<tr>
				<th>Descrição da função</th>
			</tr>
		</thead>
		<tbody>
			@foreach($setor->funcaos as $funcao)
			<tr>
				<td>{{{ $funcao->descricao }}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>


@stop