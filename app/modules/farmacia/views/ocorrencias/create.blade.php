@extends('layouts.modulo')

@section('content')

<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">Criar nova Ocorrencia</h3>
	</div>
	<div class="panel-body">
		{{ Form::open(array('route' => 'farmacia.ocorrencias.store', 'rule'=>'form')) }}
			@include('farmacia::ocorrencias.form')
		{{ Form::close() }}
	</div>
	<div class="panel-footer">
	    <button type="submit" class="btn btn-primary">Gravar</button>
	    {{ link_to_route('farmacia.ocorrencias.index', 'Cancelar', null, array('class'=>'btn btn-danger')) }}
	</div>
</div>
@endsection