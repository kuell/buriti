@extends('layouts.modulo')

@section('content')
{{ Form::open(array('route' => 'farmacia.ocorrencias.store', 'rule'=>'form')) }}
<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">Criar nova Ocorrencia</h3>
	</div>
	<div class="panel-body">

			@include('farmacia::ocorrencias.form')

	</div>
	<div class="panel-footer">
	    <button type="submit" class="btn btn-primary">Gravar</button>
	    {{ link_to_route('farmacia.ocorrencias.index', 'Voltar', null, array('class'=>'btn btn-danger')) }}
	</div>
</div>
{{ Form::close() }}
@endsection