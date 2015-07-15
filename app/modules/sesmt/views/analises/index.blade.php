@extends('layouts.modulo')

@section('content')

<div class="panel panel-info">
	<div class="panel-heading clearfix">
		<div class="panel-title pull-left">
			<h3>Analise de Ocorrencias</h3>
		</div>
	</div>
	<div class="panel-body">
		@include('sesmt::analises.lista')
	</div>
</div>


@stop