@extends('layouts.modulo')


@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Controle de Medicamentos</h3>
	</div>
	<div class="panel-body">
		@include('farmacia::medicamento.form')
		@include('farmacia::medicamento.lista')

	</div>
	<div class="panel-footer"></div>
</div>
@stop