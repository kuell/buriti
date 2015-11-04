@extends('layouts.modulo')

@section('content')

<div class="panel panel-info">

	<div class="panel-heading clearfix">
		<div class="panel-title pull-left">
			<h3 class="panel-title">Planos de Ação</h3>
		</div>
		<div class="pull-right">
			{{ link_to_route('sesmt.plano_acao.create', 'Adicionar', null, ['class'=>'btn btn-primary btn-sm']) }}
		</div>

	</div>
	<div class="panel-body">
		@include('sesmt::plano_acao.lista')
	</div>

@stop
