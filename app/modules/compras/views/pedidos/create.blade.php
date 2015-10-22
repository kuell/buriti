@extends('compras::pedidos.index')

@section('form')
	{{ Form::open(['route'=>'compras.pedidos.store', 'class'=>'form form-horizontal', 'file'=>true]) }}

		@include('compras::pedidos.form')

	<div class="form-group">
		<div class="col-md-12">
			{{ Form::submit('Gravar', ['class'=>'btn btn-sm btn-success']) }}
			{{ link_to_route('compras.pedidos.index','Voltar', null, ['class'=>'btn btn-sm btn-danger']) }}
		</div>
	</div>

	{{ Form::close() }}

@stop