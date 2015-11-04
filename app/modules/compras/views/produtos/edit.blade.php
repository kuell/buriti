@extends('compras::produtos.index')

@section('form')
	{{ Form::model($produto, ['route'=>['compras.produtos.update', $produto->id], 'class'=>'form form-horizontal', 'method'=>'patch', 'files'=>true]) }}

		@include('compras::produtos.form')

	<div class="form-group">
		<div class="col-md-12">
			{{ Form::submit('Gravar', ['class'=>'btn btn-sm btn-success']) }}
			{{ link_to_route('compras.produtos.index','Voltar', null, ['class'=>'btn btn-sm btn-danger']) }}
		</div>
	</div>

	{{ Form::close() }}

@stop