@extends('layouts.modulo')


@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		<h3>Ordem Interna <small>Gerenciamento de serviços internos</small></h3>
	</div>
	<div class="panel-body">
		@include('manutencao::osi.list')
	</div>
	<div class="panel-footer">

	</div>
</div>


@stop