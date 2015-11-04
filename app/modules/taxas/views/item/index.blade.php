@extends('layouts.modulo')

@section('content')

	<div class="panel panel-primary">
		<div class="panel-heading">
			<h4 class="panel-title">
				Controle de Itens
			</h4>
		</div>
		<div class="panel-body">

			@if(!Request::segment(3))

				<div class="form-group pull-right">
					{{ link_to_route('taxa.itens.create', 'Adicionar', null, ['class'=>'btn btn-sm btn-success']) }}
				</div>
				@include('taxas::item.list')

			@else

				@yield('form')

			@endif


		</div>
		<div class="panel-footer">

		</div>
	</div>
@stop